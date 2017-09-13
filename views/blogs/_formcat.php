<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>
<?php $formcat = ActiveForm::begin(['options' => ['id' => 'addcat']]); ?>
<table>
    <tr>
        <td><?= $formcat->field($newCats, 'nameCategories')->textInput(); ?></td>
        <td><?= Html::submitButton($newCats->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'), ['class' => 'btn btn-link pull-left']) ?></td>
        <td rowspan="2"><?= $formcat->field($newCats, 'slug')->hiddenInput()->label(''); ?></td>
    </tr>
</table>
<?php ActiveForm::end(); ?>
