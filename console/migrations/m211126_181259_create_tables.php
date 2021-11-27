<?php

use yii\db\Migration;

/**
 * Class m211126_181259_create_tables
 */
class m211126_181259_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('driver', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'soname' => $this->string(),
            'patron' => $this->string(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
        ], $tableOptions);
        $this->createTable('food', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
        ], $tableOptions);
        $this->createTable('farm', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
        ], $tableOptions);
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'finished_at' => $this->integer(),
            'driver_id' => $this->integer(),
            'food_id' => $this->integer(),
            'farm_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('FK_order_farm', 'order', 'farm_id', 'farm', 'id');
        $this->addForeignKey('FK_order_driver', 'order', 'driver_id', 'driver', 'id');
        $this->addForeignKey('FK_order_food', 'order', 'food_id', 'food', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_order_farm', 'order');
        $this->dropForeignKey('FK_order_driver', 'order');
        $this->dropForeignKey('FK_order_food', 'order');
        $this->dropTable('order');
        $this->dropTable('farm');
        $this->dropTable('food');
        $this->dropTable('driver');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211126_181259_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
