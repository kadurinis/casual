<?php


namespace common\models\search;


use common\models\Order;

class OrderModel extends Order
{
    public function getDriverName() {
        return $this->driver->name;
    }

    public function getFoodName() {
        return $this->food->name;
    }

    public function getFarmName() {
        return $this->farm->name;
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'food_id' => 'Название корма',
            'farm_id' => 'Название фермы',
            'driver_id' => 'Имя водителя',
            'driverName' => 'Водитель',
            'foodName' => 'Корм',
            'farmName' => 'Ферма',
            'state' => 'Состояние'
        ]);
    }

    public function finish() {
        $this->finished_at = time();
        return $this;
    }

    public function getState() {
        return $this->finished_at ? 'Отгружено' : 'Отгружается';
    }
}