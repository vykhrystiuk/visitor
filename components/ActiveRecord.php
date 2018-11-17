<?php

namespace app\components;

use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\Query;

abstract class ActiveRecord extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @param $params
     * @return DataProviderInterface
     */
    public function search($params): DataProviderInterface
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }

    protected function getQuery(): Query
    {
        return new Query();
    }
}
