<?php

namespace app\models\data\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\data\RuleMetadata;

/**
 * RuleMetadataSearch represents the model behind the search form of `app\models\data\RuleMetadata`.
 */
class RuleMetadataSearch extends RuleMetadata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rule_metadata'], 'integer'],
            [['rules_filename', 'family', 'min_len', 'transaction_type', 'maximal_repeat_type', 'clean_mode', 'min_support', 'min_confidence'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RuleMetadata::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_rule_metadata' => $this->id_rule_metadata,
        ]);

        $query->andFilterWhere(['like', 'rules_filename', $this->rules_filename])
            ->andFilterWhere(['like', 'family', $this->family])
            ->andFilterWhere(['like', 'min_len', $this->min_len])
            ->andFilterWhere(['like', 'transaction_type', $this->transaction_type])
            ->andFilterWhere(['like', 'maximal_repeat_type', $this->maximal_repeat_type])
            ->andFilterWhere(['like', 'clean_mode', $this->clean_mode])
            ->andFilterWhere(['like', 'min_support', $this->min_support])
            ->andFilterWhere(['like', 'min_confidence', $this->min_confidence]);

        return $dataProvider;
    }
}
