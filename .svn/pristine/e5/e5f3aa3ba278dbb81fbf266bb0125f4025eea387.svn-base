<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periodo_inscripciones".
 *
 * @property integer $pi_id
 * @property string $pi_nombre
 * @property string $pi_fecha_inicial
 * @property string $pi_fecha_final
 * @property string $pi_fecha_creacion
 * @property integer $pi_estado
 *
 * @property InscripcionesPorEquipo[] $inscripcionesPorEquipos
 * @property Promocion[] $promocions
 */
class PeriodoInscripciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'periodo_inscripciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pi_nombre', 'pi_fecha_inicial', 'pi_fecha_final'], 'required'],
            [['pi_fecha_inicial', 'pi_fecha_final', 'pi_fecha_creacion'], 'safe'],
            [['pi_estado'], 'integer'],
            [['pi_nombre'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pi_id' => Yii::t('app', 'LLave primaria'),
            'pi_nombre' => Yii::t('app', 'Nombre del periodo'),
            'pi_fecha_inicial' => Yii::t('app', 'Fecha inicial'),
            'pi_fecha_final' => Yii::t('app', 'Fecha final'),
            'pi_fecha_creacion' => Yii::t('app', 'Fecha de creación del periodo'),
            'pi_estado' => Yii::t('app', '1 - Activo, 0 - Inactivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscripcionesPorEquipos()
    {
        return $this->hasMany(InscripcionesPorEquipo::className(), ['pi_id' => 'pi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocions()
    {
        return $this->hasMany(Promocion::className(), ['pi_id' => 'pi_id']);
    }
}
