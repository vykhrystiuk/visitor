<?php

/**
 * @var $this yii\web\View
 * @var $tasks \app\models\Task[]
 */

$this->title = 'Tasks';

echo \yii\helpers\Html::a('Create', ['create'], ['class' => 'btn btn-primary']);

\yii\helpers\VarDumper::dump($tasks,3,1);
?>


