<?php


namespace common\models\search;


use common\models\Driver;
use yii\data\ActiveDataProvider;

class DriverSearch extends Driver
{
    use RemovableTrait;

    public function search() {
        return new ActiveDataProvider(['query' => $this->getQuery()]);
    }

    public function getQuery() {
        return self::find()->where(['deleted_at' => null]);
    }
}