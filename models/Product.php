<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $prod_title
 * @property int $cat_id
 * @property string|null $prod_name
 * @property int $subcat_id
 * @property string|null $created_at
 *
 * @property Category $cat
 * @property SubCategory $subcat
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'subcat_id'], 'required'],
            [['cat_id', 'subcat_id'], 'integer'],
            [['created_at'], 'safe'],
            [['prod_title', 'prod_name'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['cat_id' => 'id']],
            [['subcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::class, 'targetAttribute' => ['subcat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prod_title' => 'Prod Title',
            'cat_id' => 'Cat ID',
            'prod_name' => 'Prod Name',
            'subcat_id' => 'Subcat ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::class, ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[Subcat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcat()
    {
        return $this->hasOne(SubCategory::class, ['id' => 'subcat_id']);
    }
}
