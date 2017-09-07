<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

/*
<?php
use \yii\web\Controller;
use \yii\base\HttpException;
use app\models\Post;

class SiteController extends Controller
{
	public function actionIndex()
	{
		$data = Post::find()->all();
		echo $this->render('index', array(
			'data' => $data
		));
	}
	/**
	public function actionCreate()
	{
		$model = new Post;
		if ($this->populate($_POST, $model) && $model->save())
			Yii::$app->response->redirect(array('site/read', 'id' => $model->id));
		echo $this->render('create', array(
			'model' => $model
		));
	}
	public function actionUpdate($id=NULL)
	{
		if ($id === NULL)
		{
			Yii::$app->session->setFlash('error', 'A post with that id does not exist');
			Yii::$app->getResponse()->redirect(array('site/index'));
		}
		$model = Post::find($id);
		if ($model === NULL)
		{
			Yii::$app->session->setFlash('error', 'A post with that id does not exist');
			Yii::$app->getResponse()->redirect(array('site/index'));
		}
		if ($this->populate($_POST, $model) && $model->save())
			Yii::$app->response->redirect(array('site/read', 'id' => $model->id));
		echo $this->render('create', array('model' => $model
		));
	}
	public function actionRead($id=NULL)
	{
		if ($id === NULL)
		{
			Yii::$app->session->setFlash('error', 'A post with that id does not exist');
			Yii::$app->getResponse()->redirect(array('site/index'));
		}
		$post = Post::find($id);
		if ($post === NULL)
		{
			Yii::$app->session->setFlash('error', 'A post with that id does not exist');
			Yii::$app->getResponse()->redirect(array('site/index'));
		}
		echo $this->render('read', array(
			'post' => $post
		));
	}
	public function actionDelete($id=NULL)
	{
		if ($id === NULL)
		{
			Yii::$app->session->setFlash('error', 'A post with that id does not exist');
			Yii::$app->getResponse()->redirect(array('site/index'));
		}
		$post = Post::find($id);
		if ($post === NULL)
		{
			Yii::$app->session->setFlash('error', 'A post with that id does not exist');
			Yii::$app->getResponse()->redirect(array('site/index'));
		}
		$post->delete();
		Yii::$app->session->setFlash('success', 'Your post has been successfully deleted');
		Yii::$app->getResponse()->redirect(array('site/index'));
	}
}
 */