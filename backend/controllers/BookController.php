<?php

namespace backend\controllers;

use yii\web\Controller;

class BookController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'books' => []
        ]);
    }
}
