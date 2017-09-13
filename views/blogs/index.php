<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
<<<<<<< HEAD
?>
<?php $this->title = "Блог" ?>
<div class="page-header"><h4>Категории</h4></div>
<div class="well">
    <?php echo $this->render('_formcat',compact(['newCats'])); ?>
</div>
<?php if(Yii::$app->session->hasFlash('success')) : ?>
<div class="alert alert-info">
    <strong>
        <?php echo Yii::$app->session->getFlash('success',false) ?>
    </strong>
</div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-info">
        <strong>
            <?php echo Yii::$app->session->getFlash('error',false); ?>
        </strong>
    </div>
<?php endif; ?>
<ul class="list-group">
<?php foreach ($category as $n=>$cat) : ?>
    <li class="list-group-item">
        <a href="<?=Url::to(['blogs/posts', 'slug' => $cat->slug])?>">
            <?= Html::encode($cat->nameCategories)?>
        </a>
        <?php echo Html::a(Yii::t('common', 'Edit'), ['blogs/edit-cat', 'slug' => $cat->slug], [
                        'class' => 'btn btn-info btn-xs']); ?>
        <?php echo Html::a(Yii::t('common', 'Detele'), ['blogs/deletecat', 'slug' => $cat->slug], [
                        'class' => 'btn btn-danger btn-xs',
                        'data' => [
                            'confirm' => Yii::t('common', 'Delete Category?'),
                            'method' => 'post',
                        ],
                        ]);
        ?>
    </li>
<?php endforeach; ?>
=======
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
>>>>>>> 40210ab142eb019795a239e310090ff54ff4f53f
</ul>
