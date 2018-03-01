<?php

namespace johnnymcweed\archive\admin;

/**
 * Archive Admin Module.
 *
 * File has been created with `module/create` command. 
 * 
 * @author
 * @since 1.0.0
 */
class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-archive-article' => 'johnnymcweed\archive\admin\apis\ArticleController',
        'api-archive-cat' => 'johnnymcweed\archive\admin\apis\CatController',
    ];

    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
            ->node(self::t('Archive'), 'archive')
            ->group('Archive Manager')
            ->itemApi(self::t('Article'), 'archiveadmin/article/index', 'insert_drive_file', 'api-archive-article')
            ->itemApi(self::t('Category'), 'archiveadmin/cat/index', 'library_books', 'api-archive-cat');
    }

    public static function onLoad()
    {
        self::registerTranslation('archiveadmin', '@archiveadmin/messages', [
            'archiveadmin' => 'archiveadmin.php',
        ]);
    }

    /**
     * Translate archive messages.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('archiveadmin', $message, $params);
    }
}