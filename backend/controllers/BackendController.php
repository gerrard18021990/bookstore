<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

abstract class BackendController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute('/site/login'));
        }

        if (!Yii::$app->user->identity->isAdmin()) {
            return $this->redirect(Yii::getAlias('@frontendUrl'));
        }

        return parent::beforeAction($action);
    }
}
