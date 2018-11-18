<?php

/**
 * Class m181117_183241_create_table_task_option
 */
class m181117_183241_create_table_task_option extends \app\components\migrations\Migration
{
    private $tableName = 'task_option';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ], $this->tableOptions);

        $this->addForeignKey('fk_' . $this->tableName . '_task_id_task_id', $this->tableName, 'task_id', 'task', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_' . $this->tableName . '_task_id_task_id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
