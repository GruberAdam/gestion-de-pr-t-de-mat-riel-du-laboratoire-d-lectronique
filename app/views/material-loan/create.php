<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoan $model */

$this->title = 'Create Material Loan';
$this->params['breadcrumbs'][] = ['label' => 'Material Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-loan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
