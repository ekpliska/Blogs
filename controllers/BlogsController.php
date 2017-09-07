<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Posts;
use app\models\Categories;
use \yii\web\NotFoundHttpException;
?>
<?php
class BlogsController extends Controller {
    public function actionIndex(){
        $category = Categories::find()->orderBy('nameCategories')->all();
        return $this->render('index', compact(['category']));
    }
    public function actionPosts($id_Category) {
        $category = Categories::findOne($id_Category);
        $post = Posts::find()->where(['id_Category' => $id_Category]) -> all();
        $count = Posts::find()->where(['id_Category' => $id_Category])->count();
        if (!$category) {
            throw new NotFoundHttpException ('Искомая категория не найденна');
        }
        else
        {
            return $this->render('posts', compact('post', 'count'));
        }
    }
}
?>
