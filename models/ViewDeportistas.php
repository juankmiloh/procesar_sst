<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_deportistas".
 *
 * @property integer $dep_id
 * @property integer $ent_id
 * @property integer $usu_id
 * @property string $nombres
 * @property string $usu_num_doc
 * @property string $ent_nombre
 * @property integer $ent_dpto
 * @property integer $ent_municipio
 */
class ViewDeportistas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_deportistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id', 'ent_id', 'usu_id', 'ent_dpto', 'ent_municipio'], 'integer'],
            [['ent_id', 'usu_id', 'ent_nombre'], 'required'],
            [['nombres'], 'string', 'max' => 111],
            [['usu_num_doc'], 'string', 'max' => 15],
            [['ent_nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => 'Dep ID',
            'ent_id' => 'Ent ID',
            'usu_id' => 'Usu ID',
            'nombres' => 'Nombres',
            'usu_num_doc' => 'Número de documento',
            'ent_nombre' => 'Nombre de la insitución',
            'ent_dpto' => 'Departamento donde esta ubicada',
            'ent_municipio' => 'Municipio donde esta ubicada',
        ];
    }
}
