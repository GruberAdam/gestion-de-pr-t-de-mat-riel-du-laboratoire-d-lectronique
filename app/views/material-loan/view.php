<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
        <?= Html::a('Update', ['update', 'materialLoanId' => $model->materialLoanId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'materialLoanId' => $model->materialLoanId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'materialLoanId',
            [
                'attribute' => 'materialId',
                'value' => function ($data)
                {
                    return $data->materialCategory->name;
                }
            ],
            'account.email',
            'loanDate',
            'returnDate',
        ],
    ]) ?>

</div>
