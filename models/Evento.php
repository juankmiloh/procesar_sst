<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property integer $eve_id
 * @property string $eve_nombre
 * @property string $eve_fecha_ini
 * @property string $eve_fecha_fin
 * @property string $eve_sede
 * @property string $eve_detalle
 * @property integer $prom_id
 * @property integer $eve_activo
 *
 * @property Promocion $prom
 * @property EventoTieneDeportes[] $eventoTieneDeportes
 * @property EventoTieneRegiones[] $eventoTieneRegiones
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eve_nombre', 'eve_fecha_ini', 'eve_fecha_fin', 'prom_id'], 'required'],
            [['eve_fecha_ini', 'eve_fecha_fin'], 'safe'],
            [['prom_id', 'eve_activo'], 'integer'],
            [['eve_nombre'], 'string', 'max' => 100],
            [['eve_detalle'], 'string', 'max' => 200],
            [['prom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promocion::className(), 'targetAttribute' => ['prom_id' => 'prom_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eve_id' => Yii::t('app', 'PK'),
            'eve_nombre' => Yii::t('app', 'Nombre del evento'),
            'eve_fecha_ini' => Yii::t('app', 'Fecha inicio'),
            'eve_fecha_fin' => Yii::t('app', 'Fecha fin'),
            'eve_detalle' => Yii::t('app', 'Comentarios sobre el evento'),
            'prom_id' => Yii::t('app', 'Promoción FK'),
            'eve_activo' => Yii::t('app', '1 - Activo, 0 - Inactivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProm()
    {
        return $this->hasOne(Promocion::className(), ['prom_id' => 'prom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoTieneDeportes()
    {
        return $this->hasMany(EventoTieneDeportes::className(), ['eve_id' => 'eve_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoTieneRegiones()
    {
        return $this->hasMany(EventoTieneRegiones::className(), ['eve_id' => 'eve_id']);
    }
}
