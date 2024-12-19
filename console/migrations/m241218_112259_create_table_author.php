<?php

use yii\db\Migration;

class m241218_112259_create_table_author extends Migration
{
    private const TABLE = '{{%author}}';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'patronymic' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
