<?php

namespace backend\controllers;

use common\models\Book;
use Yii;
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

        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(Url::toRoute('/book/index'));
        }

        return $this->render('form', [
            'book' => $book,
        ]);
    }

    public function actionUpdate($id)
    {
        if (!$book = Book::findOne($id)) {
            return $this->render('/error/404');
        }

        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(Url::toRoute('/book/index'));
        }

        return $this->render('form', [
            'book' => $book,
        ]);
    }
}
