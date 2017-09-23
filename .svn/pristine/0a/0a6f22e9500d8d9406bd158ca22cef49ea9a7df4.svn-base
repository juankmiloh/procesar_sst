<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sede".
 *
 * @property integer $sede_id
 * @property string $sede_nombre
 * @property integer $dpto_id
 * @property integer $muni_id
 * @property integer $sede_estado
 */
class Sede extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sede';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sede_nombre', 'dpto_id', 'muni_id'], 'required'],
            [['dpto_id', 'muni_id', 'sede_estado'], 'integer'],
            [['sede_nombre'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sede_id' => Yii::t('app', 'LLave primaria'),
            'sede_nombre' => Yii::t('app', 'Nombre de la sede'),
            'dpto_id' => Yii::t('app', 'Tabla departamentos FK'),
            'muni_id' => Yii::t('app', 'Tabla municipios FK'),
            'sede_estado' => Yii::t('app', '1 - Activo, 0 - Inactivo'),
        ];
    }
}
