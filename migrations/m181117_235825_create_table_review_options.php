<?php

/**
 * Class m181117_235825_create_table_review_options
 */
class m181117_235825_create_table_review_options extends \app\components\migrations\Migration
{
    private $tableName = 'review_option';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'review_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'value' => $this->smallInteger()->notNull(),
        ], $this->tableOptions);

        $this->addForeignKey('fk_' . $this->tableName . '_review_id_review_id', $this->tableName, 'review_id', 'review', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_' . $this->tableName . '_review_id_review_id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
