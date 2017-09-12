<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
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
<?php endif; ?>
<ul class="list-group">
<?php foreach ($category as $n=>$cat) : ?>
    <li class="list-group-item">
        <a href="<?=Url::to(['blogs/posts', 'id_Category' => $cat->idCategories])?>">
            <?= Html::encode($cat->nameCategories)?>
        </a>
        <a class="btn btn-info btn-xs" href="<?=Url::to(['blogs/edit-cat', 'id_Category' => $cat->idCategories])?>">
            <?= Yii::t('common', 'Edit Category')?>
        </a>
        <a class="btn btn-danger btn-xs" href="<?=Url::to(['blogs/deletecat', 'id_Category' => $cat->idCategories])?>">
            <?= Yii::t('common', 'Delete Category')?>
        </a>
    </li>
    <?php /*
    echo '<li>'.Html::a($cat->nameCategories, Url::to(['blogs/posts', 'id_Category' => $cat->idCategories])).' ';
    echo '<abbr title="Редактировать категорию" class="attribute">'.Html::a('Редактировать', Url::to(['blogs/edit-cat', 'id_Category' => $cat->idCategories])).'</span>'.' ';
    echo '<abbr title="Удалить категорию" class="attribute">'.Html::a('Удалить', Url::to(['blogs/deletecat', 'id_Category' => $cat->idCategories])).'</span>';
    echo "</li>";
    */ ?>
<?php endforeach; ?>
</ul>
