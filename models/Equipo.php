<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipo".
 *
 * @property integer $equi_id
 * @property integer $ent_id
 * @property integer $prueb_id
 * @property string $equi_fecha_creacion
 * @property integer $equi_creado_por
 *
 * @property Entidad $ent
 * @property Prueba $prueb
 * @property EquipoTieneDeportistas[] $equipoTieneDeportistas
 * @property PromocionTieneEquipos[] $promocionTieneEquipos
 */
class Equipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ent_id', 'prueb_id', 'equi_creado_por'], 'required'],
            [['ent_id', 'prueb_id', 'equi_creado_por'], 'integer'],
            [['equi_fecha_creacion'], 'safe'],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['ent_id' => 'ent_id']],
            [['prueb_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prueba::className(), 'targetAttribute' => ['prueb_id' => 'prueb_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equi_id' => Yii::t('app', 'LLave primaria'),
            'ent_id' => Yii::t('app', 'Tabla entidad FK'),
            'prueb_id' => Yii::t('app', 'Tabla pruebas FK'),
            'equi_fecha_creacion' => Yii::t('app', 'Fecha de creación '),
            'equi_creado_por' => Yii::t('app', 'Creador del equipo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnt()
    {
        return $this->hasOne(Entidad::className(), ['ent_id' => 'ent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrueb()
    {
        return $this->hasOne(Prueba::className(), ['prueb_id' => 'prueb_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoTieneDeportistas()
    {
        return $this->hasMany(EquipoTieneDeportistas::className(), ['equi_id' => 'equi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocionTieneEquipos()
    {
        return $this->hasMany(PromocionTieneEquipos::className(), ['equi_id' => 'equi_id']);
    }
}
