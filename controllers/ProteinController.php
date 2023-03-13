<?php

namespace app\controllers;

use app\models\data\Protein;
use app\models\data\search\ProteinSearch;
use app\models\data\search\RuleSearch;
use Yii;
use yii\web\Controller;

class ProteinController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProteinSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('proteins', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $protein = Protein::find()
            ->where(['idProtein'=>(int)$id])
            ->with('rulesForProtein')
            ->one();

        if($protein instanceof Protein) {
            return $this->render('protein', ['protein'=>$protein]);
        }
    }
}
