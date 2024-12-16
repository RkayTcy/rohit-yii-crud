<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property string|null $sub_title
 * @property int $cat_id
 * @property string|null $created_at
 *
 * @property Category $cat
 * @property Product[] $products
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id'], 'required'],
            [['cat_id'], 'integer'],
            [['created_at'], 'safe'],
            [['sub_title'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_title' => 'Sub Title',
            'cat_id' => 'Cat ID',
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
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['subcat_id' => 'id']);
    }
}
