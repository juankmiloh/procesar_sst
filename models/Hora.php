<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hora".
 *
 * @property integer $hor_id
 * @property string $hor_nombre_24_horas
 * @property string $hor_nombre_12_horas
 *
 * @property DisponibilidadTieneHora[] $disponibilidadTieneHoras
 */
class Hora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hor_nombre_24_horas', 'hor_nombre_12_horas'], 'required'],
            [['hor_nombre_24_horas', 'hor_nombre_12_horas'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hor_id' => 'PK',
            'hor_nombre_24_horas' => 'Nombre formato 24 horas',
            'hor_nombre_12_horas' => 'Nombre formato 12 horas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisponibilidadTieneHoras()
    {
        return $this->hasMany(DisponibilidadTieneHora::className(), ['hor_id' => 'hor_id']);
    }
}
