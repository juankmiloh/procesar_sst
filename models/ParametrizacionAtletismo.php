<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametrizacion_atletismo".
 *
 * @property integer $param_at_id
 * @property integer $param_at_parametro1
 * @property integer $param_at_param1_valor
 * @property integer $param_at_parametro2
 * @property integer $param_at_param2_valor
 * @property integer $prueb_id
 * @property integer $param_at_estado
 *
 * @property Prueba $prueb
 * @property ParametrosAtletismo $paramAtParametro1
 * @property ParametrosAtletismo $paramAtParametro2
 */
class ParametrizacionAtletismo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametrizacion_atletismo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_at_parametro1', 'param_at_param1_valor', 'param_at_parametro2', 'param_at_param2_valor', 'prueb_id', 'param_at_estado'], 'required'],
            [['param_at_parametro1', 'param_at_param1_valor', 'param_at_parametro2', 'param_at_param2_valor', 'prueb_id', 'param_at_estado'], 'integer'],
            [['prueb_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prueba::className(), 'targetAttribute' => ['prueb_id' => 'prueb_id']],
            [['param_at_parametro1'], 'exist', 'skipOnError' => true, 'targetClass' => ParametrosAtletismo::className(), 'targetAttribute' => ['param_at_parametro1' => 'par_at_id']],
            [['param_at_parametro2'], 'exist', 'skipOnError' => true, 'targetClass' => ParametrosAtletismo::className(), 'targetAttribute' => ['param_at_parametro2' => 'par_at_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'param_at_id' => 'PK',
            'param_at_parametro1' => 'Parámetro 1',
            'param_at_param1_valor' => 'Valor del parámetro 1',
            'param_at_parametro2' => 'Parámetro 2',
            'param_at_param2_valor' => 'Valor del parámetro 2',
            'prueb_id' => 'Id de la prueba asociada',
            'param_at_estado' => 'Estado de la parametrización',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrueb()
    {
        return $this->hasOne(Prueba::className(), ['prueb_id' => 'prueb_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamAtParametro1()
    {
        return $this->hasOne(ParametrosAtletismo::className(), ['par_at_id' => 'param_at_parametro1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamAtParametro2()
    {
        return $this->hasOne(ParametrosAtletismo::className(), ['par_at_id' => 'param_at_parametro2']);
    }
}
