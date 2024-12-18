<?php

namespace backend\controllers;

use yii\web\Controller;

class AuthorController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'authors' => []
        ]);
    }
}
