<?php

namespace common\service;

use common\models\Author;
use common\models\Book;
use common\models\User;

class AuthorService
{
    public function subscription(User $user, Author $author): bool
    {
        if ($user->getAuthors()->where('id = :id', [':id' => $author->id])->one()) {
            return false;
        }

        $user->link('authors', $author);

        return true;
    }

    public function unsubscription(User $user, Author $author): bool
    {
        if (!$user->getAuthors()->where('id = :id', [':id' => $author->id])->one()) {
            return false;
        }

        $user->unlink('authors', $author, true);

        return true;
    }

    public function getTopByYear($year, int $limit)
    {
        if (empty($year)) {
            return [];
        }

        return Author::find()
            ->select(['author.*', 'count(*) as count_books'])
            ->leftJoin('book_author ba', 'ba.author_id = author.id')
            ->leftJoin(Book::tableName(), 'book.id = ba.book_id')
            ->where('book.issue_year = :year', [':year' => $year])
            ->groupBy('author.id')
            ->orderBy(['count_books' => SORT_DESC])
            ->limit($limit)
            ->asArray()
            ->all();
    }
}
