<<<<<<< HEAD
<?php
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use app\models\Tags;
?>
<?php $this->title = "Блог :: Создание новой статьи" ?>
<div class="page-header"><h4>Новая статья</h4></div>
<?php echo $this->render('_form', compact(['formPost', 'showTags', 'formTags'])); ?>
=======
<div class="page-header"><h4>Новая статья</h4></div>

<?php if(Yii::$app->session->hasFlash('success'))
    echo Yii::$app->session->getFlash('success',false) ?>


<?php if(Yii::$app->session->hasFlash('error'))
    echo Yii::$app->session->getFlash('error',false); ?>


<?php echo $this->render('_form', compact(['formPost']));
>>>>>>> 40210ab142eb019795a239e310090ff54ff4f53f
