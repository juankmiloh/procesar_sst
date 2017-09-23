<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $rol_id
 * @property string $rol_nombre
 * @property string $rol_descripcion
 * @property integer $rol_estado
 *
 * @property RoleTieneMenu[] $roleTieneMenus
 * @property UsuarioTieneRol[] $usuarioTieneRols
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_nombre', 'rol_descripcion', 'rol_estado'], 'required'],
            [['rol_descripcion'], 'string'],
            [['rol_estado'], 'integer'],
            [['rol_nombre'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rol_id' => 'PK',
            'rol_nombre' => 'Nombre del rol',
            'rol_descripcion' => 'Descripción del rol',
            'rol_estado' => '1-Activo, 0-Inactivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleTieneMenus()
    {
        return $this->hasMany(RoleTieneMenu::className(), ['rol_id' => 'rol_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioTieneRols()
    {
        return $this->hasMany(UsuarioTieneRol::className(), ['rol_id' => 'rol_id']);
    }
}
