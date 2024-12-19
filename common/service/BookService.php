<?php

namespace common\service;

use common\models\Author;
use common\models\Book;

class BookService
{
    public function save(Book $book): bool
    {
        $book->unlinkAll('authors', true);

        if (!$book->save()) {
            return false;
        }

        foreach ($book->authorIds as $authorId) {
            if ($author = Author::findOne($authorId)) {
                $book->link('authors', $author);
            }
        }

        return true;
    }
}
