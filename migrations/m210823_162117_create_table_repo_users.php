<?php

use yii\db\Migration;

/**
 * Class m210823_162117_create_table_repo_users
 */
class m210823_162117_create_table_repo_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%repo_user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%repo_user}}');
    }
}
