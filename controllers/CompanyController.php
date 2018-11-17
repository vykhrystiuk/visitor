<?php

namespace app\controllers;

use app\components\Controller;

class CompanyController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
