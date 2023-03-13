<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\data\search\RuleMetadataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Metadata Reglas';
?>
<div class="rule-metadata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_rule_metadata',
            'family:ntext',
            'min_support:ntext',
            'min_confidence:ntext',
            'min_len:ntext',
            'transaction_type',
            'clean_mode',
            'maximal_repeat_type:ntext',
            'rules_filename:ntext',
        ],
    ]); ?>
</div>
