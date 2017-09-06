<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<h4>Категории</h4>
<?php
foreach ($category as $n=>$cat) {
    echo Html::a($cat->nameCategories, Url::to(['blogs/posts', 'id' => $cat->idCategories])).'<br/>';
}
?>