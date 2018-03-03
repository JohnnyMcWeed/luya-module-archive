<?php

namespace johnnymcweed\archive\admin\apis;

/**
 * Cat Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class CatController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\archive\models\Cat';
}