<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string|null $model
 * @property int $inventoryNumber
 * @property string|null $serialNumber
 * @property int $status
 * @property int $materialCategoryId
 *
 * @property MaterialCategory $materialCategory
 * @property MaterialLoan[] $materialLoans
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inventoryNumber', 'status', 'materialCategoryId'], 'required'],
            [['inventoryNumber', 'status'], 'integer'],
            [['model', 'serialNumber', 'materialCategoryId'], 'string', 'max' => 255],
            [['materialCategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => MaterialCategory::class, 'targetAttribute' => ['materialCategoryId' => 'materialCategoryId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'inventoryNumber' => 'Inventory Number',
            'serialNumber' => 'Serial Number',
            'status' => 'Status',
            'materialCategoryId' => 'Material Name',
        ];
    }

    /**
     * Gets query for [[MaterialCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialCategory()
    {
        return $this->hasOne(MaterialCategory::class, ['materialCategoryId' => 'materialCategoryId']);
    }

    /**
     * Gets query for [[MaterialLoans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialLoans()
    {
        return $this->hasMany(MaterialLoan::class, ['materialId' => 'id']);
    }
}
