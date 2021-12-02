<?php

use yii\db\Migration;

/**
 * Class m211201_205623_truncate_tables
 */
class m211201_205623_truncate_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('order', []);
        $this->delete('driver', []);
        $this->delete('farm', []);
        $this->delete('food', []);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211201_205623_truncate_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211201_205623_truncate_tables cannot be reverted.\n";

        return false;
    }
    */
}
