<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%grupo_tiene_equipos}}".
 *
 * @property integer $gte_id
 * @property integer $gru_id
 * @property integer $eq_id
 * @property integer $gte_posicion
 */
class GrupoTieneEquipos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%grupo_tiene_equipos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gte_id', 'gru_id', 'eq_id', 'gte_posicion'], 'required'],
            [['gte_id', 'gru_id', 'eq_id', 'gte_posicion'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gte_id' => 'Gte ID',
            'gru_id' => 'Gru ID',
            'eq_id' => 'Eq ID',
            'gte_posicion' => 'Gte Posicion',
        ];
    }
}
