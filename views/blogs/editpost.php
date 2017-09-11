<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Categories;
    use yii\helpers\ArrayHelper;
?>
<?php if(Yii::$app->session->hasFlash('success'))
    echo Yii::$app->session->getFlash('success',false) ?>


<?php if(Yii::$app->session->hasFlash('error'))
    echo Yii::$app->session->getFlash('error',false); ?>
<div class="page-header"><h4>Редактировать статью</h4></div>
<?php echo $this->render('_form', ['formPost' => $editPst]);?>
