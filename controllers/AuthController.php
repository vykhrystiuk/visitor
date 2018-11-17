<?php

namespace app\controllers;

use app\forms\LoginForm;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'main-login';

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        // TODO signup
    }
}
