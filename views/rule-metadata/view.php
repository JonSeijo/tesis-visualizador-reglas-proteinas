<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\data\RuleMetadata */

$this->title = $model->id_rule_metadata;
$this->params['breadcrumbs'][] = ['label' => 'Metadata Reglas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rule-metadata-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_rule_metadata',
            'rules_filename:ntext',
            'family:ntext',
            'min_len:ntext',
            'transaction_type:ntext',
            'maximal_repeat_type:ntext',
            'clean_mode:ntext',
            'min_support:ntext',
            'min_confidence:ntext',
        ],
    ]) ?>

</div>
