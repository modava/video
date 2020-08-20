<?php

namespace modava\video\models\query;

use modava\video\models\VideoType;

/**
 * This is the ActiveQuery class for [[VideoType]].
 *
 * @see VideoType
 */
class VideoTypeQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([VideoType::tableName() . '.status' => VideoType::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([VideoType::tableName() . '.status' => VideoType::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([VideoType::tableName() . '.id' => SORT_DESC]);
    }

    public function findByLanguage()
    {
        return $this->andWhere([VideoType::tableName() . '.language' => \Yii::$app->language])
            ->orWhere([VideoType::tableName() . '.language' => '']);
    }
}
