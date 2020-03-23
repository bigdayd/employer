<?php

namespace app\controllers;

use yii\helpers\Json;
use yii\web\Controller;
use app\models\Currency;

/**
 * Class ApiController
 * @package app\controllers
 */
class ApiController extends Controller
{

    /**
     * Return exchange rate by period.
     * @param string $from 2020-03-23
     * @param string $to 2020-03-23
     * @return string json
     * @throws \yii\db\Exception
     */
    public function actionRateByPeriod($from, $to)
    {
        if (preg_match('#^\d{4}-\d{2}-\d{2}$#', $from)!==1 || preg_match('#^\d{4}-\d{2}-\d{2}$#', $to)!==1) {
            return json_encode(['error'=>'Incorrect date format']);
        }
        if (strtotime($to) - strtotime($from) > 30 * 86400) {
            return json_encode(['error'=>'Too long period']);
        }
        $response = ['from'=>$from, 'to'=>$to, 'data'=>[]];
        $data = Currency::find()
            ->andWhere(['between', 'date', $from, $to])
            ->orderBy('valuteID')
            ->createCommand()
            ->queryAll();

        foreach ($data as $row) {
            if (!isset($response['data'][$row['valuteID']])) {
                $response['data'][$row['valuteID']] = [
                    'numCode' => $row['numCode'],
                    'сharCode' => $row['сharCode'],
                    'name' => $row['name'],
                    'rates' => [],
                ];
            }
            $response['data'][$row['valuteID']]['rates'][] = [
                'date' => $row['date'],
                'value' => $row['value']
            ];
        }
        return json_encode($response);
    }
}
