<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deportistas".
 *
 * @property integer $dep_id
 * @property integer $usu_id
 * @property string $datos_participante
 * @property integer $ent_id
 *
 * @property Entidad $ent
 * @property Usuario $usu
 * @property EquipoTieneDeportistas[] $equipoTieneDeportistas
 */
class Deportistas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deportistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_id', 'datos_participante', 'ent_id'], 'required'],
            [['usu_id', 'ent_id'], 'integer'],
            [['datos_participante'], 'string', 'max' => 255],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['ent_id' => 'ent_id']],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => Yii::t('app', 'Dep ID'),
            'usu_id' => Yii::t('app', 'Usu ID'),
            'datos_participante' => Yii::t('app', 'Datos Participante'),
            'ent_id' => Yii::t('app', 'Ent ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnt()
    {
        return $this->hasOne(Entidad::className(), ['ent_id' => 'ent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoTieneDeportistas()
    {
        return $this->hasMany(EquipoTieneDeportistas::className(), ['dep_id' => 'dep_id']);
    }
}
