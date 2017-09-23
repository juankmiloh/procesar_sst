<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_tiene_campeonatos".
 *
 * @property integer $utc_id
 * @property integer $usu_id
 * @property integer $camp_id
 *
 * @property Campeonato $camp
 * @property Usuario $usu
 */
class UsuarioTieneCampeonatos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_tiene_campeonatos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_id', 'camp_id'], 'required'],
            [['usu_id', 'camp_id'], 'integer'],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campeonato::className(), 'targetAttribute' => ['camp_id' => 'camp_id']],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'utc_id' => Yii::t('app', 'PK'),
            'usu_id' => Yii::t('app', 'Tabla Usuarios FK'),
            'camp_id' => Yii::t('app', 'Tabla campeonato FK'),
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
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
}
