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
    <div class="col-sm-12" style="text-align: center;">
        <div id="chart"></div>
        <?php
        //create  x
        $year = [];
        for ($i = 0; $i < count($rawData_op); $i++){
            $year[] = $rawData_op[$i]['yy'];
        }
        $js_year = implode("','", $year);
        
        
        //create y
        //op
        $data_op = [];
        for ($i = 0; $i < count($rawData_op); $i++){
            $data_op[] = $rawData_op[$i]['cc'];
        }
        $js_data_op =  implode(",", $data_op);
        
        //cost
        $data_cost = [];
        for ($i = 0; $i < count($rawData_cost); $i++){
            $data_cost[] = $rawData_cost[$i]['cc2'];
        }
        $js_data_cost =  implode(",", $data_cost);
        
        //drug
        $data_drug = [];
        for ($i = 0; $i < count($rawData_drug); $i++){
            $data_drug[] = $rawData_drug[$i]['cc3'];
        }
        $js_data_drug =  implode(",", $data_drug);
        
        //lab
        $data_lab = [];
        for ($i = 0; $i < count($rawData_lab); $i++){
            $data_lab[] = $rawData_lab[$i]['cc'];
        }
        $js_data_lab =  implode(",", $data_lab);
        
        $this->registerJs("
            console.log($js_data_op);
           // $('#chart').height(600);
            $('#chart').highcharts({
                title: {
                    text: 'ยอดผู้รับบริการผู้ป่วยนอก ย้อนหลัง 5  ปี เปรียบเที่ยบกับค่ารักษาพยาบาล'
                },

                subtitle: {
                    text: ''
                },
                xAxis: {
                title: {
                        text: 'ปีงบประมาณ'
                    },
                        categories: [
                            '$js_year'
                        ],
                        //crosshair: true
                    },

                yAxis: {
                    title: {
                        text: 'จำนวน'
                    },
                    min: 40000,
                    max: 25000000,
                    tickInterval: 100000,
                    lineColor: '#FF0000',
                    lineWidth: 1,
                },
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
                    data: [$js_data_cost]
                }, {
                    name: 'มูลค่ายา',
                    data: [$js_data_drug]
                },{
                    name: 'มูลค่าชัณสูตร',
                    data: [$js_data_lab]
                },{
                    name: 'ยอดผู้รับบริการ',
                    data: [$js_data_op]
                }]

            });
        ");
        ?>        
        <div id="ch1"></div>
    </div>
</div>

