<?php

use yii\db\Migration;

/**
 * Class m220207_204645_create_table_trucks
 */
class m220207_204645_create_table_trucks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('truck', [
            'id' => $this->primaryKey(),
            'label' => $this->string(),
            'created_at' => $this->integer(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
        ]);
        $this->batchInsert('truck', ['label', 'created_at'], [
            ['Volvo B724EB', time()],
            ['Volvo A977BO', time()],
            ['Камаз В667ВУ', time()],
            ['Камаз Х927ТР', time()],
            ['Зил Т168ОА', time()],
        ]);
        $this->addColumn('order', 'truck_id', $this->integer());
        $this->addForeignKey('FK_order_truck', 'order', 'truck_id', 'truck', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_order_truck', 'order');
        $this->dropColumn('order', 'truck_id');
        $this->dropTable('truck');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220207_204645_create_table_trucks cannot be reverted.\n";

        return false;
    }
    */
}
