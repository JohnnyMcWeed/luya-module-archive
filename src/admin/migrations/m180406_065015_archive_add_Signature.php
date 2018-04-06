<?php

use yii\db\Migration;

/**
 * Class m180406_065015_archive_add_Signature
 */
class m180406_065015_archive_add_Signature extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('archive_article', 'signature', $this->text());
        $this->addColumn('archive_cat', 'signature', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('archive_cat', 'signature');
        $this->dropColumn('archive_article', 'signature');
    }
}
