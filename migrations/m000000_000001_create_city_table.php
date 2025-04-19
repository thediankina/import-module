<?php

use yii\db\Migration;

class m000000_000001_create_city_table extends Migration
{
    public string $table = 'city';
    public string $primaryKey = 'id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            $this->primaryKey => $this->bigInteger()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->null(),
            'PRIMARY KEY ([[' . $this->primaryKey . ']])',
        ]);

        $this->createIndex(
            'idx-user-name',
            $this->table,
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
