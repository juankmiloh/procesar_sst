<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prueba".
 *
 * @property integer $prueb_id
 * @property string $prueb_nombre
 * @property integer $prueb_genero
 * @property integer $cat_id
 * @property integer $dep_id
 * @property integer $tipo_deporte_id
 *
 * @property Campeonato[] $campeonatos
 * @property Equipo[] $equipos
 * @property Categoria $cat
 * @property Deporte $dep
 * @property Genero $pruebGenero
 * @property TipoDeporte $tipoDeporte
 */
class Prueba extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prueba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prueb_nombre', 'prueb_genero', 'cat_id', 'dep_id', 'tipo_deporte_id'], 'required'],
            [['prueb_genero', 'cat_id', 'dep_id', 'tipo_deporte_id'], 'integer'],
            [['prueb_nombre'], 'string', 'max' => 55],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['cat_id' => 'cat_id']],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deporte::className(), 'targetAttribute' => ['dep_id' => 'dep_id']],
            [['prueb_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['prueb_genero' => 'gen_id']],
            [['tipo_deporte_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDeporte::className(), 'targetAttribute' => ['tipo_deporte_id' => 'td_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prueb_id' => Yii::t('app', 'PK'),
            'prueb_nombre' => Yii::t('app', 'Prueb Nombre'),
            'prueb_genero' => Yii::t('app', 'Prueb Genero'),
            'cat_id' => Yii::t('app', 'Categoria'),
            'dep_id' => Yii::t('app', 'Deporte'),
            'tipo_deporte_id' => Yii::t('app', 'Tabla tipo de deporte FK'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonatos()
    {
        return $this->hasMany(Campeonato::className(), ['prueb_id' => 'prueb_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['prueb_id' => 'prueb_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Categoria::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Deporte::className(), ['dep_id' => 'dep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPruebGenero()
    {
        return $this->hasOne(Genero::className(), ['gen_id' => 'prueb_genero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDeporte()
    {
        return $this->hasOne(TipoDeporte::className(), ['td_id' => 'tipo_deporte_id']);
    }
}
