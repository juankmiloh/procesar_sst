<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_fase".
 *
 * @property integer $tp_id
 * @property string $tp_nombre
 * @property integer $tp_estado
 *
 * @property Promocion[] $promocions
 */
class TipoFase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_fase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tp_nombre'], 'required'],
            [['tp_estado'], 'integer'],
            [['tp_nombre'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tp_id' => Yii::t('app', 'PK'),
            'tp_nombre' => Yii::t('app', 'Nombre de la fase'),
            'tp_estado' => Yii::t('app', '1 - Activo, 0 - Inactivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocions()
    {
        return $this->hasMany(Promocion::className(), ['tipo_fase_id' => 'tp_id']);
    }
}
