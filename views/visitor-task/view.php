<?php

/**
 * @var $task \app\models\Task
 * @var $review \app\models\Review
 * @var $this \yii\web\View
 */

?>

<div class="container-fluid task">
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

                <form method="post" enctype="multipart/form-data">
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
                                                    <input class="form-check-input" type="checkbox" value="" >
                                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                      </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="" >
                                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                      </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
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
                                    <?php foreach ($review->task->taskOptions as $option) : ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="option[]" value="" >
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
                                    <input type="file" name="Review[file]" class="file">
                                    <div class="input-group col-xs-12">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                        <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
                                        <span class="input-group-btn">
            <button class="browse btn input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
                                    </div>
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
                                    <label for="exampleFormControlTextarea2">Write your feedback</label>
                                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="Review[description]"></textarea>
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
                                <button type="submit" class="btn btn-success">Send review</button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
