<?php

namespace app\components;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    public function init()
    {
        parent::init();

        $this->value = date('Y-m-d H:i:s');
    }
}
