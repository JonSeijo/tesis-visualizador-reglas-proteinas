<?php

namespace app\models\data;

use app\models\data\query\RuleQuery;
use Yii;

/**
 * This is the model class for table "rule".
 *
 * @property int $idRule
 * @property string $rule
 * @property string $antecedent
 * @property string $consequent
 * @property string $rule_type
 * @property string $rule_type_simple
 * @property int $rule_size
 * @property int $count
 * @property double $support
 * @property double $confidence
 * @property double $lift
 * @property int $id_rule_metadata
 */
class Rule extends \yii\db\ActiveRecord
{

    const ATTRIBUTE_ROUND_PRECISION = 5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rule', 'antecedent', 'consequent', 'rule_type', 'rule_type_simple', 'family'], 'string'],
            [['rule_size', 'count', 'id_rule_metadata'], 'integer'],
            [['support', 'confidence', 'lift'], 'number'],
            [['id_rule_metadata'], 'exist', 'skipOnError' => true, 'targetClass' => RuleMetadata::className(), 'targetAttribute' => ['id_rule_metadata' => 'id_rule_metadata']],
       ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idRule' => 'id_regla',
            'rule' => 'Regla',
            'antecedent' => 'Antecedente',
            'consequent' => 'Consequente',
            'rule_type' => 'Tipo',
            'rule_type_simple' => 'Tipo general',
            'rule_size' => 'Tamaño',
            'count' => 'Count',
            'support' => 'Soporte',
            'confidence' => 'Confianza',
            'lift' => 'Lift',
            'id_rule_metadata' => 'id_rule_metadata',
            'family' => 'Familia'
        ];
    }

    public function roundAttribute($value) {
        return round($value, Rule::ATTRIBUTE_ROUND_PRECISION);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProteinsForRule()
    {
        return $this->hasMany(Protein::className(), ['idProtein' => 'idProtein'])
            ->viaTable('rule_coverage', ['idRule' => 'idRule']);
    }

    /**
     * @inheritdoc
     * @return RuleQuery
     */
    public static function find() {
        $query = new RuleQuery(get_called_class()); 
        $query->joinWith(['rule_metadata']);
        return $query;
    }

    /**
     * Returns the parts of a rule in a string
     * @return string
     */
    public function getParts()
    {
        return $this->antecedent.', '.$this->consequent;
    }

    // Nombre debe ser asi por convencion de Yii...
    public function getRule_metadata() {
        return $this->hasOne(RuleMetadata::className(), ['id_rule_metadata' => 'id_rule_metadata']);
    }

    public function getRuleTypeName() {
        return $this->rule_type;
    }

    public function getFamily() {
        return $this->rule_metadata->family;
    }
}