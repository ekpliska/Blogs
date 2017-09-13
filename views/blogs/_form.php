<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
<<<<<<< HEAD
    use yii\helpers\CHtml;
    use app\models\Categories;
    use app\models\Tags;
=======
    use app\models\Categories;
>>>>>>> 40210ab142eb019795a239e310090ff54ff4f53f
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
<<<<<<< HEAD
            <?= $form->field($formPost, 'selectTagID')->checkboxList(Tags::find()->select('nameTag')->indexBy('idTag')->column());?>
        </td>
    <tr>
        <td colspan="2">
            <?= Html::submitButton($formPost->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save'), ['class'=>'btn btn-primary pull-right', 'name' => 'c']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $form->field($formPost, 'slug')->hiddenInput()->label('');; ?>
    </tr>
=======
            <?= Html::submitButton($formPost->isNewRecord ? 'Создать' : 'Сохранить', ['class'=>'btn btn-primary pull-right', 'name' => 'c']) ?>
        </td>
    </tr>
>>>>>>> 40210ab142eb019795a239e310090ff54ff4f53f
    <!--pre>
        <?php //print_r($formPost->datePost) ?>
    </pre -->
</table>
<?php ActiveForm::end() ?>
