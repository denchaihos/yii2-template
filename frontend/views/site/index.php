<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'รพ.ทุ่งศรีอุดม';
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
        
        $year = [];
        $data_op = [];
        $data_cost = [];
        $data_drug = [];
        $data_lab = [];
        for ($i = 0; $i < count($rawData_op); $i++){
            $year[] = $rawData_op[$i]['s1'];
            $data_op[] = $rawData_op[$i]['n1'];
            $data_cost[] = $rawData_op[$i]['n2'];
            $data_drug[] = $rawData_op[$i]['n3'];
            $data_lab[] = $rawData_op[$i]['n4'];
        }
        //create  x
        $js_year = implode("','", $year);
        
        //create y
        $js_data_op =  implode(",", $data_op);
        $js_data_cost =  implode(",", $data_cost);
        $js_data_drug =  implode(",", $data_drug);
        $js_data_lab =  implode(",", $data_lab);

        
        
        //create y
        //op
        /*$data_op = [];
        for ($i = 0; $i < count($rawData_op); $i++){
            $data_op[] = $rawData_op[$i]['cc'];
        }
        $js_data_op =  implode(",", $data_op);
        
        //cost
        /*$data_cost = [];
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
         
         */
        
        $this->registerJs("
           // console.log($js_data_op);
           // $('#chart').height(600);
            $('#chart').highcharts({
                chart: {
                    zoomType: 'xy'
                },
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

                /*yAxis: {
                    title: {
                        text: 'จำนวน'
                    },
                    min: 10000,
                    max: 22000000,
                    tickInterval: 50000,
                    lineColor: '#FF0000',
                    lineWidth: 1,
                     labels:
                        {
                            enabled: false
                        }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },*/
                yAxis: [{ // Primary yAxis
                            labels: {
                                format: '{value} บาท',
                                style: {
                                    color: Highcharts.getOptions().colors[2]
                                }
                            },
                            title: {
                                text: 'ค่าบริการ',
                                style: {
                                    color: Highcharts.getOptions().colors[2]
                                }
                            },
                            opposite: true

                        }, { // Secondary yAxis
                            gridLineWidth: 0,
                            title: {
                                text: 'จำนวนผู้รับบริการ',
                                style: {
                                    color: Highcharts.getOptions().colors[0]
                                }
                            },
                            min: 10000,
                            max: 100000,
                            tickInterval: 10000,
                            labels: {
                                format: '{value} ครั้ง',
                                style: {
                                    color: Highcharts.getOptions().colors[0]
                                }
                            }

                        }],
                        tooltip: {
                            shared: true
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'left',
                            x: 80,
                            verticalAlign: 'top',
                            y: 55,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                        },

             
                /* plotOptions: {
                    spline: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    },
                    column: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },*/

                series: [{
                    name: 'ยอดผู้รับบริการ',
                    type: 'column',
                    yAxis: 1,
                    data: [$js_data_op],
                    tooltip: {
                         valueSuffix: ' ครั้ง'
                    }
                },{
                    name: 'ค่ารักษาพยาบาล',
                    type: 'spline',
                    yAxis: 0,
                    data: [$js_data_cost],
                    tooltip: {
                         valueSuffix: ' บาท'
                    }
                }, {
                    name: 'มูลค่ายา',
                    type: 'spline',
                    yAxis: 0,
                    data: [$js_data_drug],
                    tooltip: {
                         valueSuffix: ' บาท'
                    }
                },{
                    name: 'มูลค่าชัณสูตร',
                    type: 'spline',
                    yAxis: 0,
                    data: [$js_data_lab],
                    tooltip: {
                         valueSuffix: ' บาท'
                    }
                },]

            });
        ");
        ?>        
        <div id="ch1"></div>
    </div>
</div>

