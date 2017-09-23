<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipo_tiene_entrenadores".
 *
 * @property integer $ete_id
 * @property integer $equi_id
 * @property integer $ent_id
 *
 * @property Entrenador $ent
 * @property Equipo $equi
 */
class EquipoTieneEntrenadores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipo_tiene_entrenadores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equi_id', 'ent_id'], 'required'],
            [['equi_id', 'ent_id'], 'integer'],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entrenador::className(), 'targetAttribute' => ['ent_id' => 'ent_id']],
            [['equi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id' => 'equi_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ete_id' => Yii::t('app', 'Llave primaria'),
            'equi_id' => Yii::t('app', 'Tabla Equipos FK'),
            'ent_id' => Yii::t('app', 'Ent ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnt()
    {
        return $this->hasOne(Entrenador::className(), ['ent_id' => 'ent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqui()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id']);
    }
}
