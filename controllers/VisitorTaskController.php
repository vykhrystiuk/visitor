<?php

namespace app\controllers;

use app\components\Controller;
use app\helpers\HttpError;
use app\models\Review;
use app\models\Task;
use app\models\User;
use Yii;
use yii\web\UploadedFile;

class VisitorTaskController extends Controller
{
    public function actionIndex($companyId)
    {
        $company = User::findOne($companyId);
        if (!$company) {
            HttpError::the404();
        }

        $tasks = $company->getFreeTasks();

        return $this->render('index', [
            'tasks' => $tasks,
            'company' => $company
        ]);
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);

        if (!$task || $task->quota < 1) {
            HttpError::the404();
        }

        $post = \Yii::$app->request->post();

        $review = new Review();
        $review->task_id = $id;
        $review->user_id = \Yii::$app->user->id;

        $options = $post['option'] ?? [
            [
                'name' => 'first',
                'value' => 0
            ],
            [
                'name' => 'second',
                'value' => 1
            ],
        ];

        if ($review->load($post)) {
            $review->file = UploadedFile::getInstance($review, 'file');
            $review->options = $options;
            if ($review->validate()) {
                $review->uploadFile();
                $review->save();
                Yii::$app->session->setFlash('success', 'Review was sent');

                return $this->redirect(['index', 'companyId' => $task->user_id]);
            }
        }

        return $this->render('view', [
            'task' => $task,
            'review' => $review
        ]);
    }
}
