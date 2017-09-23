<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_tiene_tokens".
 *
 * @property integer $id
 * @property string $token
 * @property integer $activo
 * @property integer $id_user
 * @property string $fecha
 */
class UsuarioTieneTokens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_tiene_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'activo', 'id_user'], 'required'],
            [['activo', 'id_user'], 'integer'],
            [['fecha'], 'safe'],
            [['token'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'PK'),
            'token' => Yii::t('app', 'Token para recuperar contraseña'),
            'activo' => Yii::t('app', '1 - Activo, 0 - Inactivo'),
            'id_user' => Yii::t('app', 'Id User'),
            'fecha' => Yii::t('app', 'Fecha de recuperación de contraseña'),
        ];
    }
}
