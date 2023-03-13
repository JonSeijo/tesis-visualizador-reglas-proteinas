<?php

namespace app\controllers;

use app\models\data\Rule;
use app\models\data\search\ProteinSearch;
use app\models\data\search\RuleSearch;
use Yii;
use yii\web\Controller;

class RuleController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new RuleSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('rules', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $rule = Rule::find()
            ->where(['idRule'=>(int)$id])
            //->with('proteinsForRule')
            ->one();

        if($rule instanceof Rule) {
            $searchModel = new ProteinSearch();
            $searchModel->idRule = $id;
            $dataProvider = $searchModel->search($_GET);

            return $this->render('rule', ['rule'=>$rule, 'dataProvider'=>$dataProvider, 'searchModel'=>$searchModel]);
        }
    }
}
