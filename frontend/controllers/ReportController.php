<?php

namespace frontend\controllers;
use Yii;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function  actionReport1(){
        $sql = "select hn,fname,lname,male from pt ";     
        
          try {
            $rawData = \Yii::$app->db_hi->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => [
                'pagesize' => 15,
            ],
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
             'rawData'=>$rawData
                   
        ]);
    }

}
