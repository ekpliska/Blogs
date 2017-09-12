<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Comments;
    use yii\helpers\ArrayHelper;
?>
<div class="page-header"><h4>Редактировать комментарий</h4></div>
<?php echo $this->render('_formcomm', ['formAddComm' => $editCom]); ?>
