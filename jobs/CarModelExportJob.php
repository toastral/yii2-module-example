<?php

namespace app\modules\experience\jobs;


use app\modules\experience\models\CarModel;
use app\modules\experience\models\CarModelSearch;
use app\modules\export\Export;
use app\modules\export\services\ExportStorageService;
use app\modules\logger\models\Security;
use krok\auth\models\Log;
use krok\auth\models\LogSearch;
use Yii;
use yii\base\BaseObject;
use yii\di\Instance;
use yii\helpers\Html;
use yii\queue\JobInterface;
use yii\queue\Queue;

class CarModelExportJob extends BaseObject implements JobInterface
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var string
     */
    protected $storage;

    /**
     * @var string
     */
    protected $format;

    /**
     * @param array $params
     * @param string $storage
     * @param string $format
     * @param $config
     */
    public function __construct(
        array  $params,
        string $storage,
        string $format,
               $config = []
    )
    {
        $this->params = $params;
        $this->storage = $storage;
        $this->format = $format;

        parent::__construct($config);
    }

    /**
     * @param Queue $queue
     */
    public function execute($queue)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 1 * 60 * 60);

        $exportService = new ExportStorageService($this->storage);

        $searchModel = Yii::createObject(CarModelSearch::class);
        $dataProvider = $searchModel->search($this->params);

        /** @var Export $export */
        $export = Yii::createObject([
            'class' => Export::class,
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
            'attributes' => $this->getAttributes(),
        ]);

        $export->generateChunked();
        $time = Yii::$app->getFormatter()->asDate(time(), 'php:d-m-Y');
        $filepath = $exportService->getFilePath("car-model-{$time}.{$this->format}");
        $export->saveAs($filepath, $this->format);
    }

    /**
     * @return array
     */
    protected function getAttributes(): array
    {
        return [
            'id',
            [
                'attribute' => function () {
                    return 'Модель';
                },
                'value' => function (CarModel $model) {
                    return $model->name;
                },
            ],
            [
                'attribute' => function () {
                    return 'Марка';
                },
                'value' => function (CarModel $model) {
                    return $model->carBrand->name;
                },
            ],
            [
                'attribute' => function () {
                    return 'Начало';
                },
                'value' => function (CarModel $model) {
                    return $model->start;
                },
            ],
            [
                'attribute' => function () {
                    return 'Окончание';
                },
                'value' => function (CarModel $model) {
                    return $model->end;
                },
            ],
        ];
    }
}
