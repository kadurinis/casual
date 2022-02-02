<?php

use yii\db\Migration;

/**
 * Class m220201_202019_add_col_processed_at_to_order
 */
class m220201_202019_add_col_processed_at_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'processed_at', $this->integer()->after('created_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'processed_at');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220201_202019_add_col_processed_at_to_order cannot be reverted.\n";

        return false;
    }
    */
}
