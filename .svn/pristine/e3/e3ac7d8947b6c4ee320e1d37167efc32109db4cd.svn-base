<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_locacion".
 *
 * @property integer $tl_id
 * @property string $tl_nombre
 * @property string $tl_descripcion
 *
 * @property Locacion[] $locacions
 */
class TipoLocacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_locacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tl_nombre'], 'required'],
            [['tl_nombre'], 'string', 'max' => 55],
            [['tl_descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tl_id' => 'PK',
            'tl_nombre' => 'Nombre del tipo de locación',
            'tl_descripcion' => 'Descripción tipo de locación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocacions()
    {
        return $this->hasMany(Locacion::className(), ['tl_id' => 'tl_id']);
    }
}
