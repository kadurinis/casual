<?php

use yii\db\Migration;

/**
 * Class m211214_182340_create_tables_many_to_many
 */
class m211214_182340_create_tables_many_to_many extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_farm', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'farm_id' => $this->integer(),
        ]);
        $this->createTable('order_food', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'food_id' => $this->integer(),
        ]);
        $this->addForeignKey('FK_order_farm_order', 'order_farm', 'order_id', 'order', 'id');
        $this->addForeignKey('FK_order_farm_farm', 'order_farm', 'farm_id', 'farm', 'id');
        $this->addForeignKey('FK_order_food_order', 'order_food', 'order_id', 'order', 'id');
        $this->addForeignKey('FK_order_food_food', 'order_food', 'food_id', 'food', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_order_food_food', 'order_food');
        $this->dropForeignKey('FK_order_food_order', 'order_food');
        $this->dropForeignKey('FK_order_farm_farm', 'order_farm');
        $this->dropForeignKey('FK_order_farm_order', 'order_farm');
        $this->dropTable('order_food');
        $this->dropTable('order_farm');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211214_182340_create_tables_many_to_many cannot be reverted.\n";

        return false;
    }
    */
}
