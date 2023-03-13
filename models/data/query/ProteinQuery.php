<?php

namespace app\models\data\query;

use yii\db\ActiveQuery;

/**
 * Class ProteinQuery abstracts queries performed to the Protein model
 * @package common\models
 */
class ProteinQuery extends ActiveQuery
{
    /**
     * Filter by rule occurrences
     * @param int[] $rules
     * @return static
     */
    public function byRules($rules)
    {
        $this->andWhere('protein.idProtein IN (
            SELECT idProtein from rule_coverage rc WHERE rc.idRule IN (:rules))', [':rules'=>implode(',', $rules)]);
        return $this;
    }

}