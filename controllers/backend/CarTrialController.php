<?php

namespace app\modules\experience\controllers\backend;

use app\modules\experience\models\CarTrial;
use krok\storage\services\DeleteService;
use League\Flysystem\FilesystemInterface;
use Yii;
use app\modules\experience\models\CarTrialSearch;
use krok\system\components\backend\Controller;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarTrialController implements the CRUD actions for CarTest model.
 */
class CarTrialController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CarTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarTrialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new CarTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CarTrial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CarTrial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CarTrial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @param $attribute
     * @return \yii\web\Response
     * @throws InvalidConfigException
     */
    public function actionDeleteImage($id, $attribute): \yii\web\Response
    {
        $model = $this->findModel($id);
        $model->deleteFile($model, $model->$attribute->getSrc(), $attribute);
        return $this->redirect(['update', 'id' => $model->id]);
    }

    /**
     * @param int $id
     * @param string $attribute
     * @return void|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRemoveFile(int $id, string $attribute)
    {
        $model = $this->findModel($id);
        if ($model !== null && $file = Yii::$app->request->post('key')) {
            if ($model->deleteFile($model, $file, $attribute) !== false) {
                return $this->asJson(['success' => 'Файл успешно удален']);
            } else {
                return $this->asJson(['error' => 'Ошибка удаления файла']);
            }
        }
    }

    /**
     * Finds the CarTrial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CarTrial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarTrial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
