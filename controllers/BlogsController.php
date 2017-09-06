<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Categories;
use app\models\Posts;
?>
<?php
class BlogsController extends Controller {
    public function actionIndex(){
        $category = Categories::find()->orderBy('nameCategories')->all();
        return $this->render('index', compact(['category']));
    }
    public function actionPosts()
    {
        $post = Posts::find()->andWhere('id_Category = '.$_GET['id'])->all();
        return $this->render('posts', compact(['post']));
    }
    
}
?>

