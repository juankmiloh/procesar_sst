<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato_tiene_fases".
 *
 * @property integer $ctf_id
 * @property string $ctf_nombre
 * @property integer $ctf_tipo_eliminacion
 * @property integer $ctf_ida_vuelta
 * @property integer $camp_id
 * @property integer $ctf_cantidad_grupos
 * @property integer $ctf_clasificados_grupo
 *
 * @property Campeonato $camp
 * @property CampeonatoTieneResultados[] $campeonatoTieneResultados
 * @property FaseTieneEncuentros[] $faseTieneEncuentros
 */
class CampeonatoTieneFases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato_tiene_fases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctf_nombre', 'ctf_tipo_eliminacion', 'camp_id'], 'required'],
            [['ctf_tipo_eliminacion', 'ctf_ida_vuelta', 'camp_id', 'ctf_cantidad_grupos', 'ctf_clasificados_grupo'], 'integer'],
            [['ctf_nombre'], 'string', 'max' => 80],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::className(), 'targetAttribute' => ['camp_id' => 'camp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ctf_id' => Yii::t('app', 'PK'),
            'ctf_nombre' => Yii::t('app', 'Nombre de la fase'),
            'ctf_tipo_eliminacion' => Yii::t('app', '1 - Eliminación por grupos, 2 - Eliminación directa'),
            'ctf_ida_vuelta' => Yii::t('app', '1 - activo, 0 - Inactivo'),
            'camp_id' => Yii::t('app', 'Tabla campeonanto FK'),
            'ctf_cantidad_grupos' => Yii::t('app', 'Eliminación por grupos: Cantidad de grupos'),
            'ctf_clasificados_grupo' => Yii::t('app', 'Eliminación por grupos: Cantidad de clasificados por cada grupo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamp()
    {
        return $this->hasOne(Campeonato::className(), ['camp_id' => 'camp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonatoTieneResultados()
    {
        return $this->hasMany(CampeonatoTieneResultados::className(), ['ctf_id' => 'ctf_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaseTieneEncuentros()
    {
        return $this->hasMany(FaseTieneEncuentros::className(), ['ctf_id' => 'ctf_id']);
    }
}
