<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\ToastrWidget;
use modava\video\widgets\NavbarWidgets;
use modava\video\VideoModule;

/* @var $this yii\web\View */
/* @var $model modava\video\models\VideoCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => VideoModule::t('video', 'Video Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-view']) ?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
        </h4>
        <p>
            <a class="btn btn-outline-light" href="<?= Url::to(['create']); ?>"
                title="<?= VideoModule::t('video', 'Create'); ?>">
                <i class="fa fa-plus"></i> <?= VideoModule::t('video', 'Create'); ?></a>
            <?= Html::a(VideoModule::t('video', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(VideoModule::t('video', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => VideoModule::t('video', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
						'id',
						'title',
						'slug',
						'image',
						'description',
						'position',
						'ads_pixel:ntext',
						'ads_session:ntext',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return Yii::$app->getModule('video')->params['status'][$model->status];
                            }
                        ],
                        [
                            'attribute' => 'language',
                            'value' => function ($model) {
                                return Yii::$app->getModule('video')->params['availableLocales'][$model->language];
                            },
                        ],
						'created_at',
						'updated_at',
                        [
                            'attribute' => 'userCreated.userProfile.fullname',
                            'label' => VideoModule::t('video', 'Created By')
                        ],
                        [
                            'attribute' => 'userUpdated.userProfile.fullname',
                            'label' => VideoModule::t('video', 'Updated By')
                        ],
                    ],
                ]) ?>
            </section>
        </div>
    </div>
</div>
