<?php

use yii\db\Migration;

/**
 * Class m200804_085555_create_talbe_video
 */
class m200804_085555_create_talbe_video extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'link' => $this->string(255)->null(),
            'type' => $this->tinyInteger(11)->notNull()->defaultValue(1),
            'video_type' => $this->integer(11)->null(),
            'video_category' => $this->integer(11)->null(),
            'image' => $this->string(255)->null(),
            'description' => $this->text()->null(),
            'content' => $this->text()->null(),
            'position' => $this->integer(11)->null(),
            'ads_pixel' => $this->text()->null(),
            'ads_session' => $this->text()->null(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'views' => $this->bigInteger(20)->null(),
            'language' => $this->string(25)->null(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->createIndex('index-slug', 'video', 'slug');
        $this->createIndex('index-language', 'video', 'language');
        $this->addForeignKey("fk-video-video_type-video_type-id", "video", "video_type", "video_type", "id", "RESTRICT", "CASCADE");
        $this->addForeignKey("fk-video-video_category-video_category-id", "video", "video_category", "video_category", "id", "RESTRICT", "CASCADE");
        $this->addForeignKey('fk_video-created_by-user_id', 'video', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_video-updated_by-user_id', 'video', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
