<?php

namespace app\models\searchModels;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\Category`.
 */
class CategorySearch extends Category
{
    public $subcat_id;
    public $prod_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'subcat_id', 'prod_id', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find()->joinWith(['subCategories', 'products']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id', // Default column from the main table
                    'title', // Main table column
                    'created_at', // Main table column
                    // Custom sorting for subCategories table
                    'subcat_id' => [
                        'asc' => ['sub_category.id' => SORT_ASC],
                        'desc' => ['sub_category.id' => SORT_DESC],
                        'label' => 'SubCategory Title',
                    ],

                    // Custom sorting for products table
                    'prod_id' => [
                        'asc' => ['product.id' => SORT_ASC],
                        'desc' => ['product.id' => SORT_DESC],
                        'label' => 'Product Name',
                    ],
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'sub_category.id', $this->subcat_id]);
        $query->andFilterWhere(['like', 'product.id', $this->prod_id]);

        return $dataProvider;
    }
}
