<?php

namespace app\components;

use app\helpers\HttpError;
use Yii;
use yii\filters\AccessControl;

abstract class Controller extends \yii\web\Controller
{
    protected $modelClass = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderAjax($view, $params = [])
    {
        if (!Yii::$app->request->isAjax) {
            return $this->render($view, $params);
        }
        Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapAsset' => false,
        ];
        return parent::renderAjax($view, $params);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (!$this->modelClass) {
            throw new \Exception('modelClass must be set');
        }

        $model = $this->modelClass::find()->where([
            'id' => $id,
            'user_id' => Yii::$app->user->id
        ])->one();

        if (!$model) {
            HttpError::the404();
        }
        return $model;
    }

    /**
     * @param string $key
     * @param string $message
     */
    public function setFlash(string $key, string $message)
    {
        Yii::$app->session->setFlash($key, $message);
    }
}
