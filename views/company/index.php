<?php

/**
 * @var $this yii\web\View
 * @var $companies \app\models\User[]
 */

$this->title = 'Companies';

?>

<div class="container-fluid overview">
    <div class="row">
        <?php foreach ($companies as $company) : ?>
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <div><a href="/visitor-task/index?companyId=<?= $company->id ?>"><img src="https://wl3-cdn.landsec.com/sites/default/files/images/shops/logos/mcdonalds_0.png"></a></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?= $company->username ?></h4>
                        <p class="card-category">
                            <span class="text-success"><b><?= $company->getTasks()->count() ?></b></span> Tasks opened</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

