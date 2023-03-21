<?php

use app\models\MaterialLoan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MaterialLoanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Material Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-loan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Material Loan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'materialLoanId',
            [
                'attribute' => 'materialId',
                'value' => function ($data)
                {
                    return $data->materialCategory->name;
                }
            ],
            [
                    'attribute' => 'accountId',
                'value' => 'account.email'
            ],
            'loanDate',
            'returnDate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MaterialLoan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'materialLoanId' => $model->materialLoanId]);
                 },
            ],
        ],
    ]); ?>


</div>
