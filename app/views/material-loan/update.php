<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoan $model */

$this->title = 'Update Material Loan: ' . $model->materialLoanId;
$this->params['breadcrumbs'][] = ['label' => 'Material Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->materialLoanId, 'url' => ['view', 'materialLoanId' => $model->materialLoanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
