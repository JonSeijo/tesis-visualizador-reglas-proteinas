<?php

namespace app\models\data\search;

use app\models\data\Item;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Item represents the model behind the search form about Items.
 */
class ItemSearch extends Item
{
    /**
     * The id of the item to search for
     * @var int
     */
    public $idItem;

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['itemFunction' => $this->itemFunction]);
        $query->andFilterWhere(['idItem' => $this->idItem]);
        $query->andFilterWhere(['like', 'item', $this->item]);


        return $dataProvider;
    }
}