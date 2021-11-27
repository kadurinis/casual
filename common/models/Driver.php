<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $soname
 * @property string|null $patron
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 *
 * @property Order[] $orders
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['name', 'soname', 'patron'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'soname' => 'Soname',
            'patron' => 'Patron',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['driver_id' => 'id']);
    }
}
