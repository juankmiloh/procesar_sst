<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encuentros_tiene_resultados".
 *
 * @property integer $etr_id
 * @property integer $fts_id
 * @property integer $equi_id_1
 * @property integer $equi_id_2
 * @property integer $usu_id
 * @property integer $pts_id
 * @property integer $etr_minuto
 * @property integer $etr_tiempo
 *
 * @property Usuario $usu
 * @property Equipo $equiId1
 * @property Equipo $equiId2
 * @property ParametrizacionTieneSucesos $pts
 * @property ParametrizacionTieneSucesos $etrTiempo
 * @property ParametrizacionTieneSucesos $etrTiempo0
 * @property FaseTieneEncuentros $fts
 */
class EncuentrosTieneResultados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'encuentros_tiene_resultados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fts_id', 'usu_id', 'pts_id', 'etr_minuto', 'etr_tiempo'], 'required'],
            [['fts_id', 'equi_id_1', 'equi_id_2', 'usu_id', 'pts_id', 'etr_minuto', 'etr_tiempo'], 'integer'],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
            [['equi_id_1'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id_1' => 'equi_id']],
            [['equi_id_2'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id_2' => 'equi_id']],
            [['pts_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParametrizacionTieneSucesos::className(), 'targetAttribute' => ['pts_id' => 'pts_id']],
            [['etr_tiempo'], 'exist', 'skipOnError' => true, 'targetClass' => ParametrizacionTieneSucesos::className(), 'targetAttribute' => ['etr_tiempo' => 'pts_id']],
            [['etr_tiempo'], 'exist', 'skipOnError' => true, 'targetClass' => ParametrizacionTieneSucesos::className(), 'targetAttribute' => ['etr_tiempo' => 'pts_id']],
            [['fts_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaseTieneEncuentros::className(), 'targetAttribute' => ['fts_id' => 'fts_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'etr_id' => Yii::t('app', 'LLave primaria PK'),
            'fts_id' => Yii::t('app', 'Tabla Fase_tiene_encuentros FK'),
            'equi_id_1' => Yii::t('app', 'Equipo 1 que registra gol, falta'),
            'equi_id_2' => Yii::t('app', 'Equipo 2 que registra gol, falta'),
            'usu_id' => Yii::t('app', 'Tabla deportista FK'),
            'pts_id' => Yii::t('app', 'Tabla parametrización tiene sucesos FK'),
            'etr_minuto' => Yii::t('app', 'Etr Minuto'),
            'etr_tiempo' => Yii::t('app', 'Etr Tiempo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquiId1()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquiId2()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPts()
    {
        return $this->hasOne(ParametrizacionTieneSucesos::className(), ['pts_id' => 'pts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtrTiempo()
    {
        return $this->hasOne(ParametrizacionTieneSucesos::className(), ['pts_id' => 'etr_tiempo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtrTiempo0()
    {
        return $this->hasOne(ParametrizacionTieneSucesos::className(), ['pts_id' => 'etr_tiempo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFts()
    {
        return $this->hasOne(FaseTieneEncuentros::className(), ['fts_id' => 'fts_id']);
    }
}
