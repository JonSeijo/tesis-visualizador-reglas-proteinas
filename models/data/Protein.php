<?php

namespace app\models\data;

use app\models\data\query\ProteinQuery;
use app\models\data\RuleCoverage;
use Yii;

/**
 * This is the model class for table "protein".
 *
 * @property integer $idProtein
 * @property string $family
 * @property string $filename
 * @property string $encoding
 */
class Protein extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'protein';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['family', 'filename', 'encoding'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProtein' => 'ID',
            'family' => 'Familia',
            'filename' => 'Archivo',
            'encoding' => 'Codificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRulesForProtein()
    {
        return $this->hasMany(Rule::className(), ['idRule' => 'idRule'])
            ->viaTable('rule_coverage', ['idProtein' => 'idProtein'])
            ->orderBy('rule_type');
    }

    public function getRuleCoverage()
    {
        return $this->hasMany(RuleCoverage::className(), ['idProtein' => 'idProtein']);
    }

    /**
     * @inheritdoc
     * @return ProteinQuery
     */
    public static function find()
    {
        return new ProteinQuery(get_called_class());
    }
}
