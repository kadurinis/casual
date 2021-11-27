<?php


namespace common\models\search;


use common\models\Order;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public function search() {
        return new ActiveDataProvider(['query' => $this->getQuery()]);
    }

    public function getQuery() {
        return self::find()->where(['deleted_at' => null]);
    }
}