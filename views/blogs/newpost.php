<?php
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use app\models\Tags;
?>
<?php $this->title = "Блог :: Создание новой статьи" ?>
<div class="page-header"><h4>Новая статья</h4></div>
<?php echo $this->render('_form', compact(['formPost', 'showTags', 'formTags'])); ?>
