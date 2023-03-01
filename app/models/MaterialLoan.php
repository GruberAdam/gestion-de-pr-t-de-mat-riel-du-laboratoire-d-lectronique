<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_loan".
 *
 * @property int $materialLoanId
 * @property int $materialId
 * @property int $accountId
 * @property string $loanDate
 * @property string $returnDate
 *
 * @property Account $account
 * @property Material $material
 */
class MaterialLoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['materialId', 'accountId', 'loanDate', 'returnDate'], 'required'],
            [['materialId', 'accountId'], 'integer'],
            [['loanDate', 'returnDate'], 'safe'],
            [['materialId'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['materialId' => 'id']],
            [['accountId'], 'exist', 'skipOnError' => true, 'targetClass' => Account::class, 'targetAttribute' => ['accountId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'materialLoanId' => 'Material Loan ID',
            'materialId' => 'Material ID',
            'accountId' => 'Account ID',
            'loanDate' => 'Loan Date',
            'returnDate' => 'Return Date',
        ];
    }

    /**
     * Gets query for [[Account]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::class, ['id' => 'accountId']);
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'materialId']);
    }
}
