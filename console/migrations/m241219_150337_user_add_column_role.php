<?php

use yii\db\Migration;

class m241219_150337_user_add_column_role extends Migration
{
    private const TABLE = '{{%user}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'role', $this->string()->notNull());
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'role');
    }
}
