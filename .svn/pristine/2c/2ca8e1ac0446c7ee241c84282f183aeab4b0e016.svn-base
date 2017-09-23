<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotos".
 *
 * @property integer $foto_id
 * @property string $foto_ruta
 * @property string $foto_fecha
 */
class Fotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foto_ruta'], 'required'],
            [['foto_fecha'], 'safe'],
            [['foto_ruta'], 'string', 'max' => 350],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'foto_id' => Yii::t('app', 'Llave primaria'),
            'foto_ruta' => Yii::t('app', 'Ruta de la foto'),
            'foto_fecha' => Yii::t('app', 'Fecha de cargue. '),
        ];
    }
}
