<?php

namespace app\modules\experience\models;

/**
 * This is the model class for table "{{%car_brand}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CarModel[] $carModels
 */
class CarBrand extends \yii\db\ActiveRecord
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
        return '{{%car_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Марка авто',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarModels()
    {
        return $this->hasMany(CarModel::class, ['car_brand_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CarBrandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarBrandQuery(get_called_class());
    }
}
