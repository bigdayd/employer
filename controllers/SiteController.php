<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Currency;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Currency::find();
        $filter = new Currency();
        if (isset(Yii::$app->request->queryParams['Currency'])) {
            foreach (Yii::$app->request->queryParams['Currency'] as $k=>$v)
                $filter->$k = $v;

            $fields = Yii::$app->request->queryParams['Currency'];
            if ($fields['date']) {
                $fields['date'] = date('Y-m-d', strtotime($fields['date']));
            }
            $query->andFilterWhere($fields);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'filterModel' => $filter,
        ]);
    }
}
