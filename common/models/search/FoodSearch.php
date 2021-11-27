<?php


namespace common\models\search;


use common\models\Food;
use yii\data\ActiveDataProvider;

class FoodSearch extends Food
{
    use RemovableTrait;

    public function search() {
        return new ActiveDataProvider(['query' => $this->getQuery()]);
    }

    public function getQuery() {
        return self::find()->where(['deleted_at' => null]);
    }
}