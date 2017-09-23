<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrenador".
 *
 * @property integer $ent_id
 * @property integer $usu_id
 * @property string $ent_datos
 * @property integer $etd_id
 *
 * @property Usuario $usu
 * @property Entidad $etd
 * @property EquipoTieneEntrenadores[] $equipoTieneEntrenadores
 */
class Entrenador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrenador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ent_id', 'usu_id'], 'required'],
            [['ent_id', 'usu_id', 'etd_id'], 'integer'],
            [['ent_datos'], 'string', 'max' => 255],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
            [['etd_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['etd_id' => 'ent_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ent_id' => Yii::t('app', 'Llave primaria'),
            'usu_id' => Yii::t('app', 'Tabla usuarios FK'),
            'ent_datos' => Yii::t('app', 'Ent Datos'),
            'etd_id' => Yii::t('app', 'Etd ID'),
        ];
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
    public function getEtd()
    {
        return $this->hasOne(Entidad::className(), ['ent_id' => 'etd_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoTieneEntrenadores()
    {
        return $this->hasMany(EquipoTieneEntrenadores::className(), ['ent_id' => 'ent_id']);
    }
}
