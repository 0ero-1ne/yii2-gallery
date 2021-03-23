<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\photogallery\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-form">

    <?php $form = ActiveForm::begin([
        'id' => 'w0',
        'layout' => 'default'
    ]); ?>

    <!--?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($model, 'category', ['inputOptions' => ['id' => 'image-category']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title', ['inputOptions' => ['id' => 'image-title']])->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?-->

    <?php
        $items = [
            'guest' => 'Guest',
            'user' => 'User',
            'admin' => 'Admin',
            'link' => 'Link',
        ];

        $params = [
            'prompt' => 'Select status...',
        ];
    ?>

    <?= $form->field($model, 'status', ['inputOptions' => ['id' => 'status']])->dropDownList($items, $params) ?>

    <?php
        $items = [
            'none' => 'None',
            'left_top' => 'Top left',
            'right_top' => 'Top right',
            'left_bot' => 'Bottom left',
            'rigth_bot' => 'Bottom right',
        ];

        $params = [
            'prompt' => 'Select watermark position...',
        ];
    ?>

    <?= $form->field($model, 'watermark', ['inputOptions' => ['id' => 'watermark']])->dropDownList($items, $params) ?>

    <!--?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
