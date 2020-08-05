<?php

namespace modava\video\models;

use common\models\User;
use modava\video\VideoModule;
use modava\video\models\table\VideoTable;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\helpers\MyHelper;
use yii\db\ActiveRecord;
use Yii;

/**
* This is the model class for table "video".
*
    * @property int $id
    * @property string $title
    * @property string $slug
    * @property int $video_type
    * @property int $video_category
    * @property string $image
    * @property string $description
    * @property string $content
    * @property int $position
    * @property string $ads_pixel
    * @property string $ads_session
    * @property int $status
    * @property int $views
    * @property string $language
    * @property int $created_at
    * @property int $updated_at
    * @property int $created_by
    * @property int $updated_by
    *
            * @property VideoCategory $videoCategory
            * @property VideoType $videoType
            * @property User $createdBy
            * @property User $updatedBy
    */
class Video extends VideoTable
{
    public $toastr_key = 'video';
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'slug' => [
                    'class' => SluggableBehavior::class,
                    'immutable' => false,
                    'ensureUnique' => true,
                    'value' => function () {
                        return MyHelper::createAlias($this->title);
                    }
                ],
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'created_by',
                    'updatedByAttribute' => 'updated_by',
                ],
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'preserveNonEmptyValues' => false,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
            ]
        );
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
			[['title', 'slug', 'created_at', 'updated_at'], 'required'],
			[['video_type', 'video_category', 'position', 'status', 'views', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
			[['description', 'content', 'ads_pixel', 'ads_session'], 'string'],
			[['title', 'slug', 'image'], 'string', 'max' => 255],
			[['language'], 'string', 'max' => 2],
			[['slug'], 'unique'],
			[['video_category'], 'exist', 'skipOnError' => true, 'targetClass' => VideoCategory::class, 'targetAttribute' => ['video_category' => 'id']],
			[['video_type'], 'exist', 'skipOnError' => true, 'targetClass' => VideoType::class, 'targetAttribute' => ['video_type' => 'id']],
			[['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
			[['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
		];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => VideoModule::t('video', 'ID'),
            'title' => VideoModule::t('video', 'Title'),
            'slug' => VideoModule::t('video', 'Slug'),
            'video_type' => VideoModule::t('video', 'Video Type'),
            'video_category' => VideoModule::t('video', 'Video Category'),
            'image' => VideoModule::t('video', 'Image'),
            'description' => VideoModule::t('video', 'Description'),
            'content' => VideoModule::t('video', 'Content'),
            'position' => VideoModule::t('video', 'Position'),
            'ads_pixel' => VideoModule::t('video', 'Ads Pixel'),
            'ads_session' => VideoModule::t('video', 'Ads Session'),
            'status' => VideoModule::t('video', 'Status'),
            'views' => VideoModule::t('video', 'Views'),
            'language' => VideoModule::t('video', 'Language'),
            'created_at' => VideoModule::t('video', 'Created At'),
            'updated_at' => VideoModule::t('video', 'Updated At'),
            'created_by' => VideoModule::t('video', 'Created By'),
            'updated_by' => VideoModule::t('video', 'Updated By'),
        ];
    }

    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUserCreated()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUserUpdated()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
