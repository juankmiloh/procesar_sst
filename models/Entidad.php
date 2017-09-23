<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entidad".
 *
 * @property integer $ent_id
 * @property string $ent_nombre
 * @property string $ent_codigo
 * @property string $ent_direccion
 * @property string $ent_coord_x
 * @property string $ent_coord_y
 * @property integer $ent_dpto
 * @property integer $ent_municipio
 * @property string $ent_correo
 * @property string $ent_telefono
 * @property string $ent_contacto
 *
 * @property Deportistas[] $deportistas
 * @property Departamentos $entDpto
 * @property Municipios $entMunicipio
 * @property Equipo[] $equipos
 */
class Entidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ent_nombre', 'ent_codigo'], 'required'],
            [['ent_dpto', 'ent_municipio'], 'integer'],
            [['ent_nombre', 'ent_direccion'], 'string', 'max' => 255],
            [['ent_codigo'], 'string', 'max' => 50],
            [['ent_coord_x', 'ent_coord_y'], 'string', 'max' => 25],
            [['ent_correo', 'ent_contacto'], 'string', 'max' => 80],
            [['ent_telefono'], 'string', 'max' => 18],
            [['ent_correo'], 'unique'],
            [['ent_dpto'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['ent_dpto' => 'dptos_id']],
            [['ent_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::className(), 'targetAttribute' => ['ent_municipio' => 'municipios_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ent_id' => Yii::t('app', 'LLave primaria'),
            'ent_nombre' => Yii::t('app', 'Nombre de la insitución'),
            'ent_codigo' => Yii::t('app', 'Ent Codigo'),
            'ent_direccion' => Yii::t('app', 'Dirección de la entidad'),
            'ent_coord_x' => Yii::t('app', 'Coordenada X'),
            'ent_coord_y' => Yii::t('app', 'Coordenada Y'),
            'ent_dpto' => Yii::t('app', 'Departamento donde esta ubicada'),
            'ent_municipio' => Yii::t('app', 'Municipio donde esta ubicada'),
            'ent_correo' => Yii::t('app', 'Correo electrónico'),
            'ent_telefono' => Yii::t('app', 'Telefono de la entidad'),
            'ent_contacto' => Yii::t('app', 'Contacto en la institución'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeportistas()
    {
        return $this->hasMany(Deportistas::className(), ['ent_id' => 'ent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntDpto()
    {
        return $this->hasOne(Departamentos::className(), ['dptos_id' => 'ent_dpto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntMunicipio()
    {
        return $this->hasOne(Municipios::className(), ['municipios_id' => 'ent_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['ent_id' => 'ent_id']);
    }
}
