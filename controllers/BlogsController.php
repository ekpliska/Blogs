<?php
    namespace app\controllers;
    use Yii;
    use yii\web\Controller;
    use app\models\Posts;
    use app\models\Categories;
    use app\models\Comments;
    use app\models\Tags;
    use app\models\Tags_p;
    use \yii\web\NotFoundHttpException;
    use yii\db\ActiveQuery;
?>
<?php
class BlogsController extends Controller {

    // Просмотр всех категорий + создание новой категории
    public function actionIndex () {
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

    //Просмотр статей по выбранной категории
    public function actionPosts ($slug = null) {
        $category = Categories::findOne(['slug' => $slug]);
        if ($category === null) {
            throw new NotFoundHttpException ('Искомая категория не найденна');
        }
        else
        {
            $post = $category->posts;
            return $this->render('posts', compact(['post','category']));
        }
    }

    // Новая статья
    public function actionNewpost () {
        $formPost = new Posts();
        $formTags = new Tags();
        $showTags = Tags::find()->orderBy('nameTag')->all();
        if ($formPost->load(Yii::$app->request->post())) {
            if ($formPost->validate()) {
                Yii::$app->session->setFlash('success', 'Новая статья успешно создана');
                $formPost->save();
                //return $this->refresh();
                return $this->redirect(['showpost', 'slug' => $formPost->slug]);
            }
            else {
                Yii::$app->session->setFlash('error', 'Ошибка создания новой статьи');
            }
        }
        return $this->render('newpost', compact(['formPost', 'showTags', 'formTags']));
    }

    // Просмотр статьи + добаление нового комментария +  просмотр всех коментариев
    public function actionShowpost ($slug = null) {
        $postshow = Posts::findOne(['slug' => $slug]);
        $formAddComm = new Comments();
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
        return $this->render('showpost', compact(['postshow', 'formAddComm', /* 'commentshow'*/]));
        }
    }

    // Редактирование статьи
    public function actionEditpost ($slug = null) {
        $editPst = Posts::findOne(['slug' => $slug]);
        if ($editPst === null) {
            throw new NotFoundHttpException ('Искомая статья не найденна');
        }
        else
        {
            if ($editPst->load(Yii::$app->request->post()) && $editPst->save()) {
                return $this->redirect(['showpost', 'slug' => $editPst->slug]);
            }
            return $this->render('editpost', compact(['editPst', 'editForm']));
        }
    }

    // Удаление категории
    public function actionDeletecat ($slug = null) {
        if ($slug === null)
  		{
    		Yii::$app->session->setFlash('error', 'Удаляемая категория не найдена');
    		Yii::$app->getResponse()->redirect(array('blogs/index'));
  		}
  		$cats = Categories::findOne(['slug' => $slug]);
        $post = $cats->posts;
   		if ($cats === null || count($post) <> 0)
   		{
    		Yii::$app->session->setFlash('error', 'С удаляемой категорией свзяны статьи. Удаление данной категории невозможно');
    	 	Yii::$app->getResponse()->redirect(array('blogs/index'));
  		}
        else {
            $cats->delete();
      		Yii::$app->session->setFlash('success', 'Выбранная категория успешно удалена');
      		Yii::$app->getResponse()->redirect(array('blogs/index'));
        }
  	}

    // Удаление комментария
    public function actionDeletecom ($id_Comment = null) {
        $comments = Comments::findOne($id_Comment);
        if ($id_Comment === null) {
            Yii::$app->session->setFlash ('error', 'Выбранный комментарий удалить невозможно');
            Yii::$app->getResponse()->redirect(array('blog/showpost', 'slug' => $comments->id_Post));
        }
        else {
            $comments->delete();
            Yii::$app->session->setFlash('success','Выбранный комменарий успешно удален');
            Yii::$app->getResponse()->redirect(array('blogs/showpost', 'idPost' => $comments->id_Post));
        }
    }

    // Редактирование комментария
    public function actionEditcomment ($idComment = null) {
        $editCom = Comments::findOne($idComment);
        if ($editCom === null) {
            throw new NotFoundHttpException ('Искомый комментарий не найден');
        }
        else {
             if ($editCom->load(Yii::$app->request->post()) && $editCom->save()) {
                 Yii::$app->session->setFlash('success', 'Ваш комментарий изменен');
                 return $this->redirect(['showpost', 'idPost' => $editCom->id_Post]);
             }
            return $this->render('editcomment', compact(['editCom']));
        }
    }

    // Удаление статьи и комментариев к ней
    public function actionDeletepost ($slug = null) {
        $delpost = Posts::findOne(['slug' => $slug]);
        if ($delpost === null) {
             Yii::$app->session->setFlash('error', 'Удаляемая статья не найдена');
             Yii::$app->getResponse()->redirect(array('blogs/showpost', 'slug' => $slug));
        }
        else {
            $delpost->delete();
            Yii::$app->session->setFlash('success', 'Статья и закрепленные за ней комментарии были удалены');
            Yii::$app->getResponse()->redirect(array('blogs/index'));
        }
    }

    // Редактирование категории
    public function actionEditCat ($slug = null) {
        $editCtg = Categories::findOne(['slug' => $slug]);
        if ($editCtg === null) {
            throw new NotFoundHttpException ('Искомая категория не найденна');
        }
        else
        {
            if ($editCtg->load(Yii::$app->request->post()) && $editCtg->save()) {
                Yii::$app->session->setFlash('success', 'Выбранная категория изменена');
                return $this->redirect(['blogs/index']);
            }
            return $this->render('editcat', compact(['editCtg']));
        }
    }
}
?>
