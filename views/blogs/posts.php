<?php
    use app\models\Categories;
    use app\models\Comments;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<div class="page-header">
    <h4>
        <?php echo Html::a('Категории', Url::to(['blogs/index'])); ?>
        <?php echo $category->nameCategories; ?> (<?php echo (count($post)) ?>)
    </h4>
</div>
<br />
<?php echo Html::a('Новая статья', array('/blogs/newpost'), array('class' => 'btn btn-primary pull-right')); ?>
<br/>
<?php if (count($post) == 0):
        echo 'В данной категории статьи отсутсвуют';
 else: ?>
 <?php foreach ($post as $pst): ?>
<table class="table">
    <tr>
        <td rowspan="3" width="15%">
            <?php echo Yii::$app->formatter->asDate($pst->datePost); ?>
        </td>
        <td colspan="2">
            <?php echo Html::a($pst->titlePost, Url::to(['blogs/showpost', 'idPost' => $pst->idPost])); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo ($pst->autorPost); ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <?php echo mb_substr($pst->textPost, 0, 100); ?>
        </td>
    </tr>
    <tr>
        <td>
            <span class="label label-success">Теги</span>
        </td>
        <td>
            <span class="label label-success">Комментарии <?php echo (Comments::find()->where(['id_Post' => $pst->idPost])->count()) ?></span>
        </td>
        <td><?php echo Html::a('Далее', Url::to(['blogs/showpost', 'idPost' => $pst->idPost])); ?></td>
        
    </tr>
</table>
 <?php endforeach; endif; ?>
