<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Posts;
use app\models\Categories;
use app\models\Comments;
use \yii\web\NotFoundHttpException;
?>
<?php
class BlogsController extends Controller {
    public function actionIndex(){
        $category = Categories::find()->orderBy('nameCategories')->all();
        return $this->render('index', compact(['category']));
    }
    public function actionPosts($id_Category = null) {
        $category = Categories::findOne($id_Category);
        if ($category === null) {
            throw new NotFoundHttpException ('Искомая категория не найденна');
        }
        else
        {
            $post = $category->posts;
            return $this->render('posts', compact(['post']));
        }
    }
    public function actionNewpost (){
        $formPost = new Posts();
        if ($formPost->load(Yii::$app->request->post())) {
            if ($formPost->validate()) {
                Yii::$app->session->setFlash('success', 'Новая статья успешно создана');
                $formPost->save();
                return $this->refresh();
            }
            else {
                Yii::$app->session->setFlash('error', 'Ошибка создания новой статьи');
            }
        }
        return $this->render('newpost', compact(['formPost']));
    }
    public function actionShowpost($idPost = null){
        $postshow = Posts::findOne($idPost);
        $formAddComm = new Comments();
        $commentshow = Comments::find()->where(['id_Post' => $idPost])->all();
        if ($postshow === null) {
            throw new NotFoundHttpException ('Искомая статья не найдена');
        }
        else {
            if ($formAddComm->load(Yii::$app->request->post())){
                if ($formAddComm->validate()) {
                    Yii::$app->session->setFlash('success', 'Комментарий добавлен успешно');
                    $formAddComm->save();
                    return $this->refresh();
                }
                else {
                    Yii::$app->session->setFlash('error', 'Ошибка добавления комменрария');
                }
            }
            return $this->render('showpost', compact(['postshow', 'formAddComm', 'commentshow']));
        }
    }
    public function actionEditpost ($idPost = null){
        $editPst = Posts::findOne($idPost);
        $editForm = new Posts();
        if ($editPst === null) {
            throw new NotFoundHttpException ('Искомая статья не найденна');
        }
        else
        {
            return $this->render('editpost', compact(['editPst', 'editForm']));
        }
    }
}
?>
