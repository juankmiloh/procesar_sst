<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_campeonato".
 *
 * @property integer $gru_id
 * @property string $gru_nombre
 * @property integer $gru_estado
 * @property integer $eve_id
 */
class GrupoCampeonato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_campeonato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gru_id', 'gru_nombre', 'gru_estado', 'eve_id'], 'required'],
            [['gru_id', 'gru_estado', 'eve_id'], 'integer'],
            [['gru_nombre'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gru_id' => 'Gru ID',
            'gru_nombre' => 'Nombre o valor del grupo',
            'gru_estado' => 'Estado del grupo, es decir, sin iniciar(1), en juego(2) o finalizado(3)',
            'eve_id' => 'evento al cual pertenece el grupo',
        ];
    }
}
