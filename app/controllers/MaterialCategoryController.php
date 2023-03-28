<?php

namespace app\controllers;

use app\models\MaterialCategory;
use app\models\MaterialCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * MaterialCategoryController implements the CRUD actions for MaterialCategory model.
 */
class MaterialCategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MaterialCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }
        $searchModel = new MaterialCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaterialCategory model.
     * @param int $materialCategoryId Material Category I
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($materialCategoryId)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }
        return $this->render('view', [
            'model' => $this->findModel($materialCategoryId),
        ]);
    }

    /**
     * Creates a new MaterialCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $model = new MaterialCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'materialCategoryId' => $model->materialCategoryId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MaterialCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $materialCategoryId Material Category I
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($materialCategoryId)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $model = $this->findModel($materialCategoryId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'materialCategoryId' => $model->materialCategoryId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MaterialCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $materialCategoryId Material Category I
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($materialCategoryId)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $this->findModel($materialCategoryId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaterialCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $materialCategoryId Material Category I
     * @return MaterialCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($materialCategoryId)
    {
        if (($model = MaterialCategory::findOne(['materialCategoryId' => $materialCategoryId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
