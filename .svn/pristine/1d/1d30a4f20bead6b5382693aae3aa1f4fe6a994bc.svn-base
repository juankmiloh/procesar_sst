<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacto_escenario".
 *
 * @property integer $ce_id
 * @property string $ce_nombre
 * @property string $ce_apellidos
 * @property string $ce_telefono
 * @property string $ce_celular
 * @property string $ce_email
 *
 * @property Escenario[] $escenarios
 */
class ContactoEscenario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacto_escenario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ce_nombre', 'ce_apellidos', 'ce_celular', 'ce_email'], 'required'],
            [['ce_nombre', 'ce_apellidos', 'ce_telefono', 'ce_celular', 'ce_email'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ce_id' => 'PK',
            'ce_nombre' => 'Nombre contacto',
            'ce_apellidos' => 'Apellidos contacto',
            'ce_telefono' => 'Teléfono contacto',
            'ce_celular' => 'Celular contacto',
            'ce_email' => 'Email contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEscenarios()
    {
        return $this->hasMany(Escenario::className(), ['ce_id' => 'ce_id']);
    }
}
