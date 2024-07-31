<?php

namespace app\modules\experience\controllers\backend;

use app\modules\experience\jobs\CarModelExportJob;
use app\modules\experience\models\CarModel;
use app\modules\experience\models\CarModelSearch;
use app\modules\export\widgets\ExportFilesWidget;
use app\modules\logger\jobs\SecurityExportJob;
use krok\system\components\backend\Controller;
use Yii;
use yii\base\Module;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CarModelController implements the CRUD actions for CarModel model.
 */
class CarModelController extends Controller
{
    /**
     * @var string
     */
    protected $storage;

    /**
     * @param string $id the ID of this controller.
     * @param Module $module the module that this controller belongs to.
     * @param array $config name-value pairs that will be used to initialize the object properties.
     */
    public function __construct(string $id, Module $module, array $config = [])
    {
        $this->storage = Yii::getAlias('@runtime/experience-export/car');

        parent::__construct($id, $module, $config);
    }

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
     * Lists all CarModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarModel model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CarModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CarModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CarModel model.
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
     * Deletes an existing CarModel model.
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
     * Finds the CarModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CarModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $format
     * @return Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionExport($format)
    {
        Yii::$app->queue->push(
        //Yii::createObject(SecurityExportJob::class, [
            Yii::createObject(CarModelExportJob::class, [
                Yii::$app->request->getQueryParams(),
                $this->storage,
                $format,
            ])
        );
        Yii::$app->session->addFlash('success', 'Задача на экспорт данных добавлена в очередь.');

        return $this->redirect(['index']);
    }

    /**
     * @return string|Response
     * @throws \Exception
     */
    public function actionGetExportFiles()
    {
        if (Yii::$app->request->isAjax) {
            $html = ExportFilesWidget::widget([
                'mode' => ExportFilesWidget::MODE_INNER,
                'storage' => Yii::getAlias($this->storage),
            ]);
            return $this->asJson([
                'success' => true,
                'html' => ($html ?? null),
            ]);
        }

        return '';
    }

    /**
     * @param $file
     * @return void
     * @throws \yii\base\ExitException
     */
    public function actionDownload($file)
    {
        $filename = $this->storage . '/' . $file;

        if ($filename) {
            Yii::$app->response->sendFile($filename, $file)
                ->on(Response::EVENT_AFTER_SEND, function () use ($filename) {
                    unlink($filename);
                });
        }

        Yii::$app->end();
    }

    public function actionGetModels($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $models = CarModel::find()->where(['car_brand_id' => $id])->all();

        $options = '';
        foreach($models as $model) {
            $options .= "<option value='".$model->id."'>".$model->name."</option>";
        }

        return $options;
    }

}
