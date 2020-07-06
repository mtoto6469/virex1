<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\components\jdf;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
//    public $email;
    public $password;
    public $company_name_en;
    public $company_name_ir;
    public $telephone;
    public $mobile;
    public $rules;
    public $role;
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'email'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

//            ['email', 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['company_name_en', 'required'],
//            ['company_name_en', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['company_name_en', 'string', 'min' => 3],

            ['company_name_ir', 'required'],
//            ['company_name_ir', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['company_name_ir', 'string', 'min' => 3],

            ['telephone', 'string', 'min' => 11],
            ['mobile', 'string', 'min' => 11],
            ['rules', 'integer', 'min' => 1],
            ['role', 'string', 'min' => 3],
            ['name', 'string', 'min' => 3],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {


        if (!$this->validate()) {
            return null;
        } else {
            $user = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $auth = Yii::$app->authManager;
            if ($this->role == 'user') {
                $authorRol = $auth->getRole('user');
                if ($user->save()){
//                    $activatecode=md5(uniqid(rand()));//ایجاد کد فعال ساری به صورت hash شده
                    $auth->assign($authorRol, $user->getId());
                   $profile = new Profile();

//                    echo $profile->email='void';exit;
                    $profile->username=$this->username;
                    $profile->company_name_ir = 'void';
                    $profile->company_name_en = 'void';
                    $profile->name->$this->name;
                    $profile->telephone = $this->telephone;
                    $profile->mobile = $this->mobile;
                    $profile->rules = $this->rules;

                    $profile->state=0;
                    $profile->id_img=-1;
                    $profile->code= '000000000';//دخیره کد فعال سازی در دیتابیس
                    $profile->first=0;
                    $profile->enable=1;
                    $profile->id_user = $user->getId();

                    $data = new jdf();
                    $profile->date = date('Y/m/d');
                    $profile->date_ir = $data->date('Y/m/d');
                    $profile->date_update='2018/01/01';
                    $profile->date_update_ir='1397/5/01';



                    if ($profile->save()){

                        echo $profile->id.'------------';exit;
                        if (isset($_SESSION['user_id'])){
                            if ($_SESSION['user_id'] != null){
                               $_SESSION['error']='ثبت نام با موفقیت انجام شد';
                            }else{ $_SESSION['user_id']=null;}
                        }

                       return $user;

                    }else{
                        
                        $user->delete();
                       $_SESSION['error']='ثبت نام شما انجام نشد';
                       return null;
                    }
                }else{
                    var_dump($user->getErrors());exit;
                    echo "ثبت نشد";
                }

            } else {
                $this->role = 'booth';
//                $activatecode=md5(uniqid(rand()));//ایجاد کد فعال ساری به صورت hash شده
                $authorRol = $auth->getRole('booth');
               if($user->save()) {
                   $auth->assign($authorRol, $user->getId());
                   $profile = new Profile();
                   $profile->name = "void";
                   $profile->email = 'void';
                   $profile->username = $this->username;
                   $profile->company_name_ir = $this->company_name_ir;
                   $profile->company_name_en = $this->company_name_en;
                   $profile->telephone = $this->telephone;
                   $profile->mobile = $this->mobile;
                   $profile->rules = $this->rules;
                   $profile->state = 0;
                   $profile->id_img = -1;
                   $profile->code = '0000000000';//دخیره کد فعال سازی در دیتابیس
                   $profile->first=1;
                   $profile->enable = 1;
                   $profile->id_user = $user->getId();
                   $data = new jdf();
                   $profile->date = date('Y/m/d');
                   $profile->date_ir = $data->date('Y/m/d');
                    $profile->date_update='2018/01/01';
                    $profile->date_update_ir='1397/5/01';

                   $profile->role = 'booth';

                   if ($profile->save()) {
//                       echo $profile->id;exit;
//                       echo 120;
//                    var_dump($profile->id_user);exit();
//                       if (isset($_SESSION['user_id'])) {
//                           if ($_SESSION['user_id'] != null) {
//                               $_SESSION['error'] = 'ثبت نام با موفقیت انجام شد';
//                           } else {
//                               $_SESSION['user_id'] = null;
//                           }
//                       }

                       $_SESSION['error'] = 'ثبت نام با موفقیت انجام شد';
                       return $user;

                   } else {

                       $user->delete();
                       var_dump($profile->getErrors());

                       exit();
                       $_SESSION['error'] = 'ثبت نام شما انجام نشد';
                       return null;
                   }
               }
            }
           
        }
//        return $user ;
    }
}
