<?php

namespace frontend\controllers;

use common\models\Author;
use common\models\Book;
use common\service\AuthorService;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AuthorController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'authors' => Author::find()->all(),
            'subscriptions' => Yii::$app->user->identity->authors,
        ]);
    }

    public function actionSubscribe($id)
    {
        if (!$author = Author::findOne($id)) {
            return $this->redirect(Url::toRoute('/author/index'));
        }

        (new AuthorService())->subscription(Yii::$app->user->identity, $author);

        return $this->redirect(Url::toRoute('/author/index'));
    }

    public function actionUnsubscribe($id)
    {
        if (!$author = Author::findOne($id)) {
            return $this->redirect(Url::toRoute('/author/index'));
        }

        (new AuthorService())->unsubscription(Yii::$app->user->identity, $author);

        return $this->redirect(Url::toRoute('/author/index'));
    }

    public function actionTop()
    {
        $authors = [];

        if ($year = Yii::$app->request->get('year')) {
            $authors = Author::find()
                ->select(['author.*', 'count(*) as count_books'])
                ->leftJoin('book_author ba', 'ba.author_id = author.id')
                ->leftJoin(Book::tableName(), 'book.id = ba.book_id')
                ->where('book.issue_year = :year', [':year' => $year])
                ->groupBy('author.id')
                ->orderBy(['count_books' => SORT_DESC])
                ->limit(10)
                ->asArray()
                ->all();
        }

        return $this->render('top', [
            'books' => Book::find()->select('issue_year')->groupBy('issue_year')->all(),
            'authors' => $authors,
        ]);
    }
}
