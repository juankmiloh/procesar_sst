<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_tiene_opciones".
 *
 * @property integer $mto_id
 * @property integer $menu_id
 * @property integer $enl_id
 *
 * @property Enlace $enl
 * @property Menu $menu
 */
class MenuTieneOpciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_tiene_opciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'enl_id'], 'required'],
            [['menu_id', 'enl_id'], 'integer'],
            [['enl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enlace::className(), 'targetAttribute' => ['enl_id' => 'enl_id']],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'menu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mto_id' => 'PK',
            'menu_id' => 'Tabla menu FK',
            'enl_id' => 'Tabla enlace FK',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnl()
    {
        return $this->hasOne(Enlace::className(), ['enl_id' => 'enl_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['menu_id' => 'menu_id']);
    }
}
