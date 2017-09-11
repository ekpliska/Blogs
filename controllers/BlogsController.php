<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Posts;
use app\models\Categories;
use app\models\Comments;
use \yii\web\NotFoundHttpException;
use yii\db\ActiveQuery;
?>
<?php
class BlogsController extends Controller {
    public function actionIndex(){
        $category = Categories::find()->orderBy('nameCategories')->all();
        $newCats = new Categories();
        if ($newCats->load(Yii::$app->request->post())) {
            if ($newCats->validate()) {
                Yii::$app->session->setFlash('success', 'Новая категория успешно добавлена');
                $newCats->save();
                return $this->refresh();
            }
            else {
                Yii::$app->session->setFlash('error', 'Ошибка создания новой категории');
            }
        }
        return $this->render('index', compact(['category', 'newCats']));
    }
    public function actionPosts($id_Category = null) {
        $category = Categories::findOne($id_Category);
        if ($category === null) {
            throw new NotFoundHttpException ('Искомая категория не найденна');
        }
        else
        {
            $post = $category->posts;
            return $this->render('posts', compact(['post','category']));
        }
    }
    public function actionNewpost (){
        $formPost = new Posts();
        if ($formPost->load(Yii::$app->request->post())) {
            if ($formPost->validate()) {
                Yii::$app->session->setFlash('success', 'Новая статья успешно создана');
                $formPost->save();
                //return $this->refresh();
                return $this->redirect(['showpost', 'idPost' => $formPost->idPost]);
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
        if ($formAddComm->load(Yii::$app->request->post())) {
            if ($formAddComm->validate()) {
                Yii::$app->session->setFlash('success', 'Комментарий к статье добавлен');
                $formAddComm->save();
                return $this->refresh();
            }
            else {
                Yii::$app->session->setFlash('error', 'Ошибка добавления нового комментария');
            }
        }

            return $this->render('showpost', compact(['postshow', 'formAddComm', 'commentshow']));
        }
    }
    public function actionEditpost ($idPost = null){
        $editPst = Posts::findOne($idPost);
        if ($editPst === null) {
            throw new NotFoundHttpException ('Искомая статья не найденна');
        }
        else
        {
            if ($editPst->load(Yii::$app->request->post()) && $editPst->save()) {
                return $this->redirect(['showpost', 'idPost' => $editPst->idPost]);
            }
            return $this->render('editpost', compact(['editPst', 'editForm']));
        }
    }
    public function actionDelete ($id_Category = null)
    {
      if ($id_Category === NULL)
  		{
    		Yii::$app->session->setFlash('error', 'Удаляемая категория не найдена');
    		Yii::$app->getResponse()->redirect(array('blogs/index'));
  		}
  		$cats = Categories::findOne($id_Category);
  		if ($cats === NULL)
  		{
    		Yii::$app->session->setFlash('error', 'Удаляемая категория не найдена');
    		Yii::$app->getResponse()->redirect(array('blogs/index'));
  		}
  		$cats->delete();
  		Yii::$app->session->setFlash('success', 'Выбранная категория успешно удалена');
  		Yii::$app->getResponse()->redirect(array('blogs/index'));
  	}
}
?>
