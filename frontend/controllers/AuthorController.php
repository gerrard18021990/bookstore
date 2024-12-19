<?php

namespace frontend\controllers;

use common\models\Author;
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
}