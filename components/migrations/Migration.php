<?php

namespace app\components\migrations;

abstract class Migration extends \yii\db\Migration
{
    protected $tableOptions = null;

    public function init()
    {
        parent::init();

        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }
}