<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;

$this->title = 'Proteínas';

$gridColumns = [
    'idProtein',
    [
        'attribute' => 'family',
        'contentOptions'=>[
            'style' => 'width: 250px;']
    ],
    'filename',
    [
        'attribute'=>'encoding',
        'format'=>'html',
        'value'=>function($data){
            return \yii\helpers\Html::a($data->encoding, ['protein/view', 'id'=>$data->idProtein]);
        },
        'contentOptions'=>[
            'style' => 'font-weight: bold;']
    ]
];

?>
<div class="site-index">

    <h1>Proteínas</h1>

    <div class="body-content">

        <div class="table-responsive small">
            <?= GridView::widget([
                'layout' => '{summary}{pager}{items}{pager}',
                'dataProvider' => $dataProvider,
                'pager' => [
                    'class' => yii\widgets\LinkPager::className(),
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'],
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
            ]); ?>
        </div>

    </div>
</div>
