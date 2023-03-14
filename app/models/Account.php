<?php

namespace app\models;

use Yii;
use yii\base\ErrorException;
use yii\db\Exception;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $email
 * @property int $accountTypeId
 * @property string $password
 * @property string $authKey
 *
 * @property AccountType $accountType
 * @property MaterialLoan[] $materialLoans
 */
class Account extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    public function init()
    {
        $this->accountTypeId = 1;
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'accountTypeId', 'password', 'authKey'], 'required'],
            [['accountTypeId'], 'integer'],
            [['email', 'password', 'authKey'], 'string', 'max' => 255],
            [['email', 'authKey'], 'unique'],
            [['accountTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountType::class, 'targetAttribute' => ['accountTypeId' => 'accountTypeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'accountTypeId' => 'Account Type ID',
            'password' => 'Password',
            'authKey' => 'Authentification Key'
        ];
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getId(){
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function isAdmin($id)
    {
        $adminTypeValue = AccountType::findBySql('SELECT accountTypeId FROM pretpi.account_type WHERE name = "admin"')->all()[0]['accountTypeId'];
        $accountTypeValue = Account::findBySql("SELECT accountTypeId FROM pretpi.account WHERE id = '$id'")->all()[0]['accountTypeId'];

        if ($accountTypeValue == $adminTypeValue)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Gets query for [[AccountType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountType()
    {
        return $this->hasOne(AccountType::class, ['accountTypeId' => 'accountTypeId']);
    }

    /**
     * Gets query for [[MaterialLoans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialLoans()
    {
        return $this->hasMany(MaterialLoan::class, ['accountId' => 'id']);
    }
}
