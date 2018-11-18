<?php

/**
 * @var $this yii\web\View
 * @var $tasks \app\models\Task[]
 * @var $company \app\models\User
 */

$this->title = $company->username . ' tasks';

?>

<div class="container-fluid tasks">
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Quota</th>
                <th>Fee</th>
                <th>Last Review</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task) : ?>
                <tr data-link="/visitor-task/view?id=<?= $task->id ?>">
                    <td><?= $task->name ?></td>
                    <td><?= $task->quota ?></td>
                    <td><?= $task->amount ?> WBL</td>
                    <td><?= $task->updated_at ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
