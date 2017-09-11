<?php
    use app\models\Categories;
    use app\models\Comments;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use yii\jui\DatePicker;
?>
<!-- Вывод статьи -->
<div class="page-header"><h4>Статья от <?= $postshow->autorPost ?></h4></div>
<table   class="table">
    <tr>
        <td width="10%"><?= $postshow->datePost ?></td>
        <td><?= $postshow->titlePost ?></td>
        <td colspan="2"><?php $namec = Categories::findOne(['idCategories' => $postshow->id_Category]); echo $namec->nameCategories; ?></td>
    </tr>
    <tr>
        <td colspan="3"><?= $postshow->textPost ?></td>
    </tr>
    <tr>
        <td colspan="3">
            <?php echo Html::a('Редактировать', Url::to(['blogs/editpost', 'idPost' => $postshow->idPost]), array('class' => 'btn btn-link pull-right')); ?>
            <?php echo Html::a('Удалить', array(''), array('class' => 'btn btn-link pull-right')); ?>
            <?php echo Html::a('Назад', array(''), array ('class' => 'btn btn-link pull-right')); ?>
        </td>
    </tr>
    <tr><td colspan="3">
        <?php if(Yii::$app->session->hasFlash('success'))
            echo Yii::$app->session->getFlash('success',false) ?>
        <?php if(Yii::$app->session->hasFlash('error'))
            echo Yii::$app->session->getFlash('error',false); ?>
    </td></td>
</table>
<div class="well">
<!-- Вывод формы комментария -->
<?php $formcomm = ActiveForm::begin(['options' => ['id' => 'newcom', 'class' => 'form-horizontalp']]) ?>
<table>
    <caption><span class="label label-default">Добавить комментарий</span></caption>
    <tr>
        <td><?= $formcomm->field($formAddComm, 'id_Post')->hiddenInput(['value' => $postshow->idPost])->label(''); ?></td>
    </tr>
    <tr>
        <td>
            <?= $formcomm->field($formAddComm, 'dateComment')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $formcomm->field($formAddComm, 'autorComment')->textInput(['placeholder' => 'Автор кооментария', 'maxlength' => 50]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $formcomm->field($formAddComm, 'textComment')->textarea(['placeholder' => 'Ваш комментарий', 'rows' => 5, 'cols' => 60]) ?>
        </td>
    </tr>
    <tr>
      <td colspan="2">
          <?= Html::submitButton('Добавить', ['class' => 'btn btn-link pull-left']) ?>
      </td>
    </tr>
</table>
</div>
<?php ActiveForm::end(); ?>
<!-- Вывод комментариев к статье -->
<div class="page-header"><h4><span class="label label-primary">Комментарии к статье</span></h4></div>
<?php foreach ($commentshow as $com): ?>
<div class="panel panel-default">
  <div class="panel-body">
        <?php echo Yii::$app->formatter->asDate($com->dateComment); ?>
        <?php echo ($com->autorComment); ?>
        <?php echo Html::a('Редактировать', array(''), array('class' => 'btn btn-link pull-right')); ?>
        <?php echo Html::a('Удалить', array(''), array ('class' => 'btn btn-link pull-right')); ?>
    </div>
<div class="panel-footer">
  <?php echo ($com->textComment); ?></div>

</div>
<?php endforeach; ?>
