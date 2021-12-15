<?php

use yii\db\Migration;

/**
 * Class m211215_061017_flush_orders
 */
class m211215_061017_flush_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('order', []);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211215_061017_flush_orders cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211215_061017_flush_orders cannot be reverted.\n";

        return false;
    }
    */
}
