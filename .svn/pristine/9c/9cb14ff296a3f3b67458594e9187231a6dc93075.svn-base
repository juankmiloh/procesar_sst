<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disponibilidad_escenario".
 *
 * @property integer $de_id
 * @property string $de_fecha_ini
 * @property string $de_fecha_fin
 * @property integer $esc_id
 *
 * @property Escenario $esc
 * @property DisponibilidadTieneHora[] $disponibilidadTieneHoras
 */
class DisponibilidadEscenario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disponibilidad_escenario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['de_fecha_ini', 'de_fecha_fin'], 'required'],
            [['de_fecha_ini', 'de_fecha_fin'], 'safe'],
            [['esc_id'], 'integer'],
            [['esc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Escenario::className(), 'targetAttribute' => ['esc_id' => 'esc_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'de_id' => 'PK',
            'de_fecha_ini' => 'Fecha inicial',
            'de_fecha_fin' => 'Fecha final',
            'esc_id' => 'Escenario asociado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsc()
    {
        return $this->hasOne(Escenario::className(), ['esc_id' => 'esc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisponibilidadTieneHoras()
    {
        return $this->hasMany(DisponibilidadTieneHora::className(), ['de_id' => 'de_id']);
    }
}
