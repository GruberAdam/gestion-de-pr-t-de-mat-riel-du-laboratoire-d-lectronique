<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Material;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoan $model */

$this->title = $model->materialLoanId;
$this->params['breadcrumbs'][] = ['label' => 'Material Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="material-loan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'materialLoanId' => $model->materialLoanId], ['class' => 'btn btn-primary'])  ?>
        <?= Html::a('Delete', ['delete', 'materialLoanId' => $model->materialLoanId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])  ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'materialLoanId',
            [
                    'label' => 'Material ID',
                'attribute' => 'materialId'
            ],
            [
                'attribute' => 'materialId',
                'value' => function ($data)
                {
                    return $data->materialCategory->name;
                }
            ],
            'material.inventoryNumber',
            'account.email',
            'loanDate',
            'returnDate',
        ],
    ]) ?>

    <?php
    if (\app\models\MaterialLoan::findOne(['materialLoanId' => $model->materialLoanId])['active'] == 1){
        echo Html::a('Confirm return of the material', ['material-returned', 'materialId' => $model->materialId], ['class' => 'btn btn-success']);
    }
    ?>


</div>
