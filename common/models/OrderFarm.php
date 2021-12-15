<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_farm".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $farm_id
 *
 * @property Farm $farm
 * @property Order $order
 */
class OrderFarm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_farm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'farm_id'], 'integer'],
            [['farm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Farm::className(), 'targetAttribute' => ['farm_id' => 'id']],
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
            'farm_id' => 'Farm ID',
        ];
    }

    /**
     * Gets query for [[Farm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFarm()
    {
        return $this->hasOne(Farm::className(), ['id' => 'farm_id']);
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
