<?php

namespace common\models;

use common\helpers\Storage;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public $pictureUpload = null;
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
            [['title', 'isbn', 'picture'], 'string', 'min' => 2, 'max' => 255],
            ['description', 'string', 'min' => 0, 'max' => 10000],
            ['issue_year', 'integer', 'min' => 0, 'max' => 2050],
            ['authorIds', 'safe'],
            ['pictureUpload', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Название',
            'pictureUpload' => 'Обложка',
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

    public function getPictureUrl(): ?string
    {
        return $this->picture ? (new Storage())->getWeb() . $this->picture : null;
    }
}
