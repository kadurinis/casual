<?php


namespace common\models\search;


use common\models\Order;
use common\models\OrderFarm;
use common\models\OrderFood;

class OrderModel extends Order
{
    /** @var OrderFood[] $_foods */
    private $_foods = [];
    /** @var OrderFarm $_farms */
    private $_farms = [];

    public function setParams($params = []) {
        $this->driver_id = $params['driver_id'];
        $this->farm_id = current($params['farm_id']);

        $this->_farms = array_map(static function ($id) {
            return new OrderFarm(['farm_id' => $id]);
        }, $params['farm_id']); // перечень ID ферм

        $this->_foods[] = new OrderFood([
            'food_id' => $params['food_section_1'],
            'section' => 1,
            'weight' => $params['weight_section_1']
        ]);
        $this->_foods[] = new OrderFood([
            'food_id' => $params['food_section_2'],
            'section' => 2,
            'weight' => $params['weight_section_2']
        ]);
        $this->_foods[] = new OrderFood([
            'food_id' => $params['food_section_3'],
            'section' => 3,
            'weight' => $params['weight_section_3']
        ]);
        if (isset($params['food_section_4'], $params['weight_section_4'])) {
            $this->_foods[] = new OrderFood([
                'food_id' => $params['food_section_4'],
                'section' => 4,
                'weight' => $params['weight_section_4']
            ]);
        }
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
        return implode('&nbsp;', array_map(static function (OrderFood $model) {
            return "<li>{$model->section}: {$model->food->name} - {$model->weight}</li>";
        }, $this->orderFoods));
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

    public function isNeedProcess() {
        return $this->created_at && !$this->processed_at && !$this->finished_at;
    }

    public function isNeedFinish() {
        return $this->created_at && $this->processed_at && !$this->finished_at;
    }

    public function process() {
        $this->processed_at = time();
        return $this;
    }

    public function finish() {
        $this->finished_at = time();
        return $this;
    }

    public function getState() {
        switch (true) {
            case $this->finished_at > 0:
                return 'Отгружено';
            case $this->processed_at > 0:
                return 'Отгружается';
            case $this->created_at > 0:
                return 'Ожидаем подтверждения';
            default:
                return 'Создана заявка';
        }
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            if (empty($this->_foods)) {
                $this->addError('food', 'Не указан корм');
                return false;
            }
            if (count($this->_foods) < 3) {
                $this->addError('food', 'Надо заполнить минимум 3 секции');
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
            foreach ($this->_farms as $farm) {
                if (!$farm->validate()) {
                    $this->addError('Неверно указаны фермы');
                    return false;
                }
            }
            foreach ($this->_foods as $food) {
                if (!$food->validate()) {
                    $this->addError('Неверно указаны секции, вес или корм в них');
                    return false;
                }
            }
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes = []) {
        if ($insert) {
            foreach ($this->_farms as $farm) {
                $farm->order_id = $this->id;
                $farm->save();
            }
            foreach ($this->_foods as $food) {
                $food->order_id = $this->id;
                $food->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function isNew() {
        return time() - $this->created_at < 15;
    }
}