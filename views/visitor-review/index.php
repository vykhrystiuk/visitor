<?php

/**
 * @var $this yii\web\View
 * @var $reviews \app\models\Review[]
 */

$this->title = 'Reviews';

?>

<div class="container-fluid reviews">
    <div class="row">
        <table class="table table-condesed">
            <thead>
            <tr>
                <th>Task</th>
                <th>Company</th>
                <th>Reward</th>
                <th>Updated</th>
                <th>Scan</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reviews as $review) : ?>
                <?php
                $class = 'info';
                if ($review->state == \app\models\Review::STATE_APPROVED) {
                    $class = 'success';
                } elseif ($review->state == \app\models\Review::STATE_DECLINED) {
                    $class = 'danger';
                }
                ?>
                <tr data-link="http://www.google.ru" class="table-<?= $class ?>">
                    <td><?= $review->task->name ?></td>
                    <td><?= $review->task->user->username ?></td>
                    <td><?= $review->paid_amount ?> WBL</td>
                    <td><?= $review->updated_at ?></td>
                    <td>
                        <?php if ($review->state == \app\models\Review::STATE_APPROVED) : ?>
                            <a target="_blank" href="https://hackathon.wizbl.io/transaction/<?= $review->transaction_hash ?>"><i class="material-icons">visibility</i></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
