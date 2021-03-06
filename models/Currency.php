<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $valuteID
 * @property int $numCode
 * @property string $сharCode
 * @property string $name
 * @property float $value
 * @property string $date
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valuteID', 'numCode', 'сharCode', 'name', 'value', 'date'], 'required'],
            [['numCode'], 'integer'],
            [['value'], 'number'],
            [['date'], 'safe'],
            [['valuteID', 'сharCode'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valuteID' => 'Valute ID',
            'numCode' => 'Num Code',
            'сharCode' => 'Сhar Code',
            'name' => 'Name',
            'value' => 'Value',
            'date' => 'Date',
        ];
    }
}
