<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "truck".
 *
 * @property int $id
 * @property string|null $label
 * @property int|null $created_at
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 *
 * @property Order[] $orders
 */
class Truck extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'truck';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label'], 'string', 'max' => 255],
            [['created_at', 'deleted_at', 'deleted_by'], 'integer'],
            [['created_at'], 'default', 'value' => time()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Грузовик',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['truck_id' => 'id']);
    }
}
