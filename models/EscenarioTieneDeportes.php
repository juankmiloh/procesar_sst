<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "escenario_tiene_deportes".
 *
 * @property integer $estd_id
 * @property integer $esc_id
 * @property integer $dep_id
 * @property integer $estd_activo
 *
 * @property Escenario $esc
 * @property Deporte $dep
 */
class EscenarioTieneDeportes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'escenario_tiene_deportes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['esc_id', 'dep_id'], 'required'],
            [['esc_id', 'dep_id', 'estd_activo'], 'integer'],
            [['esc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Escenario::className(), 'targetAttribute' => ['esc_id' => 'esc_id']],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deporte::className(), 'targetAttribute' => ['dep_id' => 'dep_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'estd_id' => 'PK',
            'esc_id' => 'Escenario asociado',
            'dep_id' => 'Deporte asociado',
            'estd_activo' => 'Registro activo/inactivo',
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
    public function getDep()
    {
        return $this->hasOne(Deporte::className(), ['dep_id' => 'dep_id']);
    }
}
