<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modava\video\VideoModule;

/* @var $this yii\web\View */
/* @var $model modava\video\models\search\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'video_type') ?>

    <?= $form->field($model, 'video_category') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'ads_pixel') ?>

    <?php // echo $form->field($model, 'ads_session') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(VideoModule::t('video', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(VideoModule::t('video', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
