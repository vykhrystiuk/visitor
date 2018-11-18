<?php

/**
 * @var $this yii\web\View
 * @var $tasks \app\models\Task[]
 * @var $company \app\models\User
 */

$this->title = $company->username . ' tasks';

\yii\helpers\VarDumper::dump($tasks,3,1);
?>