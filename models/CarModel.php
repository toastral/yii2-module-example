<?php

namespace app\modules\experience\models;

/**
 * This is the model class for table "{{%car_model}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $car_brand_id
 * @property integer $start
 * @property integer $end
 *
 * @property CarBrand $carBrand
 */
class CarModel extends \yii\db\ActiveRecord
{
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
        return '{{%car_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'car_brand_id'], 'required'],
            [['car_brand_id', 'start', 'end'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['car_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarBrand::class, 'targetAttribute' => ['car_brand_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Модель Авто',
            'car_brand_id' => 'Марка Авто',
            'start' => 'Start',
            'end' => 'End',
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
     * @inheritdoc
     * @return CarModelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarModelQuery(get_called_class());
    }
}
