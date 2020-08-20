<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;
use modava\video\VideoModule;
use modava\video\models\table\VideoCategoryTable;
use modava\video\models\table\VideoTypeTable;

/* @var $this yii\web\View */
/* @var $model modava\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
    <div class="video-form">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'language')->dropDownList(Yii::$app->params['availableLocales'], ['prompt' => VideoModule::t('video', 'Chọn ngôn ngữ...')]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'type')->dropDownList(Yii::$app->getModule('video')->params['type']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'video_category')
                    ->dropDownList(ArrayHelper::map(VideoCategoryTable::getAllVideoCategory($model->language), 'id', 'title'), ['prompt' => VideoModule::t('video', 'Chọn danh mục...')])
                    ->label(VideoModule::t('video', 'Danh mục')) ?>

            </div>
            <div class="col-6">
                <?= $form->field($model, 'video_type')
                    ->dropDownList(ArrayHelper::map(VideoTypeTable::getAllVideoType($model->language), 'id', 'title'), ['prompt' => VideoModule::t('video', 'Chọn thể loại...')])
                    ->label(VideoModule::t('video', 'Thể loại')) ?>
            </div>
        </div>

        <?= $form->field($model, 'description')->widget(\modava\tiny\TinyMce::class, []) ?>

        <?= $form->field($model, 'content')->widget(\modava\tiny\TinyMce::class, [
            'type' => 'content',
            'options' => [
                'rows' => 15
            ]
        ]) ?>

        <?php
        if (empty($model->getErrors()))
            $path = Yii::$app->params['video']['150x150']['folder'];
        else
            $path = null;

        echo \modava\tiny\FileManager::widget([
            'model' => $model,
            'attribute' => 'image',
            'path' => $path,
            'label' => VideoModule::t('video', 'Hình ảnh') . ': ' . Yii::$app->params['video-size'],
        ]); ?>

        <?php if (Yii::$app->controller->action->id == 'create') $model->status = 1; ?>
        <?= $form->field($model, 'status')->checkbox() ?>
        <div class="form-group">
            <?= Html::submitButton(VideoModule::t('video', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
<?php
$urlLoadCategory = Url::toRoute(['load-category-by-lang']);
$urlLoadType = Url::toRoute(['load-type-by-lang']);
$script = <<< JS
function loadDataByLang(url, lang){
    return new Promise((resolve) => {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            data: {
                lang: lang
            }
        }).done(res => {
            resolve(res);
        }).fail(f => {
            resolve(null);
        });
    });
}
$('body').on('change', '#video-language', async function(){
    var v = $(this).val(),
        category, type;
    $('#video-video_category, #video-video_type').find('option[value!=""]').remove();
    await loadDataByLang('$urlLoadCategory', v).then(res => category = res);
    await loadDataByLang('$urlLoadType', v).then(res => type = res);
    if(typeof category === "string"){
        $('#video-video_category').append(category);
    } else if(typeof category === "object"){
        Object.keys(category).forEach(function(k){
            $('#video-video_category').append('<option value="'+ k +'">'+ category[k] +'</option>');
        });
    }
    if(typeof type === "string"){
        $('#video-video_type').append(type);
    } else if(typeof type === "object"){
        Object.keys(type).forEach(function(k){
            $('#video-video_type').append('<option value="'+ k +'">'+ type[k] +'</option>');
        });
    }
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);