<?php

namespace app\modules\experience\controllers\frontend;

use app\modules\experience\helpers\ExperienceHelper;
use app\modules\experience\models\CarTest;
use app\modules\experience\models\CarTrial;
use app\modules\experience\models\CarTrialProductSearch;
use app\modules\experience\models\CarTrialSelect;
use app\modules\experience\models\CarTrialSearch;
use krok\system\components\frontend\Controller;
use Yii;
use yii\web\BadRequestHttpException;

/**
 * Class TestController
 * @package app\modules\experience\controllers\frontend
 */
class CarTrialController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $params = Yii::$app->request->queryParams;
        $searchModel = new CarTrialSearch();
        $dataProvider = $searchModel->search($params);

        return $this->render('main/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionLoadMoreData()
    {
        $searchModel = new CarTrialProductSearch();
        if ($searchModel->load(Yii::$app->request->get()) && $searchModel->validate()) {
            $params = Yii::$app->request->queryParams;
            $structuredData = $searchModel->getStructuredData($params);

            $viewFile = 'main/ajaxProducts';
            $type = $params['CarTrialProductSearch']['typeSearch'] ?? "";
            if (CarTrialProductSearch::typeSearchCarTest == $type) {
                $viewFile = 'view/ajaxProducts';
            }

            $itemsHtml = $this->renderPartial($viewFile, [
                'structuredData' => $structuredData,
            ]);

            $pagination = $searchModel->getDataProvider()->pagination;
            $isLastPage = ($pagination->page + 1) >= $pagination->pageCount;

            return $this->asJson([
                'count(structuredData)' => count($structuredData),
                'pageCount' => $pagination->pageCount,
                'itemsHtml' => $itemsHtml,
                'isLastPage' => $isLastPage,
            ]);

        } else {
            throw new BadRequestHttpException('Only AJAX requests are allowed');
        }

    }


    /**
     * @param $specificationId
     * @return array
     */
    public function actionGetProductsBySpecification($specificationId)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $productOptions = CarTrialSelect::getProductOptions($specificationId);

        return [
            'productOptions' => $productOptions
        ];
    }

    /**
     * @param $carBrandId
     * @return array
     */
    public function actionGetCarModels($carBrandId)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $modelOptions = CarTrialSelect::getCarModelsOptions($carBrandId);

        return [
            'modelOptions' => $modelOptions
        ];
    }



    /**
     *
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        $model = CarTest::findOne($id);

        $carTrialsGrouped = $model->getGroupedCarTrials();
        $aComponents = array_keys($carTrialsGrouped);

        return $this->render('view/index', [
            'model' => $model,
            'carTrialsGrouped' => $carTrialsGrouped,
            'aComponents' => $aComponents,
        ]);
    }

    public function actionLoadMoreCars() {
        $productId = Yii::$app->request->get("productId", 0);
        $component = Yii::$app->request->get("component", 0);
        $page = Yii::$app->request->get("page", 1);

        $carTrialsResult = CarTrial::getByProductAndComponent($productId, $component, $page);

        return $this->asJson([
            'itemsHtml' => $this->renderPartial("_cart/cars", [
                'carTrials' => $carTrialsResult['records']
            ]),
            'isLastPage' => $carTrialsResult['isLastPage'],
        ]);
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
