<?php

namespace app\controllers;

use app\components\Controller;
use app\helpers\HttpError;
use app\models\Review;
use app\models\Task;
use Yii;

class CompanyReviewController extends Controller
{
    public function actionIndex($taskId)
    {
        $task = Task::findOne($taskId);
        if (!$task || $task->user_id != Yii::$app->user->id) {
            HttpError::the404();
        }

        $reviews = $task->reviews;

        return $this->render('index', ['reviews' => $reviews]);
    }

    public function actionView($id)
    {
        $review = Review::findOne($id);
        if (!$review || $review->task->user_id != Yii::$app->user->id) {
            HttpError::the404();
        }

        return $this->render('view', ['review' => $review]);
    }

    public function actionApprove($id)
    {
        $review = Review::findOne($id);
        if (!$review || $review->task->user_id != Yii::$app->user->id) {
            HttpError::the404();
        }

        $review->approve();
        $review->save(false, ['state']);

        Yii::$app->session->setFlash('success', 'Review approved successfully');

        return $this->redirect(['index', 'taskId' => $review->task_id]);
    }

    public function actionDecline($id)
    {
        $review = Review::findOne($id);
        if (!$review || $review->task->user_id != Yii::$app->user->id) {
            HttpError::the404();
        }

        $review->decline();
        $review->save(false, ['state']);

        Yii::$app->session->setFlash('success', 'Review declined successfully');

        return $this->redirect(['index', 'taskId' => $review->task_id]);
    }
}
