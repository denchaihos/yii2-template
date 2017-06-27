<?php
use yii\helpers\Html;
use kartik\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงาน xxxx',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'hn',
            'header' => 'hn',
            'format' => 'raw',
            'value' => function($model) {
                $hn = $model['hn'];
               // $hosname = $model['hosname'];
                return Html::a(Html::encode($hn), ['report/report3', 'hn' => $hn]);
            }
                ],
                [
                    'attribute' => 'fname',
                    'header' => 'ชื่อ'
                ],
                [
                    'attribute' => 'lname',
                    'header' => 'นามสุกล'
                ],
            ]
        ]);
?>
