<?php
    use app\models\Categories;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<h4>В категории <?php echo ''; ?> всего статей <?php echo '' ?></h4>
<br />
<?php echo Html::a('Новая статья', array('/blogs/newpost'), array('class' => 'btn btn-primary pull-right')); ?>
<br/>
<?php
/*    if ($count == 0) {
        echo 'В данной категории статьи отсутсвуют';
    }
 else{ */
?>
<table class="table table-striped table-hover">
<?php foreach ($post as $pst): ?>
    <tr>
        <td>
            <?php echo ($pst->datePost); ?>
        </td>
        <td colspan="3">
            <?php echo Html::a($pst->titlePost, Url::to(['blogs/showpost', 'idPost' => $pst->idPost])); ?>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <?php echo mb_substr($pst->textPost, 0, 100); ?>
        </td>
    </tr>
    <tr>
        <td>
            Теги
        </td>
        <td>
            <?php echo ($pst->autorPost); ?>
        </td>
        <td>Комментарии</td>
        <td><?php echo Html::a('Далее', Url::to(['blogs/showpost', 'idPost' => $pst->idPost])); ?></td>
    </tr>
 <?php endforeach; ?>
</table>
