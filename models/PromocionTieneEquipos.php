<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promocion_tiene_equipos".
 *
 * @property integer $pte_id
 * @property integer $prom_id
 * @property integer $equi_id
 *
 * @property Equipo $equi
 * @property Promocion $prom
 */
class PromocionTieneEquipos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocion_tiene_equipos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prom_id', 'equi_id'], 'required'],
            [['prom_id', 'equi_id'], 'integer'],
            [['equi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equi_id' => 'equi_id']],
            [['prom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promocion::className(), 'targetAttribute' => ['prom_id' => 'prom_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pte_id' => Yii::t('app', 'Llave primaria'),
            'prom_id' => Yii::t('app', 'Tabla promoción FK'),
            'equi_id' => Yii::t('app', 'Tabla equipos FK'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEqui()
    {
        return $this->hasOne(Equipo::className(), ['equi_id' => 'equi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProm()
    {
        return $this->hasOne(Promocion::className(), ['prom_id' => 'prom_id']);
    }
}
