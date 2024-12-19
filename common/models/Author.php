<?php

namespace common\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%author}}';
    }

    public function rules(): array
    {
        return [
            [['name', 'lastname', 'patronymic'], 'required'],
            [['name', 'lastname', 'patronymic'], 'string', 'min' => 2, 'max' => 255],
        ];
    }
}
