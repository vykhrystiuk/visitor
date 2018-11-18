<?php

/**
 * @var $this yii\web\View
 * @var $review \app\models\Review
 */

$this->title = 'Review';


?>

<div class="container-fluid review">
    <div class="row">
        <div class="card">
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-12 col-md-12">
                    <img class="banner" src="https://wl3-cdn.landsec.com/sites/default/files/images/shops/logos/mcdonalds_0.png" class="w-50"/>
                    <div class="card-block px-3">
                        <h4 class="card-title"><?= $review->task->name ?></h4>
                        <hr/>
                        <p class="card-text">
                            <?= $review->task->description ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">General options:</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Breaking the customer rights</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Violation of sanitary norms</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Task options:</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <?php foreach ($review->reviewOptions as $option) : ?>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="" checked="<?= $option->value ?>">
                                                    <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td><?= $option->name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">File Upload:</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <img src="<?= $review->file_path ?>"/>
                            </div>
                        </div>
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Text review:</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div>
                                    <?= $review->description ?>
                                </div>
                            </div>
                        </div>
                        <!--<div class="card-header card-header-tabs card-header-primary">-->
                        <!--<div class="nav-tabs-navigation">-->
                        <!--<div class="nav-tabs-wrapper">-->
                        <!--<span class="nav-tabs-title">Text review:</span>-->
                        <!--</div>-->
                        <!--</div>-->
                        <!--</div>-->
                        <div class="card-body">
                            <?= \yii\helpers\Html::a('Approve', ['approve', 'id' => $review->id], ['class' => 'btn btn-success']) ?>
                            <?= \yii\helpers\Html::a('Reject', ['decline', 'id' => $review->id], ['class' => 'btn btn-danger']) ?>
                            <?= \yii\helpers\Html::a('Go Back', ['/company-review/index', 'taskId' => $review->task->id], ['class' => 'btn btn-warning']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
