<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $created_at
 * @property int|null $finished_at
 * @property int|null $driver_id
 * @property int|null $food_id
 * @property int|null $farm_id
 *
 * @property Driver $driver
 * @property Farm $farm
 * @property Food $food
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'finished_at', 'driver_id', 'food_id', 'farm_id'], 'integer'],
            [['created_at'], 'default', 'value' => time()],
            [['food_id', 'farm_id', 'driver_id'], 'required'],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['farm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Farm::className(), 'targetAttribute' => ['farm_id' => 'id']],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Начата',
            'finished_at' => 'Завершена',
            'driver_id' => 'Водитель',
            'food_id' => 'Корм',
            'farm_id' => 'Ферма',
        ];
    }

    /**
     * Gets query for [[Driver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
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
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }
}
