<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipo_tiene_deportistas".
 *
 * @property integer $etd_id
 * @property integer $equi_id
 * @property integer $dep_id
 *
 * @property Deportistas $dep
 * @property Equipo $equi
 */
class EquipoTieneDeportistas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipo_tiene_deportistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equi_id', 'dep_id'], 'required'],
            [['equi_id', 'dep_id'], 'integer'],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deportistas::className(), 'targetAttribute' => ['dep_id' => 'dep_id']],
            [['equi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id' => 'equi_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'etd_id' => Yii::t('app', 'Llave primaria'),
            'equi_id' => Yii::t('app', 'Tabla equipos FK'),
            'dep_id' => Yii::t('app', 'Tabla deportistas FK'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Deportistas::className(), ['dep_id' => 'dep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqui()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id']);
    }
}
