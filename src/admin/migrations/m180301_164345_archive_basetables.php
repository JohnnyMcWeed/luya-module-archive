<?php

use yii\db\Migration;

/**
 * Class m180301_164345_archive_basetables
 */
class m180301_164345_archive_basetables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('archive_cat', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'text' => $this->text(),
            'image_id' => $this->integer(11)->defaultValue(0),
            'image_list' => $this->text(),
            'file_list' => $this->text(),

            'create_user_id' => $this->integer(11)->defaultValue(0),
            'update_user_id' => $this->integer(11)->defaultValue(0),
            'timestamp_create' => $this->integer(11)->defaultValue(0),
            'timestamp_update' => $this->integer(11)->defaultValue(0),

            'is_deleted' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('archive_article', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'text' => $this->text(),
            'place_id' => $this->integer(),
            'amount' => $this->float(),
            'image_id' => $this->integer(11)->defaultValue(0),
            'image_list' => $this->text(),
            'file_list' => $this->text(),

            'cat_id' => $this->integer(),
            'owner_id' => $this->integer(),

            'create_user_id' => $this->integer(11)->defaultValue(0),
            'update_user_id' => $this->integer(11)->defaultValue(0),
            'timestamp_create' => $this->integer(11)->defaultValue(0),
            'timestamp_update' => $this->integer(11)->defaultValue(0),

            'is_deleted' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('archive_article');
        $this->dropTable('archive_cat');
    }
}
