<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prod_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'prod_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subcat_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
