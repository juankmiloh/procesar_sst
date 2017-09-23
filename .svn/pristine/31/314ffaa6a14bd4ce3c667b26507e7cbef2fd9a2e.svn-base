<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property integer $dptos_id
 * @property string $dptos_name
 *
 * @property Entidad[] $entidads
 * @property Municipios[] $municipios
 * @property Sede[] $sedes
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dptos_name'], 'required'],
            [['dptos_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dptos_id' => Yii::t('app', 'Dptos ID'),
            'dptos_name' => Yii::t('app', 'Dptos Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntidads()
    {
        return $this->hasMany(Entidad::className(), ['ent_dpto' => 'dptos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipios::className(), ['municipios_dptos_code' => 'dptos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedes()
    {
        return $this->hasMany(Sede::className(), ['dpto_id' => 'dptos_id']);
    }
}
