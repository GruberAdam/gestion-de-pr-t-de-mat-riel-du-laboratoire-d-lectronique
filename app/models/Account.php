<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $email
 * @property int $accountTypeId
 * @property string $password
 *
 * @property AccountType $accountType
 * @property MaterialLoan[] $materialLoans
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'accountTypeId', 'password'], 'required'],
            [['accountTypeId'], 'integer'],
            [['email', 'password'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
        ];
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
