<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato_tiene_escenarios".
 *
 * @property integer $cte_id
 * @property integer $camp_id
 * @property integer $esc_id
 *
 * @property Campeonato $camp
 * @property Escenario $esc
 * @property FaseTieneEncuentros[] $faseTieneEncuentros
 */
class CampeonatoTieneEscenarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato_tiene_escenarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['camp_id', 'esc_id'], 'required'],
            [['camp_id', 'esc_id'], 'integer'],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::className(), 'targetAttribute' => ['camp_id' => 'camp_id']],
            [['esc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Escenario::className(), 'targetAttribute' => ['esc_id' => 'esc_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cte_id' => Yii::t('app', 'PK'),
            'camp_id' => Yii::t('app', 'Tabla campeonato FK'),
            'esc_id' => Yii::t('app', 'Tabla escenarios'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamp()
    {
        return $this->hasOne(Campeonato::className(), ['camp_id' => 'camp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsc()
    {
        return $this->hasOne(Escenario::className(), ['esc_id' => 'esc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaseTieneEncuentros()
    {
        return $this->hasMany(FaseTieneEncuentros::className(), ['esc_id' => 'esc_id']);
    }
}
