<?php


namespace common\models\search;


use common\models\Farm;
use yii\data\ActiveDataProvider;

class FarmSearch extends Farm
{
    use RemovableTrait;

    public function search() {
        return new ActiveDataProvider(['query' => $this->getQuery()]);
    }

    public function getQuery() {
        return self::find()->where(['deleted_at' => null]);
    }
}