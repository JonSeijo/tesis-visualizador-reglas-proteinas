<?php

namespace app\models\data\query;

use yii\db\ActiveQuery;

/**
 * Class ProteinQuery abstracts queries performed to the Protein model
 * @package common\models
 */
class RuleQuery extends ActiveQuery
{
    /**
     * Filter by protein occurrences
     * @param int[] $proteins
     * @return static
     */
    public function byRules($proteins)
    {
        $this->andWhere('rule.idRule IN (
            SELECT idRule from rule_coverage rc WHERE rc.idProtein IN (:proteins))', [':proteins'=>implode(',', $proteins)]);
        return $this;
    }

}