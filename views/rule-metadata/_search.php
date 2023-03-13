<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\data\search\RuleMetadataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rule-metadata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_rule_metadata') ?>

    <?= $form->field($model, 'rules_filename') ?>

    <?= $form->field($model, 'family') ?>

    <?= $form->field($model, 'min_len') ?>

    <?= $form->field($model, 'transaction_type') ?>

    <?php // echo $form->field($model, 'maximal_repeat_type') ?>

    <?php // echo $form->field($model, 'clean_mode') ?>

    <?php // echo $form->field($model, 'min_support') ?>

    <?php // echo $form->field($model, 'min_confidence') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
