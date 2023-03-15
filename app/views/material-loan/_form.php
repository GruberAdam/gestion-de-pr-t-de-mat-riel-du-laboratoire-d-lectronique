<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\MaterialCategory;
use \app\models\Account;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-loan-form">

    <?php $form = ActiveForm::begin();  ?>
    <?php $data = MaterialCategory::find()->all(); Yii::warning($model->material);?>
    <?= $form->field($model, 'materialId')->dropDownList(ArrayHelper::map($data,'materialCategoryId', 'name')) ?>

    <?= $form->field($model, 'accountId')->dropDownList(ArrayHelper::map(Account::find()->all(), 'id', 'email'))?>

    <?= $form->field($model, 'loanDate')->textInput() ?>

    <?= $form->field($model, 'returnDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
