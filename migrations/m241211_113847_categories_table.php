<?php

use yii\db\Migration;

/**
 * Class m241211_113847_categories_table
 */
class m241211_113847_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // category table
        $this->createTable('category',[
            'id' => $this->bigInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'title' => $this->string(255),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // sub_category table
        $this->createTable('sub_category',[
            'id' => $this->bigInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'sub_title' => $this->string(255),
            'cat_id' => $this->bigInteger()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // Add foriegn key sub_category.cat_id -> category.id
        $this->addForeignKey('fk-subcat-cat-id','sub_category','cat_id','category','id','CASCADE','CASCADE');

        // product table
        $this->createTable('product',[
            'id' => $this->bigInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'prod_title' => $this->string(255),
            'cat_id' => $this->bigInteger()->notNull(),
            'prod_name' => $this->string(255),
            'subcat_id' => $this->bigInteger()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // Add foriegn key product.cat_id -> category.id and product.subcat_id -> sub_category.id
        $this->addForeignKey('fk-prod-cat-id','product','cat_id','category','id','CASCADE','CASCADE');
        $this->addForeignKey('fk-prod-subcat-id','product','subcat_id','sub_category','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foriegn keys
        $this->dropForeignKey('fk-subcat-cat-id','sub_category');
        $this->dropForeignKey('fk-prod-cat-id','product');
        $this->dropForeignKey('fk-prod-subcat-id','product');

        // Drop Tables
        $this->dropTable('category');
        $this->dropTable('sub_category');
        $this->dropTable('product');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241211_113847_categories_table cannot be reverted.\n";

        return false;
    }
    */
}
