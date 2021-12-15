<?php


namespace common\models\search;


use common\models\Order;
use common\models\OrderFarm;
use common\models\OrderFood;

class OrderModel extends Order
{
    private $_foods = [];
    private $_farms = [];

    public function setParams($params = []) {
        $this->driver_id = $params['driver_id'];
        $this->_foods = $params['food_id'];
        $this->_farms = $params['farm_id'];
        $this->food_id = current($params['food_id']);
        $this->farm_id = current($params['farm_id']);
    }

    public function getDriverName() {
        return $this->driver->name;
    }

    public function getFoodName() {
        return $this->food->name;
    }

    public function getFarmName() {
        return $this->farm->name;
    }

    public function getFarmList() {
        return implode(', ', $this->farms);
    }

    public function getFoodList() {
        return implode(', ', $this->foods);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'food_id' => 'Название корма',
            'farm_id' => 'Название фермы',
            'driver_id' => 'Имя водителя',
            'driverName' => 'Водитель',
            'foodName' => 'Корм',
            'foodList' => 'Корм',
            'farmName' => 'Ферма',
            'farmList' => 'Ферма',
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

    public function beforeSave($insert)
    {
        if ($insert) {
            if (empty($this->_foods)) {
                $this->addError('food', 'Не указан корм');
                return false;
            }
            if (count($this->_foods) > 4) {
                $this->addError('food', 'Максимально 4 вида корма');
                return false;
            }
            if (empty($this->_farms)) {
                $this->addError('farm', 'Не указана ферма');
                return false;
            }
            if (count($this->_farms) > 4) {
                $this->addError('farm', 'Максимально 4 фермы');
                return false;
            }
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes = []) {
        if ($insert) {
            foreach ($this->_farms as $farm) {
                $model = new OrderFarm(['farm_id' => $farm, 'order_id' => $this->id]);
                $model->save();
            }
            foreach ($this->_foods as $food) {
                $model = new OrderFood(['food_id' => $food, 'order_id' => $this->id]);
                $model->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function isNew() {
        return time() - $this->created_at < 15;
    }
}