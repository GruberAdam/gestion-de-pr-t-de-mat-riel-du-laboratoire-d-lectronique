<?php

namespace app\controllers;

use app\models\Material;
use app\models\MaterialLoan;
use app\models\MaterialLoanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * MaterialLoanController implements the CRUD actions for MaterialLoan model.
 */
class MaterialLoanController extends Controller
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
     * Lists all MaterialLoan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $searchModel = new MaterialLoanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaterialLoan model.
     * @param int $materialLoanId Material Loan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($materialLoanId)
    {
        return $this->render('view', [
            'model' => $this->findModel($materialLoanId),
        ]);
    }

    /**
     * Creates a new MaterialLoan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        /* Checks that user is admin */
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $model = new MaterialLoan();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $material = Material::find()->where(['id' => $model->materialId])->all()[0];
                $material['status'] = 0;

                if (!$material->validate()){
                    \Yii::warning($material->getErrors());
                }
                $material->update();

                return $this->redirect(['view', 'materialLoanId' => $model->materialLoanId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MaterialLoan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $materialLoanId Material Loan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionUpdate($materialLoanId)
    {
        /* Checks that user is admin */
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $model = $this->findModel($materialLoanId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            return $this->redirect(['view', 'materialLoanId' => $model->materialLoanId]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MaterialLoan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $materialLoanId Material Loan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($materialLoanId)
    {
        /* Checks that user is admin */
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $this->findModel($materialLoanId)->delete();

        return $this->redirect(['index']);
    }

    public function actionMaterialReturned($materialId){
        /* Checks that user is admin */
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "You are not allowed to go on this page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $material = Material::findOne(['id' => $materialId]);
        $material->status = 1;

        $loan = MaterialLoan::findOne(['materialId' => $materialId]);
        $loan->active = 0;
        Yii::warning($loan->active);

        if (!$material->validate() || !$loan->validate()){
            Yii::warning($material->getErrors());
            Yii::warning($loan->getErrors());
        }
        $material->update();
        $loan->update();
        return $this->redirect(['index']);
    }

    /**
     * Finds the MaterialLoan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $materialLoanId Material Loan ID
     * @return MaterialLoan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($materialLoanId)
    {
        if (($model = MaterialLoan::findOne(['materialLoanId' => $materialLoanId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
