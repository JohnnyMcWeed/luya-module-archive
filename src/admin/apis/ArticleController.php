<?php

namespace johnnymcweed\archive\admin\apis;

/**
 * Article Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ArticleController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\archive\models\Article';
}