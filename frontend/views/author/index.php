<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Список авторов';
$subscriptionIds = ArrayHelper::map($subscriptions, 'id', 'id');
?>

<h2><?= $this->title; ?></h2>
<table class="table">
    <?php foreach ($authors as $author) { ?>
        <tr>
            <td><?= $author->name; ?></td>
            <td><?= $author->lastname; ?></td>
            <td><?= $author->patronymic; ?></td>
            <td>
                <?php if (in_array($author->id, $subscriptionIds)) { ?>
                    <a class="btn btn-danger" href="<?= Url::toRoute(['/author/unsubscribe', 'id' => $author->id]); ?>">Отписаться</a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="<?= Url::toRoute(['/author/subscribe', 'id' => $author->id]); ?>">Подписаться</a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
