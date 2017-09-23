<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enlace".
 *
 * @property integer $enl_id
 * @property string $enl_nombre
 * @property string $enl_descripcion
 * @property integer $enl_estado
 * @property string $enl_url
 * @property integer $enl_orden
 *
 * @property MenuTieneOpciones[] $menuTieneOpciones
 */
class Enlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enlace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enl_nombre'], 'required'],
            [['enl_estado', 'enl_orden'], 'integer'],
            [['enl_nombre'], 'string', 'max' => 25],
            [['enl_descripcion'], 'string', 'max' => 255],
            [['enl_url'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enl_id' => 'PK',
            'enl_nombre' => 'Nombre del enlace',
            'enl_descripcion' => 'Descripción del enlace',
            'enl_estado' => '1 - Activo, 0 - Inactivo',
            'enl_url' => 'URL a la que apunta el enlace',
            'enl_orden' => 'Enl Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuTieneOpciones()
    {
        return $this->hasMany(MenuTieneOpciones::className(), ['enl_id' => 'enl_id']);
    }
}
