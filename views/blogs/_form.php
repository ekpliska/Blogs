<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\CHtml;
    use app\models\Categories;
    use app\models\Tags;
    use yii\jui\DatePicker;
?>

<?php $form = ActiveForm::begin(['options'=>['id'=>'newpost', 'class' => 'form-horizontal']]) ?>
<table>
    <tr>
        <td><?= $form->field($formPost, 'autorPost')->textInput(['placeholder' => 'Автор статьи', 'autofocus' => true, 'maxlength' => 50]) ?></td>
    </tr>
    <tr>
        <td>
            <?= $form->field($formPost, 'id_Category')->dropDownList(ArrayHelper::map(Categories::find()->all(),
                    'idCategories', 'nameCategories'),
                    ['prompt' => 'Выберите категорию']) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($formPost, 'titlePost')->textInput(['placeholder' => 'Заголовок статьи', 'maxlength' => 100]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($formPost, 'textPost')->textarea(['rows' => 15, 'cols' => 100]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php //$form->field($formPost, 'datePost')->input('date') ?>
            <?= $form->field($formPost, 'datePost')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $form->field($formPost, 'selectTagID')->checkboxList(Tags::find()->select('nameTag')->indexBy('idTag')->column());?>
        </td>
    <tr>
        <td colspan="2">
            <?= Html::submitButton($formPost->isNewRecord ? 'Создать' : 'Сохранить', ['class'=>'btn btn-primary pull-right', 'name' => 'c']) ?>
        </td>
    </tr>

    </tr>
    <!--pre>
        <?php //print_r($formPost->datePost) ?>
    </pre -->
</table>
<?php ActiveForm::end() ?>
