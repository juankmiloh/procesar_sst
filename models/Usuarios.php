<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $usu_id
 * @property string $usu_names
 * @property string $usu_apellidos
 * @property string $usu_email
 * @property string $usu_password
 *
 * @property Diagnostico[] $diagnosticos
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_id'], 'required'],
            [['usu_id'], 'integer'],
            [['usu_names', 'usu_apellidos', 'usu_email', 'usu_password'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => 'Usu ID',
            'usu_names' => 'Usu Names',
            'usu_apellidos' => 'Usu Apellidos',
            'usu_email' => 'Usu Email',
            'usu_password' => 'Usu Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticos()
    {
        return $this->hasMany(Diagnostico::className(), ['usu_id' => 'usu_id']);
    }
}
