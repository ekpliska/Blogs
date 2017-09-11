<div class="page-header"><h4>Новая статья</h4></div>

<?php if(Yii::$app->session->hasFlash('success'))
    echo Yii::$app->session->getFlash('success',false) ?>


<?php if(Yii::$app->session->hasFlash('error'))
    echo Yii::$app->session->getFlash('error',false); ?>


<?php echo $this->render('_form', compact(['formPost']));
