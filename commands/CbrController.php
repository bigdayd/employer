<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Currency;

class CbrController extends Controller
{
    public function actionIndex()
    {
        // dayly
        $today = time();
        for ($d = 0; $d < 30; $d++) {
            $date = date('Y-m-d', $today + 86400 * $d);
            $rDate = date("d/m/Y", $today + 86400 * $d);
            $Xml = new \SimpleXMLElement(file_get_contents("http://www.cbr.ru/scripts/XML_daily.asp?date_req={$rDate}"));
            foreach ($Xml->Valute as $Valute) {
                $Currency = Currency::findOne(['valuteID' => (string)$Valute['ID'], 'date' => $date]);
                if ($Currency === null) $Currency = new Currency;
                $Currency->valuteID = (string)$Valute['ID'];
                $Currency->numCode = (int)$Valute->NumCode[0];
                $Currency->сharCode = (string)$Valute->CharCode[0];
                $Currency->name = (string)$Valute->Name[0];
                $Currency->value = (float)str_replace(',', '.', $Valute->Value[0]);
                $Currency->date = $date;
                $Currency->save();
            }
        }
    }
}
