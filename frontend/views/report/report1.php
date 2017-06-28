<?php
use yii\helpers\Html;
use kartik\grid\GridView;
        use miloschuman\highcharts\Highcharts;
        //หลอกวิวให้  โหลด  highchart  มา
        ?><div style="display: none">     
            <?php
         echo Highcharts::widget([
            'scripts' => [
                'highcharts-more',
                'themes/grid'
            ]
        ]);
        ?>
        </div>
<?php

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานนับถือศาสนา';

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
                [
                    'attribute' => 'male',
                    'header' => 'เพศ'
                ],
            ]
        ]);
        ?>
       
        <div id="chart">llll</div>
        <?php     
        //create  x
        $categ = [];
        for ($i = 0; $i < count($rawData); $i++){
            $categ[] = $rawData[$i]['male'];
        }
        $js_categories = implode("','", $categ);
        //create y
        $data = [];
        for ($i = 0; $i < count($rawData); $i++){
            $data[] = $rawData[$i]['hn'];
        }
        $js_data =  implode(",", $data);
        $this->registerJs("$(function (){
                $('#chart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Monthly Average Rainfall'
                    },
                    subtitle: {
                        text: 'Source: WorldClimate.com'
                    },
                    xAxis: {
                        categories: [
                            '$js_categories'
                        ],
                        //crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Rainfall (mm)'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                        pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                            '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'คน',
                        data: [$js_data]

                    }, ]
                });
            });
            ");
            
        
        ?>

