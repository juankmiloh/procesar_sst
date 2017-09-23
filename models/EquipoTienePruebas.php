<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipo_tiene_pruebas".
 *
 * @property integer $etp_id
 * @property integer $equi_id
 * @property integer $prueb_id
 *
 * @property Equipo $equi
 * @property Prueba $prueb
 */
class EquipoTienePruebas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipo_tiene_pruebas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equi_id', 'prueb_id'], 'required'],
            [['equi_id', 'prueb_id'], 'integer'],
            [['equi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id' => 'equi_id']],
            [['prueb_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prueba::className(), 'targetAttribute' => ['prueb_id' => 'prueb_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'etp_id' => 'Etp ID',
            'equi_id' => 'Equi ID',
            'prueb_id' => 'Prueb ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqui()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrueb()
    {
        return $this->hasOne(Prueba::className(), ['prueb_id' => 'prueb_id']);
    }
}
