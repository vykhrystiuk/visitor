<?php

/**
 * @var $this yii\web\View
 * @var $tasks \app\models\Task[]
 */

$this->title = 'Tasks';


?>


<div class="container-fluid tasks">
    <div class="row">
        <?= \yii\helpers\Html::a('Create new task', ['create'], ['class' => 'btn btn-primary']) ?>
        <table class="table">
            <thead>
            <tr>
                <th>Task</th>
                <th>Quota</th>
                <th>Fee</th>
                <th>Reviews</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task) : ?>
                <tr data-link="/company-review/index?taskId=<?= $task->id ?>">
                    <td><?= $task->name ?></td>
                    <td><?= $task->quota ?></td>
                    <td><?= $task->amount ?> WBL</td>
                    <td><?= $task->getReviews()->count() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>