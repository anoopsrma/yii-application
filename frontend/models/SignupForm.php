<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $password_repeat;
    public $dob;
    public $country;
    public $profession;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname'], 'trim'],
            [['fname', 'lname'], 'required'],
            [['fname', 'lname'], 'string', 'min' => 2, 'max' => 255],
            /*['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],*/

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['password','password_repeat'], 'required'],
            [['password','password_repeat'], 'string', 'min' => 6, 'max' => 255],
            [['password'], 'in',
                'range'=> [
                    'password','Password','Password123','123456','12345678','letmein','monkey'
                ],
                'not'=> true, 
                'message'=> Yii::t('app', 'You cannot use any really obvious passwords')
            ],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message' => 
                Yii::t("app", "The passwords must match")
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fname' => Yii::t('app', 'First Name'),
            'lname' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email Address'),
            'password' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app', 'Repeat Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
