<?php

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\searchModels\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Sub Category', ['/sub-category'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Product', ['/product'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'subcat_id',
                'label' => 'SubCategory Title',
                'format' => 'html',
                'filter' => Html::activeDropDownList($searchModel,'subcat_id',$subCatdata,[
                    'class' => 'form-control',
                    'prompt' => 'Select SubCategory'
                ]),
                'value' => function ($model) {
                    $titleArr = array_column($model->subCategories, 'sub_title');
                    $titleList = "<ul>";
                    foreach ($titleArr as $title) {
                        $titleList .= "<li>{$title}</li>";
                    }
                    $titleList .= "</ul>";
                    return $titleList;
                }
            ],
            [
                'attribute' => 'prod_id',
                'label' => 'Product Name',
                'format' => 'html',
                'filter' => Html::activeDropDownList($searchModel,'prod_id',$productdata,[
                    'class' => 'form-control',
                    'prompt' => 'Select Product'
                ]),
                'value' => function ($model) {
                    $titleArr = array_column($model->products, 'prod_name');
                    $titleList = "<ul>";
                    foreach ($titleArr as $title) {
                        $titleList .= "<li>{$title}</li>";
                    }
                    $titleList .= "</ul>";
                    return $titleList;
                }
            ],
            'created_at:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>