<?php

namespace app\models\data\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\data\Rule;

/**
 * RuleSearch represents the model behind the search form Rules
 */
class RuleSearch extends Rule
{
    /**
     * The related protein id to search for
     * @var int
     */
    public $idProtein;

    public $family;

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Rule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // -- rule ---
        $query->andFilterWhere(['idRule' => $this->idRule]);
        $query->andFilterWhere(['like', 'rule_type', $this->rule_type]);
        $query->andFilterWhere(['like', 'rule', $this->rule]);
        $query->andFilterWhere(['like', 'antecedent', $this->antecedent]);
        $query->andFilterWhere(['like', 'consequent', $this->consequent]);
        
        $query->andFilterWhere(['>=', 'support', $this->support]);
        $query->andFilterWhere(['>=', 'confidence', $this->confidence]);
        $query->andFilterWhere(['>=', 'lift', $this->lift]);
        
        $query->andFilterWhere(['rule.id_rule_metadata' => $this->id_rule_metadata]);

        // --- rule_metadata ---
        $query->andFilterWhere(['rule_metadata.family' => $this->family]);
        
        return $dataProvider;
    }
}