<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use app\models\Categories;
?>

<?php $form = ActiveForm::begin(['options'=>['id'=>'newpost', 'class' => 'navbar-form navbar-left']]) ?>
<table>
    <tr>
        <td><?= $form->field($formPost, 'autorPost')->textInput(['placeholder' => 'Автор статьи', 'autofocus' => true, 'maxlength' => 50]) ?></td>
        <td>
            <?= $form->field($formPost, 'id_Category')->dropDownList(ArrayHelper::map(Categories::find()->all(),
                    'idCategories', 'nameCategories'),
                    ['prompt' => 'Выберите категорию']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $form->field($formPost, 'titlePost')->textInput(['placeholder' => 'Заголовок статьи', 'maxlength' => 100]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $form->field($formPost, 'textPost')->textarea(['rows' => 15, 'cols' => 100]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($formPost, 'datePost')->input('date') ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= Html::submitButton('Создать',['class'=>'btn btn-primary pull-right']) ?>
        </td>
    </tr>
    <pre>
        <?php print_r($formPost->datePost) ?>
    </pre>
</table>
<?php ActiveForm::end() ?>
