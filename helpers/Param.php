<?php
/* @author Nikolay Vykhrystiuk <nikolay_1992@icloud.com> */

namespace app\helpers;

use Yii;
use yii\base\Object;

/**
 * Class Param
 * @package app\helpers
 */
class Param extends Object
{
    /**
     * @param $need
     * @return mixed
     */
    public static function get($need)
    {
        $params = Yii::$app->params;

        if (!isset($params[$need])) {
            HttpError::the500("Key not found: {$need}");
        }

        return $params[$need];
    }
}