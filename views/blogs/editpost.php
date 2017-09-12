<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Categories;
    use yii\helpers\ArrayHelper;
?>
<div class="page-header"><h4>Редактировать статью</h4></div>
<?php echo $this->render('_form', ['formPost' => $editPst]);?>
