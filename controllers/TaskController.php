<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Task;
use Yii;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::getAllByCurrentCompany();
        return $this->render('index', ['tasks' => $tasks]);
    }

    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Task();
        $model->user_id = Yii::$app->user->id;

        $options = $post['option'] ?? ['first', 'second'];

        if (!$options) {
            $model->addError('options', 'Options is required');
        }

        if ($post && $model->load($post)) {
            $model->options = $options;
            $model->features = (int)isset($post['features']);

            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Task created');

                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}
