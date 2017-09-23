<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bitacora".
 *
 * @property integer $bit_id
 * @property integer $usu_id
 * @property string $bit_model
 * @property string $bit_fecha
 * @property string $bit_descripcion
 */
class Bitacora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bitacora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_id', 'bit_model', 'bit_descripcion'], 'required'],
            [['usu_id'], 'integer'],
            [['bit_fecha'], 'safe'],
            [['bit_descripcion'], 'string'],
            [['bit_model'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bit_id' => Yii::t('app', 'PK'),
            'usu_id' => Yii::t('app', 'Usuario'),
            'bit_model' => Yii::t('app', 'Tabla o modelo modificado'),
            'bit_fecha' => Yii::t('app', 'Fecha de creación'),
            'bit_descripcion' => Yii::t('app', 'Comentarios sobre el cambio realizado'),
        ];
    }
}