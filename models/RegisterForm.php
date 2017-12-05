<?php
/**
 * Created by PhpStorm.
 * User: Глова
 * Date: 04.12.2017
 * Time: 12:32
 */

namespace app\models;


use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['username','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>2]
        ];
    }
    public function register()
    {
        if ($this->validate()){
            $user=new User();
            $user->username=$this->username;
            $user->setPassword($this->password);
            return $user->save();
        }
    }
}