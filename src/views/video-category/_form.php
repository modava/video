<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\video\VideoModule;

/* @var $this yii\web\View */
/* @var $model modava\video\models\VideoCategory */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="video-category-form">
    <?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'position')->textInput() ?>

		<?= $form->field($model, 'ads_pixel')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'ads_session')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'status')->textInput() ?>

		<?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'created_at')->textInput() ?>

		<?= $form->field($model, 'updated_at')->textInput() ?>

		<?= $form->field($model, 'created_by')->textInput() ?>

		<?= $form->field($model, 'updated_by')->textInput() ?>

		<?php if (Yii::$app->controller->action->id == 'create') $model->status = 1; ?>
		<?= $form->field($model, 'status')->checkbox() ?>
        <div class="form-group">
            <?= Html::submitButton(VideoModule::t('video', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
