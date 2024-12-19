<?php

namespace common\service;

use common\helpers\Storage;
use common\models\Author;
use common\models\Book;
use yii\web\UploadedFile;

class BookService
{
    public function save(Book $book): bool
    {
        $book->unlinkAll('authors', true);

        if ($uploader = UploadedFile::getInstance($book, 'pictureUpload')) {
            $picture = uniqid() . '.' . $uploader->extension;

            if ($uploader->saveAs((new Storage())->getPath() . $picture)) {
                $book->picture = $picture;
            }
        }

        if (!$book->save()) {
            return false;
        }

        $book->authorIds = is_array($book->authorIds) ? $book->authorIds : [];

        foreach ($book->authorIds as $authorId) {
            if ($author = Author::findOne($authorId)) {
                $book->link('authors', $author);
            }
        }

        return true;
    }
}
