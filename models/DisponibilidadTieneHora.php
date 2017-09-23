<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disponibilidad_tiene_hora".
 *
 * @property integer $dth_id
 * @property integer $hor_id
 * @property integer $de_id
 *
 * @property Hora $hor
 * @property DisponibilidadEscenario $de
 */
class DisponibilidadTieneHora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disponibilidad_tiene_hora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hor_id', 'de_id'], 'required'],
            [['hor_id', 'de_id'], 'integer'],
            [['hor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hora::className(), 'targetAttribute' => ['hor_id' => 'hor_id']],
            [['de_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisponibilidadEscenario::className(), 'targetAttribute' => ['de_id' => 'de_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dth_id' => 'PK',
            'hor_id' => 'Hora',
            'de_id' => 'Disponibilidad del escenario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHor()
    {
        return $this->hasOne(Hora::className(), ['hor_id' => 'hor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDe()
    {
        return $this->hasOne(DisponibilidadEscenario::className(), ['de_id' => 'de_id']);
    }
}
