<?php

namespace app\controllers;

use app\models\MaterialLoan;
use app\models\MaterialLoanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = new MaterialLoan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
        $model = $this->findModel($materialLoanId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            return $this->redirect(['view', 'materialLoanId' => $model->materialLoanId]);
        }
        \Yii::warning($model->getErrors());
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
        $this->findModel($materialLoanId)->delete();

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
