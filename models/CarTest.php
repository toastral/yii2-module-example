<?php

namespace app\modules\experience\models;

use app\modules\experience\behaviors\CarTestBehavior;
use app\modules\experience\traits\StorageCarTestTrait;
use krok\grid\interfaces\HiddenAttributeInterface;
use krok\grid\traits\HiddenAttributeTrait;
use app\behaviors\StorageBehavior\StorageBehavior;
use krok\storage\dto\StorageDto;
use krok\storage\interfaces\StorageInterface;
use League\Flysystem\FilesystemInterface;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%car_test}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $car_brand_id
 * @property integer $car_model_id
 * @property string $generation
 * @property string $modification
 * @property integer $year
 * @property integer $engine_type
 * @property integer $gearbox
 * @property string $engine_model
 * @property string $mode
 * @property string $region
 * @property string $mileage
 * @property string $features
 * @property string $owner_name
 * @property integer $owner_age
 * @property string $owner_city
 * @property string $owner_review
 * @property string $owner_review_title
 * @property integer $hidden
 *
 * @property CarBrand $carBrand
 * @property CarModel $carModel
 */
class CarTest extends \yii\db\ActiveRecord implements HiddenAttributeInterface, StorageInterface
{
    use HiddenAttributeTrait;
    use StorageCarTestTrait;

    const EXTENSIONS = ['jpg', 'jpeg'];

    const SRC_HEIGHT = 700;
    const SRC_WIDTH = 1200;
    const SRC_UPLOAD_ERROR = "Загружаемое изображение должно быть в формате jpg и иметь размер 1200х700";
    const PREVIEW_W = 200;

    const ENGINE_TYPE_DIESEL = 1; // Дизель
    const ENGINE_TYPE_PETROL = 2; // Бензин

    const GEARBOX_CVT = 1; // Вариатор
    const GEARBOX_AUTO = 2; // Автомат
    const GEARBOX_MECH = 3; // Механика
    const GEARBOX_ROBO = 4; // Робот

    const ICON_W = 200;
    const ICON_H = 200;

    const ATTRIBUTE_SRC = 'src';
    const ATTRIBUTE_SRC_GALLERY = "srcGallery";


    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'StorageBehavior' => [
                'class' => StorageBehavior::class,
                'attribute' => self::ATTRIBUTE_SRC,
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'multiple' => false,
                'uploadedDirectory' => '/storage',
            ],
            'StorageGalleryBehavior' => [
                'class' => StorageBehavior::class,
                'attribute' => self::ATTRIBUTE_SRC_GALLERY,
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'multiple' => true,
                'uploadedDirectory' => '/storage',
            ],

