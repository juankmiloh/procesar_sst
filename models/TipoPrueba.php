<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_prueba".
 *
 * @property integer $tpr_id
 * @property string $tpr_nombre
 * @property string $tpr_descripcion
 * @property integer $tpr_estado
 */
class TipoPrueba extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_prueba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tpr_nombre', 'tpr_estado'], 'required'],
            [['tpr_estado'], 'integer'],
            [['tpr_nombre'], 'string', 'max' => 55],
            [['tpr_descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tpr_id' => 'PK',
            'tpr_nombre' => 'Nombre tipo prueba',
            'tpr_descripcion' => 'Descripcion tipo prueba',
            'tpr_estado' => 'Estado del tipo prueba',
        ];
    }
}
