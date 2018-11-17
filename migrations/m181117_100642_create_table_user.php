<?php


/**
 * Class m181117_100642_create_table_user
 */
class m181117_100642_create_table_user extends \app\components\migrations\Migration
{
    private $tableName = 'user';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'name' => $this->string(),
            'role' => $this->integer()->notNull()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'wallet' => $this->string(),
            'balance' => $this->decimal(9, 2)->notNull()->defaultValue(0),
            'balance_frozen' => $this->decimal(9, 2)->notNull()->defaultValue(0),
            'karma' => $this->integer()->notNull()->defaultValue(0),
            'imagePath' => $this->string(2000),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
