<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Список книг';
?>

<h2><?= $this->title; ?></h2>
<table class="table">
    <?php foreach ($books as $book) { ?>
        <tr>
            <td width="10%">
                <?php if($book->picture) {
                    echo Html::img($book->getPictureUrl(), ['class' => 'img-fluid img-thumbnail']);
                } ?>
            </td>
            <td><?= $book->title; ?></td>
            <td><?= $book->issue_year; ?></td>
            <td><?= $book->isbn; ?></td>
            <td>
                <?php foreach ($book->authors as $author) { ?>
                    <div><?= $author->fullName; ?></div>
                <?php } ?>
            </td>
            <td>
                <a class="link" href="<?= Url::toRoute(['/book/update', 'id' => $book->id]); ?>">Изменить</a>
            </td>
        </tr>
    <?php } ?>
</table>
<a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('/book/create'); ?>">Создать</a>
