<?php
namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\Participant;
use backend\models\Profile;
use backend\models\SignupForm;
use mdm\admin\models\form\Signup;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'signup', 'init', 'logout','index','participant' ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'error', 'signup', 'init', 'logout','index','participant' ],
                        'allow' => true,
                        'roles' => ['admin'],
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

        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        return $this->render('index');
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            return $this->redirect(['login','type'=>'Ok']);
        }

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin($type)
    {
        $this->layout = 'login.php';
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        if ($type == 'noOk') {
            $_SESSION['error'] = 'شما اجازه دسترسی ندارید ';
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                $user = AuthAssignment::find()->where(['user_id' => Yii::$app->user->getId()])->one();
                if ($user->item_name == 'admin' || $user->item_name == 'writer') {
                    return $this->redirect(['index']);
                } else {
                    $_SESSION['error'] = 'شما اجازه ورود ندارید لطفا با مدیریت هماهنگ کنید';
                    return $this->redirect(['site/login', 'type' => 0]);

//                return $this->goBack();
                }
            } else {

            }

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout($type)
    {
        Yii::$app->user->logout();
        if ($type == 0) {
            return $this->redirect(['login', 'type' => 'noOk']);
        } else {
            return $this->redirect(['login', 'type' => 'Ok']);
        }

        return $this->goHome();
    }


    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
//            echo 125;exit;

            if ($user = $model->signup()) {
                return $this->redirect(['profile/index','id'=>$user->id]);
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
            }
        }else{
//var_dump($model->getErrors());exit;
            $role = ['admin' => 'مدیر کل', 'writer' => 'نویسنده', 'booth' => 'غرفه دار', 'user' => 'کاربر عادی'];
            return $this->render('signup', [
                'model' => $model,
                'role' => $role,

            ]);
        }

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
