<?php
/**
 * @var Rule $rule
 */
use yii\grid\GridView;

?>

<h1><?= $rule->rule ?></h1>



<?php //var_dump(count($rule->proteinsForRule)); ?>

<div class="small">
    <?= GridView::widget([
        'layout' => '{summary}{pager}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last'],
        'filterModel' => $searchModel,
        'columns' => [
            'family',
            'encoding',
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
