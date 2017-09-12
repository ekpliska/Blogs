<?php
    use yii\widgets\ActiveForm;
    use yii\jui\DatePicker;
    use yii\helpers\Html;
?>


<?php $formComm = ActiveForm::begin(['options' => ['id' => 'newcom', 'class' => 'form-horizontalp']]) ?>
<table>
    <tr>
        <td><?php $formComm->field($formAddComm, 'id_Post')->textInput(); ?></td>
    </tr>
    <tr>
        <td>
            <?= $formComm->field($formAddComm, 'dateComment')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $formComm->field($formAddComm, 'autorComment')->textInput(['placeholder' => 'Автор кооментария', 'maxlength' => 50]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?= $formComm->field($formAddComm, 'textComment')->textarea(['placeholder' => 'Ваш комментарий', 'rows' => 5, 'cols' => 60]) ?>
        </td>
    </tr>
    <tr>
      <td colspan="2">
          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-link pull-left']) ?>
      </td>
    </tr>
</table>
<?php ActiveForm::end(); ?>
