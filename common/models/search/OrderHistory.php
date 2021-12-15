<?php


namespace common\models\search;


use common\models\Driver;
use common\models\Farm;
use common\models\Food;
use common\models\Order;
use yii\data\ActiveDataProvider;

class OrderHistory extends Order
{
    public function search() {
        $query = $this->getQuery();

        $query
            ->andFilterWhere(['driver_id' => $this->driver_id])
            ->andFilterWhere(['farm.id' => $this->farm_id])
            ->andFilterWhere(['food.id' => $this->food_id]);

        if ($this->created_at) {
            $query->andWhere(['>=', 'order.created_at', strtotime($this->created_at)]);
        }
        if ($this->finished_at) {
            $query->andWhere(['<=', 'order.finished_at', strtotime($this->finished_at) + 86400]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);
    }

    public function getQuery() {
        return self::find()

            ->joinWith('foods')
            ->joinWith('farms')
            ->joinWith('driver')
            ->groupBy('order.id');
    }

    public function getFarmCell() {
        return implode(', ', $this->farms);
    }

    public function getFoodCell() {
        return implode(', ', $this->foods);
    }

    public function getDriverList() {
        return Driver::find()->select(['name', 'id'])->indexBy('id')->orderBy(['name' => SORT_ASC])->column();
    }

    public function getFoodList() {
        return Food::find()->select(['name', 'id'])->indexBy('id')->orderBy(['name' => SORT_ASC])->column();
    }

    public function getFarmList() {
        return Farm::find()->select(['name', 'id'])->indexBy('id')->orderBy(['name' => SORT_ASC])->column();
    }
}