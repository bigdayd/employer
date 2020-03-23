<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterModel app\models\Currency */

use yii\grid\GridView;

$this->title = 'My Yii Application';

?>
<div class="site-index">
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filterModel,
        'columns' => [
            'id',
            'valuteID',
            'numCode',
            'сharCode',
            'name',
            'value',
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d.m.Y'],
                'filter' => kartik\date\DatePicker::widget([
                    'model' => $filterModel,
                    'attribute' => 'date',
                    'options' => [],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'php:d.m.Y',
                        'todayHighlight' => true
                    ]
                ]),
            ],

        ],
    ]); ?>
</div>
