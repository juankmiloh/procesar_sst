<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Esquare Admin Panel">
        <meta name="keywords" content="Admin, Dashboard, Bootstrap3, Sass, transform, CSS3, HTML5, Web design, UI Design, Responsive Dashboard, Responsive Admin, Admin Template, Best Admin UI, Bootstrap Template, Wrapbootstrap, Bootstrap"><meta name="author" content="Bootstrap Gallery">
        <link rel="shortcut icon" href="../img\favicon.ico">
        <title><?=Yii::t('app', "TITLE_PAGE")?></title>
        <link href="../css\login.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../fonts\icomoon\icomoon.css" rel="stylesheet">
    </head>
    
    <body class="login background_images">
        <div class="container-fluid">
            <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>
            
                <div id="login-wrapper">
                    <div id="login_header"><img src="../img\logo.png" class="logo" alt="Admin Dashboard"></div>
                    
                    <h5><?=Yii::t('app', "MSN_LOGIN")?></h5>



                    <div id="inputs">
                        <?php 
                            if(count($model->errors) > 0){
                                foreach ($model->errors as $key => $value) {
                                    echo "<font color='red'>".$model->errors[$key][0]."</font>"; 
                                }
                                
                            }
                        ?>
                        <div class="form-block"> <?= Html::activeTextInput($model, 'username', ['placeholder' => 'Usuario']); ?> <i class="icon-account_circle"></i></div>
                        <div class="form-block"> <?= Html::activePasswordInput($model, 'password'); ?> <i class="icon-eye2"></i></div>
                        <input type="submit" value="<?=Yii::t('app', "INGRESAR")?>">
                        <?=  Html::a( Yii::t('app', "OLV_CONTRASENA"), array("administracion/changepassword")); ?>
                    </div>
                    
                    
                </div>
            
            <?php ActiveForm::end(); ?>
            <footer>
                    <div class="footer"></div>
                    <div class="copy">Copyright <a href="http://www.camaleon.com.co">Camaleon Multimedia SAS</a> V 1.1<span> 2017</span>.</div>
            </footer>
        </div>
    </body>
    
</html>