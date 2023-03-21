<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\Material;
use \app\models\Account;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-loan-form">

    <?php $form = ActiveForm::begin();  ?>

    <?= $form->field($model, 'materialId')->dropDownList(ArrayHelper::map(Material::find()->where(['status' => 1])->all(), 'id', 'inventoryNumber'))->label('Material ID') ?>

    <?= $form->field($model, 'accountId')->dropDownList(ArrayHelper::map(Account::find()->all(), 'id', 'email'))?>

    <?= $form->field($model, 'loanDate')->widget(\yii\jui\DatePicker::class, ['options' => ['class' => 'form-control'], 'dateFormat' => 'yyyy-MM-dd 00:00:00']) ?>

    <?= $form->field($model, 'returnDate')->widget(\yii\jui\DatePicker::class, ['options' => ['class' => 'form-control'], 'dateFormat' => 'yyyy-MM-dd 00:00:00']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
