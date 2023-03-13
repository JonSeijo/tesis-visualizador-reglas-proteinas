<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $searchModel app\models\data\search\ItemSearch */

use yii\grid\GridView;
use app\models\data\Item;

$this->title = 'Items';
?>
<div class="site-index">

    <h1>Items</h1>

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
                'columns' => [
                    'idItem',
                    'item',
                    [
                        'attribute'=>'itemFunction',
                        'filter'=>Item::$_functions,
                        'value'=>function($data){
                            return \app\models\data\Item::getFunctionName($data->itemFunction);
                        },
                    ],
                    'qtyRepeats',
                    'qtyProteins',
                    'avgDistance',
                    /*[
                        'class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            // using the column name as key, not mapping to 'id' like the standard generator
                            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                            $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                            return \yii\helpers\Url::toRoute($params);
                        },
                        'contentOptions' => ['nowrap' => 'nowrap']
                    ],*/
                ],
            ]); ?>
        </div>

    </div>
</div>
