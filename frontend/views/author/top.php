<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'TOP-10 авторов';
?>

<h2><?= $this->title; ?></h2>
<?php foreach ($books as $book) {
    echo \yii\helpers\Html::a($book->issue_year, ['/author/top', 'year' => $book->issue_year], ['class' => 'btn btn-success', 'style' => 'margin-right: 10px']);
} ?>

<table class="table">
    <?php foreach ($authors as $author) {
        ?>
        <tr>
            <td><?= $author['name']; ?></td>
            <td><?= $author['lastname']; ?></td>
            <td><?= $author['patronymic']; ?></td>
            <td>Кол-во книг: <?= $author['count_books']; ?></td>
        </tr>
    <?php } ?>
</table>
