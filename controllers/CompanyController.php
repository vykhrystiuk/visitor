<?php

namespace app\controllers;

use app\components\Controller;
use app\models\User;

class CompanyController extends Controller
{
    public function actionIndex()
    {
        $companies = User::getCompanies();

        return $this->render('index', ['companies' => $companies]);
    }
}
