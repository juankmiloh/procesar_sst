<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato_tiene_resultados".
 *
 * @property integer $ftr_id
 * @property integer $ctf_id
 * @property integer $equi_id
 * @property integer $ftr_puntos
 * @property integer $ftr_partidos_ganados
 * @property integer $ftr_partidos_perdidos
 * @property integer $ftr_partidos_emptados
 * @property integer $ftr_goles_favor
 * @property integer $ftr_goles_encontra
 * @property integer $ftr_juego_limpio
 * @property integer $ftr_clasifica
 * @property string $ftr_grupo
 *
 * @property CampeonatoTieneFases $ctf
 */
class CampeonatoTieneResultados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato_tiene_resultados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctf_id', 'equi_id', 'ftr_puntos', 'ftr_partidos_ganados', 'ftr_partidos_perdidos', 'ftr_partidos_emptados', 'ftr_goles_favor', 'ftr_goles_encontra', 'ftr_juego_limpio'], 'required'],
            [['ctf_id', 'equi_id', 'ftr_puntos', 'ftr_partidos_ganados', 'ftr_partidos_perdidos', 'ftr_partidos_emptados', 'ftr_goles_favor', 'ftr_goles_encontra', 'ftr_juego_limpio', 'ftr_clasifica'], 'integer'],
            [['ftr_grupo'], 'string', 'max' => 3],
            [['ctf_id'], 'exist', 'skipOnError' => true, 'targetClass' => CampeonatoTieneFases::className(), 'targetAttribute' => ['ctf_id' => 'ctf_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ftr_id' => Yii::t('app', 'LLave primaria'),
            'ctf_id' => Yii::t('app', 'Tabla campeonatos_tiene_fase'),
            'equi_id' => Yii::t('app', 'Tabla equipos'),
            'ftr_puntos' => Yii::t('app', 'Puntos obtenidos durante la fase del campeonato'),
            'ftr_partidos_ganados' => Yii::t('app', 'Partidos ganados durante la fase del campeonato'),
            'ftr_partidos_perdidos' => Yii::t('app', 'Partidos perdidos durante la fase del campeonato'),
            'ftr_partidos_emptados' => Yii::t('app', 'Partidos emptados durante la fase del campeonato'),
            'ftr_goles_favor' => Yii::t('app', 'Goles a favor durante la fase del campeonato'),
            'ftr_goles_encontra' => Yii::t('app', 'Goles en contra durante la fase del campeonato'),
            'ftr_juego_limpio' => Yii::t('app', 'Puntos de juego limpio durante la fase del campeonato'),
            'ftr_clasifica' => Yii::t('app', 'Clasifica a la siguiente ronda. 1 - Si, 0 - No'),
            'ftr_grupo' => Yii::t('app', 'Grupo al que pertenecia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtf()
    {
        return $this->hasOne(CampeonatoTieneFases::className(), ['ctf_id' => 'ctf_id']);
    }
}
