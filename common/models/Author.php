<?php

namespace common\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName(): string
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

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
        ];
    }

    public function getFullName(): string
    {
        return implode(' ', [$this->lastname, $this->name, $this->patronymic]);
    }

    public function getBooks(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('book_author', ['author_id' => 'id']);
    }
}
