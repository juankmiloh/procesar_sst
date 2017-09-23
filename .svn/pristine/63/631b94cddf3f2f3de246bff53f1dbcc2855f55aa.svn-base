<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_documento".
 *
 * @property integer $tid_id
 * @property string $tid_nombre
 * @property string $tid_abre
 *
 * @property Usuario[] $usuarios
 */
class TipoDocumento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid_nombre'], 'required'],
            [['tid_nombre'], 'string', 'max' => 25],
            [['tid_abre'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tid_id' => Yii::t('app', 'PK'),
            'tid_nombre' => Yii::t('app', 'Nombre del tipo de documento'),
            'tid_abre' => Yii::t('app', 'Nombre abreviado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['usu_tipo_doc' => 'tid_id']);
    }
}
