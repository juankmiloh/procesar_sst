<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $reg_id
 * @property string $reg_nombre
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_nombre'], 'required'],
            [['reg_nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reg_id' => Yii::t('app', 'Llave primaria'),
            'reg_nombre' => Yii::t('app', 'Nombre de la región'),
        ];
    }
}
