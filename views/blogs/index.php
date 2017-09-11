<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>
<div class="page-header"><h4>Категории</h4></div>
<div class="well"><?php $formcat = ActiveForm::begin(['options' => ['id' => 'addcat']]); ?>
<table>
    <tr>
        <td><?= $formcat->field($newCats, 'nameCategories')->textInput(); ?></td>
        <td><?= Html::submitButton('Добавить', ['class' => 'btn btn-link pull-left']) ?></td>
    </tr>
</table>
</div>
<?php if(Yii::$app->session->hasFlash('success'))
    echo Yii::$app->session->getFlash('success',false) ?>


<?php if(Yii::$app->session->hasFlash('error'))
    echo Yii::$app->session->getFlash('error',false); ?>
<?php ActiveForm::end(); ?>
<ul class="list-unstyled">
<?php
foreach ($category as $n=>$cat) {
    echo '<li>'.Html::a($cat->nameCategories, Url::to(['blogs/posts', 'id_Category' => $cat->idCategories])).' ';
    echo '<abbr title="Удалить категорию" class="attribute">'.Html::a('Удалить', Url::to(['blogs/delete', 'id_Category' => $cat->idCategories])).'</span>';
    echo "</li>";
;}
?>
</ul>
