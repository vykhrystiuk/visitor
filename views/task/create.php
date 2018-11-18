<?php

/**
 * @var $model \app\models\Task
 * @var $this \yii\web\View
 */

?>



<?php $form = \yii\widgets\ActiveForm::begin(); ?>

<div class="row">
    <?php if ($model->hasErrors()) : ?>
        <div class="col-lg-12">
            <div class="alert alert-danger" style="padding: 5px;">
                <?= $form->errorSummary([$model]);?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'features')->checkbox() ?>
<?= $form->field($model, 'amount') ?>
<?= $form->field($model, 'quota') ?>

<?= \yii\helpers\Html::submitButton() ?>

<?php \yii\widgets\ActiveForm::end(); ?>
