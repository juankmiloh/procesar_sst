<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametros_atletismo".
 *
 * @property integer $par_at_id
 * @property string $par_at_nombre
 * @property integer $tpr_id
 * @property integer $par_at_pos
 *
 * @property ParametrizacionAtletismo[] $parametrizacionAtletismos
 * @property ParametrizacionAtletismo[] $parametrizacionAtletismos0
 */
class ParametrosAtletismo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametros_atletismo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['par_at_nombre'], 'required'],
            [['tpr_id', 'par_at_pos'], 'integer'],
            [['par_at_nombre'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'par_at_id' => 'PK',
            'par_at_nombre' => 'Nombre parámetros',
            'tpr_id' => 'Tpr ID',
            'par_at_pos' => 'Par At Pos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametrizacionAtletismos()
    {
        return $this->hasMany(ParametrizacionAtletismo::className(), ['param_at_parametro1' => 'par_at_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametrizacionAtletismos0()
    {
        return $this->hasMany(ParametrizacionAtletismo::className(), ['param_at_parametro2' => 'par_at_id']);
    }
}
