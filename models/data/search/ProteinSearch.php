<?php

namespace app\models\data\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\data\Protein;

/**
 * DiscountCodeSearch represents the model behind the search form about `common\models\DiscountCode`.
 */
class ProteinSearch extends Protein
{
    /**
     * The id of the rule to search for
     * @var int
     */
    public $idRule;

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Protein::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['idProtein' => $this->idProtein]);
        $query->andFilterWhere(['family' => $this->family]);
        $query->andFilterWhere(['like', 'encoding', $this->encoding]);
        $query->andFilterWhere(['like', 'filename', $this->filename]);

        if(!empty($this->idRule)) {
            $query->byRules([$this->idRule]);
        }

        return $dataProvider;
    }
}