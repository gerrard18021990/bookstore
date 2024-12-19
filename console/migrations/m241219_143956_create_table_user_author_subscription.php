<?php

use yii\db\Migration;

class m241219_143956_create_table_user_author_subscription extends Migration
{
    private const TABLE = '{{%user_author_subscription}}';
    private const TABLE_USER = '{{%user}}';
    private const TABLE_AUTHOR = '{{%author}}';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_user_author_subscription_user_id', self::TABLE, 'user_id', self::TABLE_USER, 'id', 'CASCADE');
        $this->addForeignKey('fk_user_author_subscription_author_id', self::TABLE, 'author_id', self::TABLE_AUTHOR, 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
