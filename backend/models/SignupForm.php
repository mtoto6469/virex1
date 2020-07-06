<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/25/2018
 * Time: 12:28 PM
 */

namespace backend\models;


use common\components\jdf;
use backend\models\Profile;
use Yii;
use yii\base\Model;
use common\models\User;

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
    public $date;

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
            var_dump($this->getErrors());
            exit;
            return null;
        } else {

            $user = new User();

            if ($user == null) {

            }

            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($this->role);

            if ($user->save()) {

                $auth->assign($authorRole, $user->getId());
                $profile = new Profile();
                $profile->email = 'void';
                $profile->username = $this->username;
                if ($this->company_name_en != 'void') {
                    $profile->company_name_en = $this->company_name_en;
                } else {
                    $profile->company_name_en = 'void';
                }
                if ($this->company_name_ir != 'void') {
                    $profile->company_name_ir = $this->company_name_ir;
                } else {
                    $profile->company_name_ir = 'void';
                }
                $profile->telephone = $this->telephone;
                $profile->mobile = $this->mobile;
                $profile->rules = 1;

                $profile->state = 1;
                $profile->id_img = -1;
                $profile->code = '000000000';//دخیره کد فعال سازی در دیتابیس
                $profile->enable = 1;
                $profile->id_user = $user->getId();
                $profile->role = $this->role;

                if (($profile->role = $this->role) == 'user') {
                    $profile->first = 0;
                } else {
                    $profile->first = 1;
                }
//             echo $profile->role;exit;
                $data = new jdf();
                $profile->date = date('Y/m/d');
                $profile->date_ir = $data->date('Y/m/d');
                $profile->date_update = '2018/01/01';
                $profile->date_update_ir = '1397/5/01';


                if ($profile->save()) {

                    return $user;
                } else {
                    var_dump($profile->getErrors());exit;
                    $user->delete();
                    return null;
                }
            }
//        return $user->save() ? $user : null;
        }
    }
}