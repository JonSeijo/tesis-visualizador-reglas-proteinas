<?php

/* @var $this yii\web\View */

use app\models\data\Rule;
use yii\grid\GridView;

$this->title = 'Reglas';
?>
<div class="site-index">

    <h1>Reglas</h1>

    <div class="body-content">

        <div class="table-responsive">
            <?= GridView::widget([
                'layout' => '{summary}{pager}{items}{pager}',
                'dataProvider' => $dataProvider,
                'pager' => [
                    'class' => yii\widgets\LinkPager::className(),
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'],
                'filterModel' => $searchModel,
                'columns' => [
                    'idRule',
                    [
                        'attribute' => 'id_rule_metadata',
                        'contentOptions'=>[
                            'style' => 'width: 100px;']
                    ],
                    [
                        'attribute' => 'family',
                        'contentOptions'=>[
                            'style' => 'width: 100px;']
                    ],
                    [
                        'attribute'=>'rule',
                        'format'=>'html',
                        'value'=>function($data){
                            return \yii\helpers\Html::a($data->rule, ['rule/view', 'id'=>$data->idRule]);
                        },
                        'contentOptions'=>['style'=>'font-weight: bold;
                            width: 300px;'
                        ]
                    ],
                    [
                        'attribute'=>'support',
                        'value' => function($data) {
                            return Rule::roundAttribute($data->support);
                        },
                    ],
                    [
                        'attribute'=>'confidence',
                        'value' => function($data) {
                            return Rule::roundAttribute($data->confidence);
                        },
                    ],
                    [
                        'attribute'=>'lift',
                        'value' => function($data) {
                            return Rule::roundAttribute($data->lift);
                        },
                    ],
                    'rule_type',
                ],
            ]); ?>
        </div>

    </div>
</div>
