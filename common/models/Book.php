<?php

namespace common\models;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public array $authorIds = [];

    public static function tableName()
    {
        return '{{%book}}';
    }

    public function rules(): array
    {
        return [
            [['title', 'isbn', 'issue_year'], 'required'],
            ['isbn', 'unique'],
            [['title', 'isbn'], 'string', 'min' => 2, 'max' => 255],
            ['description', 'string', 'min' => 0, 'max' => 10000],
            ['issue_year', 'integer', 'min' => 0, 'max' => 2050],
            ['authorIds', 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Название',
            'isbn' => 'ISBN',
            'description' => 'Описание',
            'issue_year' => 'Год выпуска',
        ];
    }

    public function getAuthors(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }
}
