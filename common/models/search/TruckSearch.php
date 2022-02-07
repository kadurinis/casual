<?php

namespace common\models\search;

use common\models\Truck;
use yii\data\ActiveDataProvider;

class TruckSearch extends Truck
{
    use RemovableTrait;

    public function search() {
        return new ActiveDataProvider(['query' => $this->getQuery()]);
    }

    public function getQuery() {
        return self::find()->where(['deleted_at' => null]);
    }
}