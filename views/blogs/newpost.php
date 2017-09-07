<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Categories;
    use yii\helpers\ArrayHelper;
?>
<?php if(Yii::$app->session->hasFlash('success')) 
    echo Yii::$app->session->getFlash('success',false) ?>


<?php if(Yii::$app->session->hasFlash('error'))
    echo Yii::$app->session->getFlash('error',false); ?>
<h4>Новая статья</h4>
<?php $form = ActiveForm::begin(['options'=>['id'=>'newpost', 'class' => 'navbar-form navbar-left']]) ?>
<table>
    <tr>
        <td><?= $form->field($formPost, 'autorPost')->textInput(['placeholder' => 'Автор статьи']) ?></td>
        <td>
            <?= $form->field($formPost, 'id_Category')->dropDownList(ArrayHelper::map(Categories::find()->all(), 
                    'idCategories', 'nameCategories'),
                    ['prompt' => 'Выберите категорию']) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($formPost, 'titlePost')->textInput(['placeholder' => 'Заголовок статьи']) ?>
        </td>
        <td>
            <?= $form->field($formPost, 'id_Category')->label('New category') ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $form->field($formPost, 'textPost')->textarea(['rows' => 15, 'cols' => 100]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($formPost, 'datePost')->textInput(['placeholder' => date('d-m-Y')]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= Html::submitButton('Создать',['class'=>'btn btn-primary pull-right']) ?>
        </td>
    </tr>
</table>        
<?php ActiveForm::end() ?>
