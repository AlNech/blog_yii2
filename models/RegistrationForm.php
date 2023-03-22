<?php

namespace app\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {

        return [
            [['name', 'email', 'password'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такой пользователь уже существует!'],
            ['password', 'string', 'min'=>6],
        ];
    }

    public function registration()
    {
        if(!$this->validate())
        {
            return null;
        }
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->HashPassword($this->password);

        return $user->save() ? $user : null;
    }

}
