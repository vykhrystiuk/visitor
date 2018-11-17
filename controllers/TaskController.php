<?php

namespace app\controllers;

use app\components\Controller;

class TaskController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
