<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $cat_id
 * @property string $cat_nombre
 * @property integer $cat_estado
 * @property integer $cat_edad_min
 * @property integer $cat_edad_max
 *
 * @property Campeonato[] $campeonatos
 * @property Prueba[] $pruebas
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_nombre', 'cat_estado', 'cat_edad_min', 'cat_edad_max'], 'required'],
            [['cat_estado', 'cat_edad_min', 'cat_edad_max'], 'integer'],
            [['cat_nombre'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => Yii::t('app', 'PK'),
            'cat_nombre' => Yii::t('app', 'Nombre de la categoría'),
            'cat_estado' => Yii::t('app', '1 - Activo, 0 - Inactivo'),
            'cat_edad_min' => Yii::t('app', 'Edad mínima de la categoría'),
            'cat_edad_max' => Yii::t('app', 'Edad máxima en la categoría'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampeonatos()
    {
        return $this->hasMany(Campeonato::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPruebas()
    {
        return $this->hasMany(Prueba::className(), ['cat_id' => 'cat_id']);
    }
}
