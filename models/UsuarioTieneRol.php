<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_tiene_rol".
 *
 * @property integer $utr_id
 * @property integer $rol_id
 * @property integer $usu_id
 *
 * @property Rol $rol
 * @property Usuario $usu
 */
class UsuarioTieneRol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_tiene_rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_id', 'usu_id'], 'required'],
            [['rol_id', 'usu_id'], 'integer'],
            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'rol_id']],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'utr_id' => 'PK',
            'rol_id' => 'Rol',
            'usu_id' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['rol_id' => 'rol_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
}
