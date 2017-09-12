<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>
<?php $formcat = ActiveForm::begin(['options' => ['id' => 'addcat']]); ?>
<table>
    <tr>
        <td><?= $formcat->field($newCats, 'nameCategories')->textInput(); ?></td>
        <td><?= Html::submitButton($newCats->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-link pull-left']) ?></td>
    </tr>
</table>
<?php ActiveForm::end(); ?>
