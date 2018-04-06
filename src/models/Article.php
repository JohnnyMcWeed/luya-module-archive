<?php

namespace johnnymcweed\archive\models;

use johnnymcweed\archive\admin\Module;
use johnnymcweed\person\models\Person;
use johnnymcweed\place\models\Place;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Article.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property text $title
 * @property text $text
 * @property integer $place_id
 * @property float $amount
 * @property integer $image_id
 * @property text $image_list
 * @property text $file_list
 * @property integer $cat_id
 * @property integer $owner_id
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property integer $timestamp_create
 * @property integer $timestamp_update
 * @property tinyint $is_deleted
 */
class Article extends NgRestModel
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
        return 'archive_article';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-archive-article';
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
            'place_id' => Module::t('Place'),
            'amount' => Module::t('Amount'),
            'image_id' => Module::t('Image'),
            'image_list' => Module::t('Images'),
            'file_list' => Module::t('Files'),
            'cat_id' => Module::t('Category'),
            'owner_id' => Module::t('Owner'),
            'timestamp_create' => Module::t('Timestamp Create'),
            'timestamp_update' => Module::t('Timestamp Update')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'image_list', 'file_list', 'signature'], 'string'],
            [['place_id', 'cat_id', 'owner_id',
                'timestamp_create', 'timestamp_update'], 'integer'],
            [['amount'], 'number'],
            [['image_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'signature', 'text', 'image_list', 'file_list'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'title' => 'text',
            'text' => 'textarea',
            'signature' => 'text',
            'place_id' => [
                'selectModel',
                'modelClass' => Place::class,
                'valueField' => 'id',
                'labelField' => 'title'
            ],
            'amount' => 'decimal',
            'image_id' => 'image',
            'image_list' => 'imageArray',
            'file_list' => 'fileArray',
            'cat_id' => [
                'selectModel',
                'modelClass' => Cat::class,
                'valueField' => 'id',
                'labelField' => 'title'
            ],
            'owner_id' => [
                'selectModel',
                'modelClass' => Person::class,
                'valueField' => 'id',
                'labelField' => function($model) {
                    return $model->first_name . ' ' . $model->last_name;
                }
            ],
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
            [['place_id', 'amount', 'owner_id'], 'Info'],
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
            ['list', ['title', 'signature', 'amount', 'place_id', 'owner_id']],
            [['create', 'update'], ['title', 'signature', 'text', 'place_id', 'amount',
                'image_id', 'image_list', 'file_list', 'cat_id', 'owner_id', 'timestamp_create', 'timestamp_update']],
            ['delete', false],
        ];
    }
}