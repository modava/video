<?php

namespace modava\video\models\query;

use modava\video\models\VideoCategory;

/**
 * This is the ActiveQuery class for [[VideoCategory]].
 *
 * @see VideoCategory
 */
class VideoCategoryQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([VideoCategory::tableName() . '.status' => VideoCategory::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([VideoCategory::tableName() . '.status' => VideoCategory::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([VideoCategory::tableName() . '.id' => SORT_DESC]);
    }
    public function findByLanguage()
    {
        return $this->andWhere([VideoCategory::tableName() . '.language' => \Yii::$app->language])
            ->orWhere([VideoCategory::tableName() . '.language' => '']);
    }
}
