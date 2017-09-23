<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento_tiene_sedes".
 *
 * @property integer $ets_id
 * @property integer $eve_id
 * @property integer $sede_id
 */
class EventoTieneSedes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento_tiene_sedes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eve_id', 'sede_id'], 'required'],
            [['eve_id', 'sede_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ets_id' => Yii::t('app', 'PK'),
            'eve_id' => Yii::t('app', 'Tabla eventos FK'),
            'sede_id' => Yii::t('app', 'Tabla Sede'),
        ];
    }
}
