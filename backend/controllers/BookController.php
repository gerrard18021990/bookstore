<?php

namespace backend\controllers;

use common\models\Author;
use common\models\Book;
use common\service\BookService;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;

class BookController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'books' => Book::find()->all()
        ]);
    }

    public function actionCreate()
    {
        $book = new Book();

        if ($book->load(Yii::$app->request->post()) && (new BookService())->save($book)) {
            return $this->redirect(Url::toRoute('/book/index'));
        }

        return $this->render('form', [
            'book' => $book,
            'authors' => Author::find()->all(),
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionUpdate($id)
    {
        if (!$book = Book::findOne($id)) {
            return $this->render('/error/404');
        }

        $book->authorIds = $book->authors;

        if ($book->load(Yii::$app->request->post()) && (new BookService())->save($book)) {
            return $this->redirect(Url::toRoute('/book/index'));
        }

        return $this->render('form', [
            'book' => $book,
            'authors' => Author::find()->all(),
        ]);
    }
}
