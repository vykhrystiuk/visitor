<?php

/**
 * Class m181117_174818_create_table_task
 */
class m181117_174818_create_table_task extends \app\components\migrations\Migration
{
    private $tableName = 'task';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'amount' => $this->decimal(9, 2)->notNull(),
            'quota' => $this->integer()->notNull()->defaultValue(0),
            'features' => $this->boolean()->notNull()->defaultValue(0),
            'state' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $this->tableOptions);

        $this->addForeignKey('fk_' . $this->tableName . '_user_id_user_id', $this->tableName, 'user_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_' . $this->tableName . '_user_id_user_id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
