<?php

/**
 * @var $model \app\models\Task
 * @var $this \yii\web\View
 */

?>

<div class="row">
    <?php if ($model->hasErrors()) : ?>
        <div class="col-lg-12">
            <div class="alert alert-danger" style="padding: 5px;">
                <?php foreach ($model->getErrors() as $error) : ?>
                    <?= $error[0] ?> <br>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="container-fluid task">
    <div class="row">
        <div class="card" style="padding: 50px 0 0 0">
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-12 col-md-12">
                    <form class="form-signin" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="Task[name]" id="card-holder-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Description</label>
                            <div class="col-sm-9">
                                <textarea rows="10" class="form-control" name="Task[description]" id="card-holder-name"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" name="Task[features]"> Features</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="Task[amount]" id="card-holder-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Quota</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="Task[quota]" id="card-holder-name">
                            </div>
                        </div>

                        <h3>Options list</h3>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="option[]" id="card-holder-name" placeholder="Option one">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="option[]" id="card-holder-name" placeholder="Option two">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="option[]" id="card-holder-name" placeholder="Option three">
                            </div>
                        </div>

                        <div class="form-group">
                            <button href="#" class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
