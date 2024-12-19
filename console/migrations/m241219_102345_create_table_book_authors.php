<?php

use yii\db\Migration;

class m241219_102345_create_table_book_authors extends Migration
{
    private const TABLE = '{{%book_author}}';
    private const TABLE_BOOK = '{{%book}}';
    private const TABLE_AUTHOR = '{{%author}}';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_book_authors_book_id', self::TABLE, 'book_id', self::TABLE_BOOK, 'id', 'CASCADE');
        $this->addForeignKey('fk_book_authors_author_id', self::TABLE, 'author_id', self::TABLE_AUTHOR, 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
