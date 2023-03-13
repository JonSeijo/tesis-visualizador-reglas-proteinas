<?php

namespace app\controllers;

use app\models\data\search\ItemSearch;
use Yii;
use yii\web\Controller;

class ItemController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('items', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

}
