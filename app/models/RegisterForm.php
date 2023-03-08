<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $email;
    public $password;
    public $confirmPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password', 'confirmPassword'], 'required'],
            ['email', 'email'],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=> "Passwords don't match" ],
        ];
    }

    public function register()
    {
        if ($this->validate()){
            $newAccount = new Account();
            $newAccount->email = $this->email;
            $newAccount->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $newAccount->authKey = Yii::$app->security->generateRandomString();

            if ($newAccount->validate()){
                $newAccount->insert();
                return true;
            }
            $this->addError('email', 'E-mail already used');
            Yii::warning($newAccount->errors);
            return false;
        }
    }
}
