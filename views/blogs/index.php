<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
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
</ul>
