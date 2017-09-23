<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property integer $ciu_id
 * @property string $ciu_nombre
 * @property integer $depa_id
 *
 * @property Departamento $depa
 * @property Escenario[] $escenarios
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ciu_nombre', 'depa_id'], 'required'],
            [['depa_id'], 'integer'],
            [['ciu_nombre'], 'string', 'max' => 55],
            [['depa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['depa_id' => 'depa_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ciu_id' => 'PK',
            'ciu_nombre' => 'Nombre de la ciudad',
            'depa_id' => 'Departamento al que pertenece la ciudad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepa()
    {
        return $this->hasOne(Departamento::className(), ['depa_id' => 'depa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEscenarios()
    {
        return $this->hasMany(Escenario::className(), ['ciu_id' => 'ciu_id']);
    }
}