            // Если автомобиль скрыт, то испытания тоже скрываются
            'CarTestBehavior' => [
                'class' => CarTestBehavior::class,
            ],

        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%car_test}}';
    }

    public static function getEngineTypeOptions()
    {
        return [
            self::ENGINE_TYPE_DIESEL => 'Дизель',
            self::ENGINE_TYPE_PETROL => 'Бензин',
        ];
    }


    public static function getGearboxOptions()
    {
        return [
            self::GEARBOX_CVT => 'Вариатор',
            self::GEARBOX_AUTO => 'Автомат',
            self::GEARBOX_MECH => 'Механика',
            self::GEARBOX_ROBO => 'Робот',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'car_brand_id', 'car_model_id', 'year'], 'required'],
            [['car_brand_id', 'car_model_id', 'year', 'engine_type', 'gearbox', 'owner_age', 'hidden'], 'integer'],
            [['owner_age'], 'integer', 'max' => 99],
            [['owner_review'], 'string'],
            [['name', 'generation', 'modification', 'owner_review_title'], 'string', 'max' => 255],
            [['engine_model', 'mode', 'region', 'mileage',  'owner_name'], 'string', 'max' => 30],
            [['owner_city'], 'string', 'max' => 35],
            // Валидация для полей с ограниченным набором значений
            [['engine_type'], 'in', 'range' => [self::ENGINE_TYPE_DIESEL, self::ENGINE_TYPE_PETROL]], // Дизель, Бензин
            [['gearbox'], 'in', 'range' => [self::GEARBOX_CVT, self::GEARBOX_AUTO, self::GEARBOX_MECH, self::GEARBOX_ROBO]], // Вариатор, Автомат, Механика, Робот
            //
            [['car_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarBrand::class, 'targetAttribute' => ['car_brand_id' => 'id']],
            [['car_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarModel::class, 'targetAttribute' => ['car_model_id' => 'id']],
            ['features', 'validateTextWithoutHtml'],

            [
                [self::ATTRIBUTE_SRC],
                'image',
                'extensions' => ['jpg', 'jpeg'],
                'maxFiles' => 1,
                'skipOnEmpty' => true,
            ],
            [
                [self::ATTRIBUTE_SRC_GALLERY],
                'image',
                'extensions' => self::EXTENSIONS,
                'skipOnEmpty' => true,
                'maxFiles' => 100,
                'skipOnError' => false,
                'wrongExtension' => self::SRC_UPLOAD_ERROR,
            ],

        ];
    }

    /**
     * @param $attribute
     * @return void
     */
    public function validateTextWithoutHtml($attribute)
    {
        $text = str_replace(["\r\n", "\r", "\n"], '', $this->$attribute);
        $text = str_replace('&nbsp;', ' ', $text);
        $textWithoutHtml = strip_tags($text);
        $textLength = mb_strlen($textWithoutHtml);
        if ($textLength > 500) {
            $this->addError($attribute, 'Текст не должен содержать более 500 символов без учета HTML-тегов.');
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'car_brand_id' => 'Марка',
            'car_model_id' => 'Модель',
            'generation' => 'Поколение',
            'modification' => 'Модификация',
            'year' => 'Год выпуска',
            'engine_type' => 'Двигатель тип',
            'gearbox' => 'КПП тип',
            'engine_model' => 'Двигатель модель',
            'mode' => 'Режим эксплуатации',
            'region' => 'Регион эксплуатации',
            'mileage' => 'Текущий пробег',
            'features' => 'Особенности автомобиля',
            'owner_name' => 'Имя',
            'owner_age' => 'Возраст',
            'owner_city' => 'Город',
            'owner_review' => 'Отзыв',
            'owner_review_title' => 'Заголовок отзыва',
            'hidden' => 'Скрыто',
            self::ATTRIBUTE_SRC => 'Аватар',
            self::ATTRIBUTE_SRC_GALLERY => 'Изображения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarBrand()
    {
        return $this->hasOne(CarBrand::class, ['id' => 'car_brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarModel()
    {
        return $this->hasOne(CarModel::class, ['id' => 'car_model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarTrialRelation()
    {
        return $this->hasMany(CarTrial::class, ['carTestId' => 'id']);
    }


    /**
     * Получение и группировка моделей CarTrial по компоненту
     * @return array
     */
    public function getGroupedCarTrials() {
        $carTrials = $this->getCarTrialRelation()
            ->joinWith('activeProductRelation')
            ->andWhere([CarTrial::tableName() . '.[[hidden]]' => CarTrial::HIDDEN_NO])
            ->all();

        return ArrayHelper::index($carTrials, 'id', 'component');
    }

    /**
     * @inheritdoc
     * @return CarTestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarTestQuery(get_called_class());
    }

    /**
     * @param $attribute
     * @return string|null
     * @throws \yii\base\InvalidConfigException
     */
    public function getPreview($attribute = "src"): ?string
    {
        if ($this->{$attribute} instanceof StorageDto) {
            $filesystem = Yii::createObject(FilesystemInterface::class);
            return $filesystem->getPublicUrl($this->{$attribute}->getSrc(), ['w' => self::PREVIEW_W]);
        }
        return null;
    }

    /**
     * @param $attribute
     * @return string|null
     * @throws \yii\base\InvalidConfigException
     */
    public function getIcon($attribute = "src"): ?string
    {
        if ($this->{$attribute} instanceof StorageDto) {
            $filesystem = Yii::createObject(FilesystemInterface::class);
            return $filesystem->getPublicUrl($this->{$attribute}->getSrc(), ['w' => self::ICON_W, 'h' => self::ICON_H]);
        }
        return null;
    }
    /**
     * Обновляет поле 'hidden' у связанных записей CarTrial.
     */
    public function updateHiddenInCarTrials(): void
    {
        CarTrial::updateAll(['hidden' => $this->hidden], ['carTestId' => $this->id]);
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

}
