<?php

namespace app\modules\experience\models;

use app\behaviors\StorageBehavior\StorageBehavior;
use app\modules\experience\traits\StorageCarTrialTrait;
use app\modules\product\models\Product;
use krok\grid\interfaces\HiddenAttributeInterface;
use krok\grid\traits\HiddenAttributeTrait;
use krok\storage\dto\StorageDto;
use krok\storage\interfaces\StorageInterface;

/**
 * This is the model class for table "{{%car_trial}}".
 *
 * @property integer $id
 * @property integer $productId
 * @property integer $carTestId
 * @property integer $component
 * @property string $componentName
 * @property string $operatingTime
 * @property string $engineProtection
 * @property string $metalPropertiesStock
 * @property integer $hidden
 *
 * @property CarTest $carTest
 * @property Product $product
 *
 * @property StorageDto $preview
 * @property StorageDto $previewMobile
 */
class CarTrial extends \yii\db\ActiveRecord implements HiddenAttributeInterface, StorageInterface
{
    use HiddenAttributeTrait;
    use StorageCarTrialTrait;

    const PAGE_LIMIT_DEFAULT=8;
    const PAGE_LIMIT_CART=30;

    const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'svg'];

    const COMPONENT_INTERNAL_COMBUSTION_ENGINE = 1;
    const COMPONENT_CHASSIS = 2;
    const COMPONENT_TRANSMISSION = 3;
    const COMPONENT_SUSPENSION = 4;
    const COMPONENT_STEERING = 5;
    const COMPONENT_BRAKE_SYSTEM = 6;
    const COMPONENT_MOTOR = 7;
    const COMPONENT_AUTOMATIC_TRANSMISSION = 8;
    const COMPONENT_MANUAL_TRANSMISSION = 9;
    const COMPONENT_CVT = 10;
    const COMPONENT_POWER_TAKE_OFF_SHAFT = 11;

    const ATTRIBUTE_SRC_1 = 'src1';
    const ATTRIBUTE_SRC_2 = 'src2';

    const ATTRIBUTE_DOC_GALLERY = 'docGallery';
    const MORE_CARS_AJAX_LIMIT = 3;


    /**
     * used in CarTrialProductSearch
     * @var string
     */
    public $productComponentKey;


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'StorageBehaviorSrc1' => [
                'class' => StorageBehavior::class,
                'attribute' => self::ATTRIBUTE_SRC_1,
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'multiple' => false,
                'uploadedDirectory' => '/storage',
            ],
            'StorageBehaviorSrc2' => [
                'class' => StorageBehavior::class,
                'attribute' => self::ATTRIBUTE_SRC_2,
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'multiple' => false,
                'uploadedDirectory' => '/storage',
            ],

            'StorageGalleryBehavior' => [
                'class' => StorageBehavior::class,
                'attribute' => self::ATTRIBUTE_DOC_GALLERY,
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'multiple' => true,
                'uploadedDirectory' => '/storage',
            ],

        ];
    }

    public static function getComponentOptions()
    {
        return [
            self::COMPONENT_INTERNAL_COMBUSTION_ENGINE => 'ДВС',
            self::COMPONENT_CHASSIS => 'Шасси',
            self::COMPONENT_TRANSMISSION => 'Трансмиссия',
            self::COMPONENT_SUSPENSION => 'Ходовая часть',
            self::COMPONENT_STEERING => 'Рулевое управление',
            self::COMPONENT_BRAKE_SYSTEM => 'Тормозная система',
            self::COMPONENT_MOTOR => 'Мотор',
            self::COMPONENT_AUTOMATIC_TRANSMISSION => 'АКПП',
            self::COMPONENT_MANUAL_TRANSMISSION => 'МКПП',
            self::COMPONENT_CVT => 'Вариатор',
            self::COMPONENT_POWER_TAKE_OFF_SHAFT => 'Вал отбора мощности',
        ];
    }

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
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%car_trial}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'carTestId', 'component', 'operatingTime'], 'required'],
            [['productId', 'carTestId', 'component', 'hidden'], 'integer'],
            [['engineProtection', 'metalPropertiesStock', 'componentName',], 'string'],
            [['carTestId'], 'exist', 'skipOnError' => true, 'targetClass' => CarTest::class, 'targetAttribute' => ['carTestId' => 'id']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['productId' => 'id']],
            [
                [self::ATTRIBUTE_SRC_1, self::ATTRIBUTE_SRC_2],
                'image',
                'extensions' => self::IMAGE_EXTENSIONS,
                'skipOnEmpty' => true,
            ],
            [
                [self::ATTRIBUTE_DOC_GALLERY],
                'file',
                'extensions' => ['pdf'],
                'skipOnEmpty' => true,
                'maxFiles' => 100,
                'skipOnError' => false,
            ],
            ['hidden', 'validateHiddenChange'],
        ];
    }

    /**
     * Валидация атрибута 'hidden'.
     *
     * @param string $attribute Название атрибута
     */
    public function validateHiddenChange(string $attribute): void
    {
        if ($this->hidden == 0) {
            $carTest = $this->getCarTestRelation()->one();
            if ($carTest !== null && $carTest->hidden == 1) {
                $this->addError($attribute, 'Невозможно поменять видимость, пока связанный автомобиль невидим');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productId' => 'Продукт',
            'carTestId' => 'Автомобиль',
            'component' => 'Узел',
            'componentName' => 'Наименование узла',
            'operatingTime' => 'Наработка',
            'engineProtection' => 'Защита двигателя',
            'metalPropertiesStock' => 'Запас свойств металла',
            'hidden' => 'Скрыто',
            'carTestName' => 'Автомобиль',
            'productName' => 'Продукт',
            self::ATTRIBUTE_SRC_1 => 'Защита двигателя (Изображение)',
            self::ATTRIBUTE_SRC_2 => 'Запас свойств металла (Изображение)',
            self::ATTRIBUTE_DOC_GALLERY => 'Протоколы испытаний',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarTestRelation()
    {
        return $this->hasOne(CarTest::class, ['id' => 'carTestId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRelation()
    {
        return $this->hasOne(Product::class, ['id' => 'productId']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActiveProductRelation()
    {
        return $this->hasOne(Product::class, ['id' => 'productId'])
            ->andWhere([Product::tableName() . '.[[hidden]]' => Product::HIDDEN_NO]);
    }

    /**
     * @inheritdoc
     * @return CarTrialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarTrialQuery(get_called_class());
    }

    /**
     * Получить все испытания по productId и component с пагинацией
     *
     * @param int $productId
     * @param int $component
     * @param int $page Номер страницы
     * @param int $limit Количество результатов на страницу
     * @return array
     */
    public static function getByProductAndComponent($productId, $component, $page = 1, $limit = self::MORE_CARS_AJAX_LIMIT)
    {
        $baseCondition = [
            'productId' => $productId,
            'component' => $component,
            'hidden' => 0
        ];

        $totalCount = static::find()
            ->where($baseCondition)
            ->count();

        $totalPages = ceil($totalCount / $limit);
        $isLastPage = $page >= $totalPages;

        $offset = ($page - 1) * $limit;
        $records = static::find()
            ->where($baseCondition)
            ->offset($offset)
            ->limit($limit)
            ->all();

        return [
            'records' => $records,
            'isLastPage' => $isLastPage
        ];
    }


    public static function getActiveProductIds()
    {
        return self::find()
            ->select(self::tableName() . '.[[productId]]')
            ->joinWith('activeProductRelation')
            ->where([self::tableName() . '.[[hidden]]' => 0])
            ->distinct()
            ->column();
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return "";
    }

}
