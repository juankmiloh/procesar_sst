<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%encuentro}}".
 *
 * @property integer $enc_id
 * @property string $enc_fecha
 * @property integer $eq1_id
 * @property integer $eq2_id
 * @property integer $gru_id
 * @property integer $esc_id
 * @property integer $eve_id
 */
class Encuentro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%encuentro}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enc_id', 'enc_fecha', 'eq1_id', 'eq2_id'], 'required'],
            [['enc_id', 'eq1_id', 'eq2_id', 'gru_id', 'esc_id', 'eve_id'], 'integer'],
            [['enc_fecha'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enc_id' => 'Enc ID',
            'enc_fecha' => 'fecha del encuentro',
            'eq1_id' => 'Equipo 1 del encuentro',
            'eq2_id' => 'Equipo 2 del encuentro',
            'gru_id' => 'Grupo al cual pertenece el encuentro si es grupos',
            'esc_id' => 'Escenario en el cual se disputa el encuentro',
            'eve_id' => 'evento al cual pertenece el encuentro',
        ];
    }
}
