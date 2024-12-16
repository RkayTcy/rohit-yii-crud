<?php
namespace app\commands;

use app\models\Category;
use Faker\Factory;
use Yii;
use yii\console\Controller;

class SeedController extends Controller{
    public function actionIndex(){
        $faker = Factory::create();
        $db = Yii::$app->db;

        $db->createCommand("SET FOREIGN_KEY_CHECKS = 0")->execute();
        $db->createCommand()->truncateTable("category")->execute();
        $db->createCommand()->truncateTable("sub_category")->execute();
        $db->createCommand()->truncateTable("product")->execute();

        for ($i=0; $i <= 21; $i++) { 
           $categoryModel = new Category();
           $categoryModel->title = $faker->title;
        }
    }
}