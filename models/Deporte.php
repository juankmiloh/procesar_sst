<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deporte".
 *
 * @property integer $dep_id
 * @property string $dep_nombre
 * @property string $dep_descripcion
 * @property integer $td_id
 * @property string $dep_imagen
 * @property string $dep_estado
 *
 * @property Campeonato[] $campeonatos
 * @property TipoDeporte $td
 * @property EscenarioTieneDeportes[] $escenarioTieneDeportes
 * @property ParametrizacionDeportes $parametrizacionDeportes
 * @property Prueba[] $pruebas
 */
class Deporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deporte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_nombre', 'td_id'], 'required'],
            [['dep_descripcion'], 'string'],
            [['td_id'], 'integer'],
            [['dep_nombre'], 'string', 'max' => 150],
            [['dep_imagen'], 'string', 'max' => 120],
            [['dep_estado'], 'string', 'max' => 255],
            [['td_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDeporte::className(), 'targetAttribute' => ['td_id' => 'td_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'PK',
            'dep_nombre' => 'Nombre del deporte',
            'dep_descripcion' => 'Descripción del deporte',
            'td_id' => 'Td ID',
            'dep_imagen' => 'Dep Imagen',
            'dep_estado' => '1 - Activo, 0 - Inactivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonatos()
    {
        return $this->hasMany(Campeonato::className(), ['dep_id' => 'dep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTd()
    {
        return $this->hasOne(TipoDeporte::className(), ['td_id' => 'td_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEscenarioTieneDeportes()
    {
        return $this->hasMany(EscenarioTieneDeportes::className(), ['dep_id' => 'dep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametrizacionDeportes()
    {
        return $this->hasOne(ParametrizacionDeportes::className(), ['dep_id' => 'dep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPruebas()
    {
        return $this->hasMany(Prueba::className(), ['dep_id' => 'dep_id']);
    }
}
