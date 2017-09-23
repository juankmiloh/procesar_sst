<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_deporte".
 *
 * @property integer $td_id
 * @property string $td_nombre
 * @property string $td_descripcion
 */
class TipoDeporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_deporte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['td_nombre'], 'required'],
            [['td_nombre'], 'string', 'max' => 55],
            [['td_descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'td_id' => 'PK',
            'td_nombre' => 'Tipo deporte nombre',
            'td_descripcion' => 'Tipo deporte descripción',
        ];
    }
}
