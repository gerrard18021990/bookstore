<?php

namespace common\service;

use common\models\Author;
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
}
