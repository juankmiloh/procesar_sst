<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deportista_tiene_numero".
 *
 * @property integer $dtn_id
 * @property integer $etd_id
 * @property integer $dtn_numero
 *
 * @property EquipoTieneDeportistas $etd
 */
class DeportistaTieneNumero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deportista_tiene_numero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['etd_id'], 'required'],
            [['etd_id', 'dtn_numero'], 'integer'],
            [['etd_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipoTieneDeportistas::className(), 'targetAttribute' => ['etd_id' => 'etd_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dtn_id' => 'PK',
            'etd_id' => 'Equipo tiene deportista id',
            'dtn_numero' => 'Número asignado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtd()
    {
        return $this->hasOne(EquipoTieneDeportistas::className(), ['etd_id' => 'etd_id']);
    }
}
