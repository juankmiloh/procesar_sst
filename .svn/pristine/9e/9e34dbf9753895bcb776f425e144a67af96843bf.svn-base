<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_eventos".
 *
 * @property integer $te_id
 * @property string $te_nombre
 * @property string $te_descripcion
 */
class TipoEventos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_eventos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['te_nombre'], 'required'],
            [['te_nombre'], 'string', 'max' => 55],
            [['te_descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'te_id' => Yii::t('app', 'PK'),
            'te_nombre' => Yii::t('app', 'Nombre del tipo de evento'),
            'te_descripcion' => Yii::t('app', 'Descripción del tipo de evento'),
        ];
    }
}
