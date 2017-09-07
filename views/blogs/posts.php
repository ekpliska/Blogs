<?php
    use yii\helpers\Html;
    use app\models\Posts;
    use yii\web\Request;
    use yii\widgets\ListView;    
?>
<h4>В категории <?php ?> всего статей <?php echo $count; ?></h4>
<br />
<?php echo Html::a('Новая статья', array('blogs/newpost'), array('class' => 'btn btn-primary pull-right')); ?>
<br/>
<?php
    if ($count == 0) {
        echo 'В данной категории статьи отсутсвуют';
    }
 else{
?>
<table class="table table-striped table-hover">
<?php foreach ($post as $pst): ?>
    <tr>
        <td>
            <?php echo ($pst->datePost); ?>
        </td>
        <td>
            <?php echo ($pst->titlePost); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php echo mb_substr($pst->textPost, 0, 100); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo ($pst->autorPost); ?>
        </td>
        <td>Комментарии</td>        
    </tr>
 <?php endforeach;} ?>
</table>
