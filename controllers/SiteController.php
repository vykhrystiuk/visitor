<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->redirect('/auth/login');
        }

        if ($user->role == User::ROLE_AGENT) {
            return $this->redirect('/company/index');
        } elseif ($user->role == User::ROLE_COMPANY) {
            return $this->redirect('/task/index');
        }

        return $this->redirect('/task/index');
    }
}
