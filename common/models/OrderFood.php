<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_food".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $food_id
 * @property int $section number of section
 * @property int $weight in kg
 *
 * @property Food $food
 * @property Order $order
 */
class OrderFood extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'food_id', 'section', 'weight'], 'integer'],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'food_id' => 'Food ID',
        ];
    }

    public static function getSectionList() {
        return [1, 2, 3, 4];
    }

    public static function getWeightList() {
        return [500,1000,1500,2000,2500,3000,3500,4000,4200,4400,4600,4800,5000];
    }


    /**
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
