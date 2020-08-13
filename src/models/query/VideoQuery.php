<?php

namespace modava\video\models\query;

use modava\video\models\Video;

/**
 * This is the ActiveQuery class for [[Video]].
 *
 * @see Video
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([Video::tableName() . '.status' => Video::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([Video::tableName() . '.status' => Video::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([Video::tableName() . '.id' => SORT_DESC]);
    }
    public function findByLanguage()
    {
        return $this->andWhere([Video::tableName() . '.language' => \Yii::$app->language]);
    }
}
