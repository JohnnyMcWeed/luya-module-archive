<?php

namespace johnnymcweed\archive\models;

use johnnymcweed\archive\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;


/**
 * Cat.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property text $title
 * @property text $text
 * @property integer $image_id
 * @property text $image_list
 * @property text $file_list
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property integer $timestamp_create
 * @property integer $timestamp_update
 * @property tinyint $is_deleted
 */
class Cat extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'text', 'image_list', 'file_list'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'archive_cat';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-archive-cat';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'eventBeforeInsert']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'eventBeforeUpdate']);
    }

    /**
     * @inheritdoc
     */
    public function eventBeforeUpdate()
    {
        $this->update_user_id = Yii::$app->adminuser->getId();
        $this->timestamp_update = time();
    }

    /**
     * @inheritdoc
     */
    public function eventBeforeInsert()
    {
        $this->create_user_id = Yii::$app->adminuser->getId();
        $this->update_user_id = Yii::$app->adminuser->getId();
        $this->timestamp_update = time();
        if (empty($this->timestamp_create)) {
            $this->timestamp_create = time();
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Module::t('Title'),
            'signature' => Module::t('Signature'),
            'text' => Module::t('Text'),
            'image_id' => Module::t('Image'),
            'image_list' => Module::t('Images'),
            'file_list' => Module::t('Files'),
            'timestamp_create' => Module::t('timestamp_create'),
            'timestamp_update' => Module::t('timestamp_update'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'signature', 'text', 'image_list', 'file_list'], 'string'],
            [['create_user_id', 'timestamp_create', 'timestamp_update'], 'integer'],
            [['image_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'signature', 'text'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
            'signature' => 'text',
            'text' => 'textarea',
            'image_id' => 'image',
            'image_list' => 'imageArray',
            'file_list' => 'fileArray',
            'timestamp_create' => 'datetime',
            'timestamp_update' => 'date',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeGroups()
    {
        return [
            [['text'], 'Description', 'collapsed'],
            [['image_id', 'image_list', 'file_list'], 'Media', 'collapsed'],
            [['timestamp_create', 'timestamp_update'], 'Time', 'collapsed'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'signature']],
            [['create', 'update'], ['title',, 'signature' 'text', 'image_id', 'image_list', 'file_list', 'timestamp_create', 'timestamp_update']],
            ['delete', false],
        ];
    }
}