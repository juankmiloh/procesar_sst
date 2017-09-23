<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locacion".
 *
 * @property integer $loc_id
 * @property string $loc_nombre
 * @property integer $tl_id
 * @property integer $loc_padre
 *
 * @property Locacion $locPadre
 * @property Locacion[] $locacions
 * @property TipoLocacion $tl
 */
class Locacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loc_nombre', 'tl_id'], 'required'],
            [['tl_id', 'loc_padre'], 'integer'],
            [['loc_nombre'], 'string', 'max' => 55],
            [['loc_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Locacion::className(), 'targetAttribute' => ['loc_padre' => 'loc_id']],
            [['tl_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoLocacion::className(), 'targetAttribute' => ['tl_id' => 'tl_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loc_id' => 'PK',
            'loc_nombre' => 'Nombre Locacion',
            'tl_id' => 'Tipo de locación',
            'loc_padre' => 'Locación a la cual pertenece ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocPadre()
    {
        return $this->hasOne(Locacion::className(), ['loc_id' => 'loc_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocacions()
    {
        return $this->hasMany(Locacion::className(), ['loc_padre' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTl()
    {
        return $this->hasOne(TipoLocacion::className(), ['tl_id' => 'tl_id']);
    }
}
