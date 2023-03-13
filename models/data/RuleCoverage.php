<?php

namespace app\models\data;

use Yii;
use yii\db\ActiveRecord;
use app\models\data\Rule;
use app\models\data\Protein;

/**
 * This is the model class for table "rule_coverage".
 *
 * @property integer $idRule
 * @property integer $idProtein
 * @property double $fraction
 * @property integer $coverageMode
 * @property integer $consequentOcurrenceType
 * @property string $antecedentRepeats
 * @property string $consequentRepeats 
 * @property string $consequentRepeatsDistances
 * @property double $consequentAvgRepeatDistance
 * @property string $antecedentRepeatsDistances
 * @property string $antecedentAvgRepeatDistances
 */
class RuleCoverage extends ActiveRecord
{
    /**
     * Constants for ocurrence types for the consequent
     * @var integer
     */
    const CONSEQUENT_OCURRENCE_ISOLATED = 1;
    const CONSEQUENT_OCURRENCE_OVERLAPPING = 2;
    const CONSEQUENT_OCURRENCE_MIXED = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rule_coverage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idRule', 'idProtein', 'coverageMode', 'consequentOcurrenceType'], 'integer'],
            [['fraction', 'consequentAvgRepeatDistance'], 'number'],
            [['antecedentRepeats', 'consequentRepeatsDistances', 'consequentRepeats', 'antecedentRepeatsDistances', 'antecedentAvgRepeatDistances'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idRule' => 'Id Rule',
            'idProtein' => 'Id Protein',
            'fraction' => 'Fraction',
            'coverageMode' => 'Modo de cobertura',
            'consequentOcurrenceType' => 'Tipo de ocurrencia del consecuente',
            'antecedentRepeats' => 'Repeticiones antecedentes',
            'consequentRepeats' => 'Repeticiones consecuente',
            'antecedentAvgRepeatDistances' => 'Distancia promedio entre repeticiones consecutivas (antecedentes)',
            'consequentAvgRepeatDistance' => 'Distancia entre repeticiones consecutivas (consecuente)',
            'antecedentRepeatsDistances' => 'Distancia repeticiones consecutivas (antecedentes)',
            'consequentRepeatsDistances' => 'Distancia repeticiones consecutivas (consecuentes)',
        ];
    }


    public function getRule()
    {
        return $this->hasOne(Rule::className(), ['idRule' => 'idRule']);
    }

    public function getProtein()
    {
        return $this->hasOne(Protein::className(), ['idProtein' => 'idProtein']);
    }

    public function getOcurrenceTypeName()
    {
        switch ($this->consequentOcurrenceType) {
            case static::CONSEQUENT_OCURRENCE_ISOLATED:
                return "Aislado";
            case static::CONSEQUENT_OCURRENCE_OVERLAPPING:
                return "Overlapping";
            case static::CONSEQUENT_OCURRENCE_MIXED:
                return "Mixto";
        }
    }
}