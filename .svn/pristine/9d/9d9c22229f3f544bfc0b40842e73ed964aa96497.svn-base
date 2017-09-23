<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipios".
 *
 * @property integer $municipios_id
 * @property string $municipios_name
 * @property integer $municipios_dptos_code
 * @property integer $municipios_code
 *
 * @property Entidad[] $entidads
 * @property Escenario[] $escenarios
 * @property Departamentos $municipiosDptosCode
 * @property Sede[] $sedes
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['municipios_name', 'municipios_dptos_code', 'municipios_code'], 'required'],
            [['municipios_dptos_code', 'municipios_code'], 'integer'],
            [['municipios_name'], 'string', 'max' => 50],
            [['municipios_dptos_code'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['municipios_dptos_code' => 'dptos_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'municipios_id' => Yii::t('app', 'Municipios ID'),
            'municipios_name' => Yii::t('app', 'Municipios Name'),
            'municipios_dptos_code' => Yii::t('app', 'Municipios Dptos Code'),
            'municipios_code' => Yii::t('app', 'Municipios Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntidads()
    {
        return $this->hasMany(Entidad::className(), ['ent_municipio' => 'municipios_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEscenarios()
    {
        return $this->hasMany(Escenario::className(), ['loc_id' => 'municipios_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipiosDptosCode()
    {
        return $this->hasOne(Departamentos::className(), ['dptos_id' => 'municipios_dptos_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedes()
    {
        return $this->hasMany(Sede::className(), ['muni_id' => 'municipios_id']);
    }
}
