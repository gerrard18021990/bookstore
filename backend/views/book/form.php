<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = $book->isNewRecord ? 'Создать книгу' : 'Изменить книгу';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($book, 'title') ?>
        <?php if($book->picture) {
            echo Html::img($book->getPictureUrl(), ['class' => 'img-thumbnail']);
        } ?>
        <?= $form->field($book, 'pictureUpload')->fileInput() ?>
        <?= $form->field($book, 'isbn') ?>
        <?= $form->field($book, 'description')->textarea() ?>
        <?= $form->field($book, 'issue_year') ?>
        <?= $form->field($book, 'authorIds')->checkboxList(\yii\helpers\ArrayHelper::map($authors, 'id', 'fullName')); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
