<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $current_year = date('Y');
        $dateStart = ($current_year-5).'-'.'10-01';
        $dateEnd = ($current_year).'-'.'09-30';
//$dateStart = '2014-10-01';
        //$dateEnd='2017-09-30';
        $sql_op = "SELECT * from tsu_temp_report WHERE reportname = 'opvisit_compare_cost'   ";
        /*$sql_cost = "SELECT sum(rcptamt) as cc2 from incoth WHERE date BETWEEN '$dateStart' and '$dateEnd'   and an=0  GROUP BY THGOVYEAR(date,0) ";
        $sql_drug = "SELECT sum(rcptamt) as cc3 from incoth WHERE date BETWEEN '$dateStart' and '$dateEnd'  and an=0 and income in('08','09','10','11') GROUP BY THGOVYEAR(date,0) ";
        $sql_lab = "SELECT sum(rcptamt) as cc from incoth WHERE date BETWEEN '$dateStart' and '$dateEnd'   and an=0 and income in('01','03','12') GROUP BY THGOVYEAR(date,0) ";
            */
        try {
            $rawData_op = \Yii::$app->db_hi->createCommand($sql_op)->queryAll();
         /*   $rawData_cost = \Yii::$app->db_hi->createCommand($sql_cost)->queryAll();
            $rawData_drug = \Yii::$app->db_hi->createCommand($sql_drug)->queryAll();
            $rawData_lab = \Yii::$app->db_hi->createCommand($sql_lab)->queryAll();
          * */
          

        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        /*$dataProvider_op = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_op,
            'pagination' => false,
        ]);
            $dataProvider_cost = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData_cost,
            'pagination' => false,
        ]);*/
        return $this->render('index', [
           // 'dataProvider_op' => $dataProvider_op,
            //'dataProvider_cost' => $dataProvider_cost,
            'rawData_op' => $rawData_op,
           /* 'rawData_cost' => $rawData_cost,
            'rawData_drug' => $rawData_drug,
            'rawData_lab' => $rawData_lab*/
        ]);
        // return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                //if (Yii::$app->getUser()->login($user)) {
                //return $this->goHome();
                return $this->redirect(['site/login']);
                //}
            }
        }
        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
