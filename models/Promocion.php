<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promocion".
 *
 * @property integer $prom_id
 * @property integer $prom_fase_anterior
 * @property integer $tipo_fase_id
 * @property string $prom_nombre
 *
 * @property Evento[] $eventos
 * @property Promocion $promFaseAnterior
 * @property Promocion[] $promocions
 * @property TipoFase $tipoFase
 * @property PromocionTieneParticipantes[] $promocionTieneParticipantes
 */
class Promocion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prom_fase_anterior', 'tipo_fase_id', 'prom_activo'], 'integer'],
            [['tipo_fase_id', 'prom_nombre'], 'required'],
            [['prom_nombre'], 'string', 'max' => 55],
            [['prom_fase_anterior'], 'exist', 'skipOnError' => true, 'targetClass' => Promocion::className(), 'targetAttribute' => ['prom_fase_anterior' => 'prom_id']],
            [['tipo_fase_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoFase::className(), 'targetAttribute' => ['tipo_fase_id' => 'tp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prom_id' => Yii::t('app', 'PK'),
            'prom_fase_anterior' => Yii::t('app', 'Fase anterior'),
            'tipo_fase_id' => Yii::t('app', 'Tipo de fase FK'),
            'prom_nombre' => Yii::t('app', 'Nombre de la promoción'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['prom_id' => 'prom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromFaseAnterior()
    {
        return $this->hasOne(Promocion::className(), ['prom_id' => 'prom_fase_anterior']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocions()
    {
        return $this->hasMany(Promocion::className(), ['prom_fase_anterior' => 'prom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoFase()
    {
        return $this->hasOne(TipoFase::className(), ['tp_id' => 'tipo_fase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocionTieneParticipantes()
    {
        return $this->hasMany(PromocionTieneParticipantes::className(), ['prom_id' => 'prom_id']);
    }
}
