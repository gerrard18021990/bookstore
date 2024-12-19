<?php

namespace backend\controllers;

use common\models\Author;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AuthorController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'authors' => Author::find()->all()
        ]);
    }

    public function actionCreate()
    {
        $author = new Author();

        if ($author->load(Yii::$app->request->post()) && $author->save()) {
            return $this->redirect(Url::toRoute('/author/index'));
        }

        return $this->render('form', [
            'author' => $author,
        ]);
    }

    public function actionUpdate($id)
    {
        if (!$author = Author::findOne($id)) {
            return $this->render('/error/404');
        }

        if ($author->load(Yii::$app->request->post()) && $author->save()) {
            return $this->redirect(Url::toRoute('/author/index'));
        }

        return $this->render('form', [
            'author' => $author,
        ]);
    }
}
