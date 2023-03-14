<?php

use app\models\Material;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MaterialSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->formatter->booleanFormat = ['Unavailable', 'Available'];
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=
        Yii::$app->session->get('isAdmin') ? (
        Html::a('Create Material', ['create'], ['class' => 'btn btn-success'])
        ) : (
                ""
        )
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'materialCategoryId',
                'value' => 'materialCategory.name'
            ],
            'model',
            'inventoryNumber',
            'serialNumber',
            'status:boolean',
            Yii::$app->session->get('isAdmin') ? (
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Material $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ]
            ) : (
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Material $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view}',
            ]
            ),
        ],
    ]); ?>

</div>
