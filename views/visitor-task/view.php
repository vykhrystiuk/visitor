<?php

/**
 * @var $task \app\models\Task
 * @var $review \app\models\Review
 * @var $this \yii\web\View
 */

?>



<?php $form = \yii\widgets\ActiveForm::begin(); ?>

<div class="row">
    <?php if ($review->hasErrors()) : ?>
        <div class="col-lg-12">
            <div class="alert alert-danger" style="padding: 5px;">
                <?= $form->errorSummary([$review]);?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $form->field($review, 'description')->textarea() ?>
<?= $form->field($review, 'file')->fileInput() ?>

<?= \yii\helpers\Html::submitButton() ?>

<?php \yii\widgets\ActiveForm::end(); ?>
