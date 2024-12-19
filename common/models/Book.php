<?php

namespace common\models;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%book}}';
    }

    public function rules(): array
    {
        return [
            [['title', 'isbn', 'issue_year'], 'required'],
            [['title', 'isbn'], 'string', 'min' => 2, 'max' => 255],
            ['description', 'string', 'min' => 0, 'max' => 10000],
            ['issue_year', 'integer', 'min' => 0, 'max' => 2050],
        ];
    }
}
