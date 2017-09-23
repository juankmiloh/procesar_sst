<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fase_tiene_encuentros".
 *
 * @property integer $fts_id
 * @property string $fts_grupo
 * @property integer $equi_id_1
 * @property integer $equi_id_2
 * @property string $tfs_fecha_hora
 * @property integer $esc_id
 * @property integer $ctf_id
 * @property integer $tfs_ronda
 * @property integer $tfs_gf_1
 * @property integer $tfs_ge_1
 * @property integer $tfs_jl_1
 * @property integer $tfs_gan
 * @property integer $tfs_puntos_1
 * @property integer $tfs_gf_2
 * @property integer $tfs_ge_2
 * @property integer $tfs_jl_2
 * @property integer $tfs_puntos_2
 * @property integer $tfs_publicar
 *
 * @property EncuentrosTieneResultados[] $encuentrosTieneResultados
 * @property CampeonatoTieneFases $ctf
 * @property Equipo $equiId2
 * @property Equipo $equiId1
 * @property Escenario $esc
 * @property Equipo $tfsGan
 */
class FaseTieneEncuentros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fase_tiene_encuentros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fts_grupo', 'equi_id_1', 'equi_id_2', 'ctf_id', 'tfs_ronda'], 'required'],
            [['equi_id_1', 'equi_id_2', 'esc_id', 'ctf_id', 'tfs_ronda', 'tfs_gf_1', 'tfs_ge_1', 'tfs_jl_1', 'tfs_gan', 'tfs_puntos_1', 'tfs_gf_2', 'tfs_ge_2', 'tfs_jl_2', 'tfs_puntos_2', 'tfs_publicar'], 'integer'],
            [['tfs_fecha_hora'], 'safe'],
            [['fts_grupo'], 'string', 'max' => 1],
            [['ctf_id'], 'exist', 'skipOnError' => true, 'targetClass' => CampeonatoTieneFases::className(), 'targetAttribute' => ['ctf_id' => 'ctf_id']],
            [['equi_id_2'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id_2' => 'equi_id']],
            [['equi_id_1'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id_1' => 'equi_id']],
            [['esc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Escenario::className(), 'targetAttribute' => ['esc_id' => 'esc_id']],
            [['tfs_gan'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['tfs_gan' => 'equi_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fts_id' => Yii::t('app', 'LLave primaria'),
            'fts_grupo' => Yii::t('app', 'GRUPO A,B,C,D,E,F,G,H,I,J,K'),
            'equi_id_1' => Yii::t('app', 'Tabla equipos FK (equipo 1)'),
            'equi_id_2' => Yii::t('app', 'Tabla equipos FK (equipo 2)'),
            'tfs_fecha_hora' => Yii::t('app', 'Fecha y hora del encuentro'),
            'esc_id' => Yii::t('app', 'Tabla escenarios FK'),
            'ctf_id' => Yii::t('app', 'Tabl aCampeonato tiene fases FK'),
            'tfs_ronda' => Yii::t('app', 'Ronda o fechas'),
            'tfs_gf_1' => Yii::t('app', 'Goles a favor equipo 1'),
            'tfs_ge_1' => Yii::t('app', 'Goles en contra'),
            'tfs_jl_1' => Yii::t('app', 'Puntos por juego limpio'),
            'tfs_gan' => Yii::t('app', 'Tabla equipos FK, indica el equipo ganador'),
            'tfs_puntos_1' => Yii::t('app', 'Puntos logrados equipo 1. Por defecto 1 (Empate)'),
            'tfs_gf_2' => Yii::t('app', 'Goles a favor equipo 2'),
            'tfs_ge_2' => Yii::t('app', 'Goles en contra equipo 2'),
            'tfs_jl_2' => Yii::t('app', 'Puntos por juego limpio equipo 2'),
            'tfs_puntos_2' => Yii::t('app', 'Puntos logrados equipo 2. Por defecto 1 (Empate)'),
            'tfs_publicar' => Yii::t('app', '1 - Programación pública, 0 - sin publicar.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuentrosTieneResultados()
    {
        return $this->hasMany(EncuentrosTieneResultados::className(), ['fts_id' => 'fts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtf()
    {
        return $this->hasOne(CampeonatoTieneFases::className(), ['ctf_id' => 'ctf_id']);
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
    public function getEquiId1()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id_1']);
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
    public function getTfsGan()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'tfs_gan']);
    }
}
