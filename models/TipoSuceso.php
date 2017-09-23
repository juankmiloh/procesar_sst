<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_suceso".
 *
 * @property integer $ts_id
 * @property string $ts_nombre
 *
 * @property ParametrizacionTieneSucesos[] $parametrizacionTieneSucesos
 */
class TipoSuceso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_suceso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ts_nombre'], 'required'],
            [['ts_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ts_id' => Yii::t('app', 'Llave primaria'),
            'ts_nombre' => Yii::t('app', 'TIpo de suceso'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametrizacionTieneSucesos()
    {
        return $this->hasMany(ParametrizacionTieneSucesos::className(), ['ts_id' => 'ts_id']);
    }
}
