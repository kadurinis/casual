<?php

use yii\db\Migration;

/**
 * Class m220201_175717_add_col_section_weight
 */
class m220201_175717_add_col_section_weight extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order_food', 'section', $this->integer());
        $this->addColumn('order_food', 'weight', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order_food', 'section');
        $this->dropColumn('order_food', 'weight');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220201_175717_add_col_section_weight cannot be reverted.\n";

        return false;
    }
    */
}
