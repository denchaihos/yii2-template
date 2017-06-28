<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'กรมอนามัย';
?>
<div style="display: none"> 
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
$this->registerJsFile('./js/chart_dial.js');
?>

<div class="site-index well well-material">
    <h3>Dash Board</h3>
</div>
<div class="row">
    <div class="col-sm-4" style="text-align: center;">
        <div id="chart"></div>
        <?php
        //create  x
        $categ = [];
        for ($i = 0; $i < count($rawData); $i++){
            $categ[] = $rawData[$i]['yy'];
        }
        $js_categories = implode("','", $categ);
        //create y
        $data = [];
        for ($i = 0; $i < count($rawData); $i++){
            $data[] = $rawData[$i]['cc'];
        }
        $js_data =  implode(",", $data);
        $data2 = [];
        for ($i = 0; $i < count($rawData); $i++){
            $data2[] = $rawData[$i]['cc2']/100;
        }
        $js_data2 =  implode(",", $data2);
        $this->registerJs("
            $('#chart').highcharts({
                title: {
                    text: 'ยอดผู้รับบริการผู้ป่วยนอก ย้อนหลัง 5  ปี เปรียบเที่ยบกับค่ารักษาพยาบาล'
                },

                subtitle: {
                    text: ''
                },
                xAxis: {
                        categories: [
                            '$js_categories'
                        ],
                        //crosshair: true
                    },

                /*yAxis: {
                    title: {
                        text: 'จำนวน'
                    },
                     min: 10000,
            max: 408768,
            tickInterval: 10000,
            lineColor: '#FF0000',
            lineWidth: 1,
                },*/
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

               /* plotOptions: {
                    series: {
                        pointStart: 2013
                    }
                },*/
                 plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },

                series: [{
                    name: 'ค่ารักษาพยาบาล',
                    data: [$js_data2]
                }, {
                    name: 'ยอดผู้รับบริการ',
                    data: [$js_data]
                }]

            });
        ");
        ?>
        <h4>OPD VISIT</h4>
        <div id="ch1"></div>
    </div>
    <div class="col-sm-4" style="text-align: center;">
<?php
$target = 503;
$result = 102;
$persent = 0.00;
if ($target > 0) {
    $persent = $result / $target * 100;
    $persent = number_format($persent, 2);
}
$base = 90;
$this->registerJs("
                        var obj_div=$('#ch2');
                        gen_dial(obj_div,$base,$persent);
                    ");
?>
        <h4>หญิงมีครรภ์ได้รับการตรวจสุขภาพช่องปาก<br> สำนักทันตะ</h4>
        <div id="ch2"></div>

    </div>

    <div class="col-sm-4" style="text-align: center;">
<?php
$target = 503;
$result = 102;
$persent = 0.00;
if ($target > 0) {
    $persent = $result / $target * 100;
    $persent = number_format($persent, 2);
}
$base = 90;
$this->registerJs("
                        var obj_div=$('#ch3');
                        gen_dial(obj_div,$base,$persent);
                    ");
?>
        <h4>หญิงตั้งค์ครรภ์ได้รับการฝากครรภ์<br>5 ครั้ง</h4>
        <div id="ch3"></div>
    </div>
</div>

