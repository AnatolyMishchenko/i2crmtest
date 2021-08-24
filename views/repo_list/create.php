<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>

<div class="product-form-create">
    <?php $form = ActiveForm::begin([
        'id' => 'user-create',
        'layout' => 'default',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>
    <?= $form->field($model, 'login')->textInput() ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'name' => 'save-button']) ?>
    <?php ActiveForm::end() ?>
</div>
