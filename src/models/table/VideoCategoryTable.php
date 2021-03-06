<?php

namespace modava\video\models\table;

use backend\components\MyModel;
use cheatsheet\Time;
use modava\video\models\query\VideoCategoryQuery;
use Yii;

class VideoCategoryTable extends MyModel
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISHED = 1;

    public static function tableName()
    {
        return 'video_category';
    }

    public static function find()
    {
        return new VideoCategoryQuery(get_called_class());
    }

    public static function getAllVideoCategory($lang = null)
    {
        $cache = Yii::$app->cache;
        $key = 'redis-get-all-video-category-' . $lang;

        $data = $cache->get($key);

        if ($data === false) {
            $query = self::find();
            if ($lang != null)
                $query->where(['language' => $lang]);
            $data =$query->published()->sortDescById()->all();
            $cache->set($key, $data, Time::SECONDS_IN_A_MONTH);
        }

        return $data;
    }

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $keys = [
            'redis-get-all-video-category-' . $this->language,
        ];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $cache = Yii::$app->cache;
        $keys = [
            'redis-get-all-video-category-' . $this->language,
        ];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
