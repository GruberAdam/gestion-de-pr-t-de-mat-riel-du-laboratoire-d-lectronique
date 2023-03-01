<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_category".
 *
 * @property int $materialCategoryId
 * @property string $name
 *
 * @property Material[] $materials
 */
class MaterialCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'materialCategoryId' => 'Material Category ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::class, ['materialCategoryId' => 'materialCategoryId']);
    }
}
