<?php

/**
 * Class m181117_192806_create_table_review
 */
class m181117_192806_create_table_review extends \app\components\migrations\Migration
{
    private $tableName = 'review';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'paid_amount' => $this->decimal(9, 2),
            'transaction_hash' => $this->text(),
            'file_path' => $this->string(2000),
            'features' => $this->boolean()->notNull()->defaultValue(0),
            'state' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $this->tableOptions);

        $this->addForeignKey('fk_' . $this->tableName . '_user_id_user_id', $this->tableName, 'user_id', 'user', 'id');
        $this->addForeignKey('fk_' . $this->tableName . '_task_id_task_id', $this->tableName, 'task_id', 'task', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_' . $this->tableName . '_task_id_task_id', $this->tableName);
        $this->dropForeignKey('fk_' . $this->tableName . '_user_id_user_id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
