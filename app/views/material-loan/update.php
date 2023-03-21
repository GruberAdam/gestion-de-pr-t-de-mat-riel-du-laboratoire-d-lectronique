<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\Material;
use \app\models\Account;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoan $model */

$this->title = 'Update Material Loan: ' . $model->materialLoanId;
$this->params['breadcrumbs'][] = ['label' => 'Material Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->materialLoanId, 'url' => ['view', 'materialLoanId' => $model->materialLoanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="material-loan-form">

        <?php $form = ActiveForm::begin();  ?>
        <?php $material = Material::findOne(['id' => $model->materialId]);
        Yii::warning($material);
        ?>
        <?php $selected = Material::find()->where(['id' => $model->materialId])->orWhere(['status' => 1])->all() ?>

        <?= $form->field($model, 'materialId')->dropDownList(ArrayHelper::map(Material::find()->where(['id' => $model->materialId])->all(), 'id', 'inventoryNumber'))->label('inventoryNumber') ?>

        <?= $form->field($model, 'accountId')->dropDownList(ArrayHelper::map(Account::find()->all(), 'id', 'email'))?>

        <?= $form->field($model, 'loanDate')->widget(\yii\jui\DatePicker::class, ['options' => ['class' => 'form-control'], 'dateFormat' => 'yyyy-MM-dd 00:00:00']) ?>

        <?= $form->field($model, 'returnDate')->widget(\yii\jui\DatePicker::class, ['options' => ['class' => 'form-control'], 'dateFormat' => 'yyyy-MM-dd 00:00:00']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
