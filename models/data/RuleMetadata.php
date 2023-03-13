<?php

namespace app\models\data;

use Yii;

/**
 * This is the model class for table "rule_metadata".
 *
 * @property int $id_rule_metadata
 * @property string $rules_filename
 * @property string $family
 * @property string $min_len
 * @property string $transaction_type
 * @property string $maximal_repeat_type
 * @property string $clean_mode
 * @property string $min_support
 * @property string $min_confidence
 */
class RuleMetadata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule_metadata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rules_filename', 'family', 'min_len', 'transaction_type', 'maximal_repeat_type', 'clean_mode', 'min_support', 'min_confidence'], 'string'],
            [['rules_filename'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rule_metadata' => 'id_rule_metadata',
            'rules_filename' => 'Filename',
            'family' => 'Familia',
            'min_len' => 'min_len',
            'transaction_type' => 'Tipo transaccion',
            'maximal_repeat_type' => 'Categoría MR',
            'clean_mode' => 'Refinamiento',
            'min_support' => 'min_support',
            'min_confidence' => 'min_confidence',
        ];
    }
}
