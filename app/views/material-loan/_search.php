<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-loan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'materialLoanId') ?>

    <?= $form->field($model, 'materialId') ?>

    <?= $form->field($model, 'accountId') ?>

    <?= $form->field($model, 'loanDate') ?>

    <?= $form->field($model, 'returnDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
