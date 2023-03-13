<?php

namespace app\models\data;

use app\models\data\query\ItemQuery;
use Yii;

/**
 * This is the model class for table "item".
 *
 * @property integer $idItem
 * @property string $item
 * @property integer $itemFunction
 * @property integer $qtyRepeats
 * @property integer $qtyProteins
 * @property double $avgDistance
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * Constants for item function
     * @var integer
     */
    const FUNCTION_ANTECEDENT = 1;
    const FUNCTION_CONSEQUENT = 2;

    /**
     * Rule types and description
     * @var array
     */
    public static $_functions = [
        Item::FUNCTION_ANTECEDENT => 'Antecedente',
        Item::FUNCTION_CONSEQUENT => 'Consecuente',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item'], 'string'],
            [['avgDistance'], 'number'],
            [['qtyProteins', 'qtyRepeats', 'itemFunction'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idItem' => 'ID',
            'avgDistance' => 'Distancia promedio entre ocurrencias',
            'qtyProteins' => '# Proteínas en las que aparece',
            'qtyRepeats' => 'Cantidad de repeticiones',
            'itemFunction' => 'Función',
        ];
    }


    /**
     * @inheritdoc
     * @return ItemQuery
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

    /**
     * Return the name of the item's function type
     * @param int $id
     * @return string
     */
    public static function getFunctionName($id)
    {
        return static::$_functions[$id];
    }
}
