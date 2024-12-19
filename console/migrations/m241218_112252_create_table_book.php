<?php

use yii\db\Migration;

class m241218_112252_create_table_book extends Migration
{
    private const TABLE = '{{%book}}';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'issue_year' => $this->integer()->notNull(),
            'isbn' => $this->string()->notNull()->unique(),
            'picture' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
