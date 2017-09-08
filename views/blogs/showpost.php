<?php
    use app\models\Categories;
    use app\models\Comments;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
?>
<!-- Вывод статьи -->
<h4>Статья</h4>
<table width="100%" cellpadding="10">
    <caption>Статья от <?= $postshow->autorPost ?></caption>
    <tr>
        <td width="10%"><?= $postshow->datePost ?></td>
        <td><?= $postshow->titlePost ?></td>
    </tr>
    <tr>
        <td colspan="2"><?php $namec = Categories::findOne(['idCategories' => $postshow->id_Category]); echo $namec->nameCategories; ?></td>
    </tr>
    <tr>
        <td colspan="2"><?= $postshow->textPost ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <?php echo Html::a('Редактировать', Url::to(['blogs/editpost', 'idPost' => $postshow->idPost]), array('class' => 'btn btn-link pull-left')); ?>
            <?php echo Html::a('Удалить', array(''), array('class' => 'btn btn-link pull-left')); ?>
            <?php echo Html::a('Назад', array(''), array ('class' => 'btn btn-link pull-left')); ?>
        </td>
    </tr>
</table>
<!-- Вывод формы комментария -->
<?php $formcomm = ActiveForm::begin(['options' => ['id' => 'newcom']]) ?>
<table>
    <caption>Добавить комментарий</caption>
    <tr>
        <td><?= $formcomm->field($formAddComm, 'id_Post')->hiddenInput(['value' => $postshow->idPost])->label(''); ?></td>
    </tr>
    <!-- Вывод сообщения о + или - создании комента -->
    <tr><td>
        <?php if(Yii::$app->session->hasFlash('success'))
            echo Yii::$app->session->getFlash('success',false) ?>
        <?php if(Yii::$app->session->hasFlash('error'))
            echo Yii::$app->session->getFlash('error',false); ?>
    </td></td>
    <!-- -->
    <tr>
        <td>
            <?= $formcomm->field($formAddComm, 'dateComment')->textInput(['placeholder' => Date('Y-m-d')]) ?>
        </td>
        <td rowspan="2">
            <?= $formcomm->field($formAddComm, 'textComment')->textarea(['placeholder' => 'Ваш комментарий', 'rows' => 5, 'cols' => 60]) ?>
        </td>
        <td rowspan="2">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-link pull-left']) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $formcomm->field($formAddComm, 'autorComment')->textInput(['placeholder' => 'Автор кооментария', 'maxlength' => 50]) ?>
        </td>
    </tr>
</table>
<?php ActiveForm::end(); ?>
<!-- Вывод комментариев к статье -->
<table>
    <caption>Комментарии к статье</caption>
    <?php foreach ($commentshow as $com): ?>
    <tr>
        <td><?php echo ($com->dateComment); ?></td>
        <td rowspan="2"><?php echo ($com->textComment); ?></td>
        <td rowspan="2">
            <?php echo Html::a('Редактировать', array(''), array('class' => 'btn btn-link pull-right')); ?>
            <?php echo Html::a('Удалить', array(''), array ('class' => 'btn btn-link pull-right')); ?>
        </td>
    </tr>
    <tr>
        <td><?php echo ($com->autorComment); ?></td>
    </tr>
<?php endforeach; ?>
</table>
