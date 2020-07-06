<?php
namespace frontend\controllers;

use common\components\jdf;
use common\components\maill;
use common\components\Massege;
use common\components\Profile;
use common\components\Proofile;
use common\models\User;
use frontend\models\Country;
use frontend\models\Exhibitionn;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\swiftmailer\Message;
use yii\web\BadRequestHttpException;
use yii\web\ConflictHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $session = Yii::$app->session;
        if (!$session->isActive) {

            $session->open();
        }
//$transaction=Yii::$app->db->beginTransaction();
        try {

            $this->layout = "main1.php";

            if (Yii::$app->request->post()) {
//                echo $_POST['countryX'];exit;
//                var_dump($_POST['countryX']);exit;

//                if (isset($_POST['countryX'])) {
//                    if ($_POST['countryX'] != null) {
//                        $_SESSION['country3'] = $_POST['countryX'];
//
////var_dump($_POST['countryX']);exit();
//                        return $this->redirect(['index1']);
//                    }
//
//                }else{var_dump($_POST['countryX']);}



                      if (isset($_POST['Country']['country_name'])) {

//                          echo $_POST['country_name'];exit;
//                          var_dump( $_POST['Country']);exit;
                          if ($_POST['Country']['country_name'] != null) {

                              $_SESSION['country3'] = $_POST['Country']['country_name'];
//var_dump($_SESSION['country3']);exit;
//                              echo $_SESSION['country3'].'****'.'ppp';exit;
                              return $this->redirect(['index1']);
                          }

                      }else{var_dump($_POST['Country']['country_name']);}
            }//end if load
            else{
                $country = Country::find()->where(['enable' => 1])->all();
                return $this->render('index', [
                    'country' => $country,
                ]);
            }//end else load

        } catch (ErrorException $e) {
            throw $e;
        }
    }

    public function actionIndex1()
    {


        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();

        }else{}

        if (isset($_SESSION['country3']) && $_SESSION['country3'] != null) {

            return $this->render('index1');
        } else {
//            return $this->render('index1');
            return $this->redirect(['index']);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {

            return $this->render('index1');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) ) {

            if ( $model->login()){

                return $this->goBack();
//            return $this->render('index1');
            }//end if login
            else{

//                var_dump($model->getErrors());exit;
                $model->password = '';
                return $this->render('login', [
                    'model' => $model,
//                'country'=>$country,

                ]);
            }//end else login

        } //end if load
        else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
//                'country'=>$country,

            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

//        return $this->goHome();
        return $this->render('index1');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRule()
    {
        return $this->render('rule');
    }

    public function actionTariff()
    {
        return $this->render('tariff');
    }
    public function actionGuide()
    {
        return $this->render('guide');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($role)
    {
//var_dump($r=$_GET['role']);exit();


        try {
            $model = new SignupForm();

            if ($model->load(Yii::$app->request->post())) {
                $checkPro = \frontend\models\Profile::find()->where(['company_name_ir' => $model->company_name_ir])->orWhere(['company_name_en' => $model->company_name_en])->count();

                if ($checkPro == 0) {
                    if ($user = $model->signup()) {
                        if (Yii::$app->getUser()->login($user)) {
//                            $usern=User::findOne(Yii::$app->user->getId());
//                            var_dump($usern->getErrors()) ;exit;
                            return $this->redirect('login');
                        }
                    }
                } else {
//                    var_dump($model->company_name_ir);
//                    var_dump($model->company_name_en);
//                    exit();
                    $co = 'void';
                    $com1 = $model->company_name_ir;
                    $com2 = $model->company_name_en;
                    $com = $com1 && $com2;

                    if ($com == $co) {
                        if ($user = $model->signup()) {
                            if (Yii::$app->getUser()->login($user)) {
//                            $usern=User::findOne(Yii::$app->user->getId());
//                            var_dump($usern->getErrors()) ;exit;
                                return $this->redirect('login');
                            }
                        }
                    } else {
                        $_SESSION['error'] = 'نام شرکت تکراری میباشد';
                        return $this->render('signup', [
                            'model' => $model,
                            'role' => $role,
                        ]);
                    }
                    $_SESSION['error'] = 'نام شرکت تکراری میباشد';
                    return $this->render('signup', [
                        'model' => $model,
                        'role' => $role,
                    ]);
                }
            } else {
                return $this->render('signup', [
                    'model' => $model,
                    'role' => $role,
                ]);
            }
        } catch (ErrorException $e) {
//            $transaction->rollBack();
            Yii::$app->session->setFlash('error', "{$e->getMessage()}");
//            throw $e;
            $this->refresh();
        }
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionCountry()
    {

    }

    public function actionExhibitions()
    {

//        $country=ArrayHelper::map(Country::find()->where(['id'=>$_SESSION['country3']])->all(),'id','country_name');
//        $exhibitions=Exhibitionn::find()->where(['enable'=>1])->all();
//        if ($country!=null){}
//        return $this->render('exhibitions',[
//            'country'=>$country,
//        ]);
    }


//        public  function actionInit(){
//        $auth=yii::$app->authManager;
//
//        $admin=$auth->createRole('admin');
//        $auth->add($admin);
//
//        $user=$auth->createRole('user');
//        $auth->add($user);
//
//        $writer=$auth->createRole('writer');
//        $auth->add($writer);
//
//        $booth=$auth->createRole('booth');
//        $auth->add($booth);
//    }
}
