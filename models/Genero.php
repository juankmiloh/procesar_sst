<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property integer $gen_id
 * @property string $gen_nombre
 * @property integer $gen_estado
 *
 * @property Campeonato[] $campeonatos
 * @property Prueba[] $pruebas
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gen_estado'], 'integer'],
            [['gen_nombre'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gen_id' => Yii::t('app', 'LLave primaria'),
            'gen_nombre' => Yii::t('app', 'Nombre del genero'),
            'gen_estado' => Yii::t('app', '1 - Estado, 0 -  Inactivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonatos()
    {
        return $this->hasMany(Campeonato::className(), ['genero_id' => 'gen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPruebas()
    {
        return $this->hasMany(Prueba::className(), ['prueb_genero' => 'gen_id']);
    }
}
