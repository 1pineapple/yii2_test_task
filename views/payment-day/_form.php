<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentDay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-day-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'administrator_id')->textInput() ?>

    <?= $form->field($model, 'begin_saldo')->textInput() ?>

    <?= $form->field($model, 'end_saldo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
