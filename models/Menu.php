<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $menu_id
 * @property string $menu_nombre
 * @property string $menu_descripcion
 * @property integer $menu_estado
 *
 * @property MenuTieneOpciones[] $menuTieneOpciones
 * @property RoleTieneMenu[] $roleTieneMenus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_nombre'], 'required'],
            [['menu_estado'], 'integer'],
            [['menu_nombre'], 'string', 'max' => 25],
            [['menu_descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'PK',
            'menu_nombre' => 'Nombre del menu',
            'menu_descripcion' => 'Descripción del menu',
            'menu_estado' => '1 - Activo, 0 - Inactivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuTieneOpciones()
    {
        return $this->hasMany(MenuTieneOpciones::className(), ['menu_id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleTieneMenus()
    {
        return $this->hasMany(RoleTieneMenu::className(), ['menu_id' => 'menu_id']);
    }
}
