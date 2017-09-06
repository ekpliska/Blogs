<?php
    use yii\helpers\Html;
?>

<h4>Статьи : по категории <?php echo $_GET['id'] ?></h4>
<?php
foreach ($post as $n=>$pst){
    echo Html::a($pst->titlePost.' '.$pst->autorPost).'<br/>';
}
?>