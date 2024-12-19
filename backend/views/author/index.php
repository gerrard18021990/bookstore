<?php

use yii\helpers\Url;

$this->title = 'Список авторов';
?>

<h2><?= $this->title; ?></h2>
<table class="table">
    <?php foreach ($authors as $author) { ?>
        <tr>
            <td><?= $author->name; ?></td>
            <td><?= $author->lastname; ?></td>
            <td><?= $author->patronymic; ?></td>
            <td>
                <?php foreach ($author->books as $book) { ?>
                    <div><?= $book->title; ?></div>
                <?php } ?>
            </td>
            <td>
                <a class="link" href="<?= Url::toRoute(['/author/update', 'id' => $author->id]); ?>">Изменить</a>
            </td>
        </tr>
    <?php } ?>
</table>
<a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl('/author/create'); ?>">Создать</a>
