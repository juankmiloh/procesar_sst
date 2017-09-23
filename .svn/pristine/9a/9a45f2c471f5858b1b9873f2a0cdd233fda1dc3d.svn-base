<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametrizacion_tiene_sucesos".
 *
 * @property integer $pts_id
 * @property integer $param_id
 * @property string $pts_suceso
 * @property integer $pts_suceso_valor
 * @property integer $ts_id
 * @property integer $pts_rol
 *
 * @property EncuentrosTieneResultados[] $encuentrosTieneResultados
 * @property EncuentrosTieneResultados[] $encuentrosTieneResultados0
 * @property EncuentrosTieneResultados[] $encuentrosTieneResultados1
 * @property TipoSuceso $ts
 * @property ParametrizacionDeportes $param
 */
class ParametrizacionTieneSucesos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametrizacion_tiene_sucesos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_id', 'pts_suceso', 'pts_suceso_valor'], 'required'],
            [['param_id', 'pts_suceso_valor', 'ts_id', 'pts_rol'], 'integer'],
            [['pts_suceso'], 'string', 'max' => 100],
            [['ts_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSuceso::className(), 'targetAttribute' => ['ts_id' => 'ts_id']],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParametrizacionDeportes::className(), 'targetAttribute' => ['param_id' => 'param_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pts_id' => Yii::t('app', 'Pts ID'),
            'param_id' => Yii::t('app', 'Tabla parametrización deportes'),
            'pts_suceso' => Yii::t('app', 'Nombre del suceso. Falta, gol, autogol, set'),
            'pts_suceso_valor' => Yii::t('app', 'Valor del suceso. Puntos que suma o resta'),
            'ts_id' => Yii::t('app', 'Tabla tipo de suceso FK'),
            'pts_rol' => Yii::t('app', 'Constantes \"ROLES_PARTICIPANTE\"'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuentrosTieneResultados()
    {
        return $this->hasMany(EncuentrosTieneResultados::className(), ['pts_id' => 'pts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuentrosTieneResultados0()
    {
        return $this->hasMany(EncuentrosTieneResultados::className(), ['etr_tiempo' => 'pts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuentrosTieneResultados1()
    {
        return $this->hasMany(EncuentrosTieneResultados::className(), ['etr_tiempo' => 'pts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTs()
    {
        return $this->hasOne(TipoSuceso::className(), ['ts_id' => 'ts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParam()
    {
        return $this->hasOne(ParametrizacionDeportes::className(), ['param_id' => 'param_id']);
    }
}
