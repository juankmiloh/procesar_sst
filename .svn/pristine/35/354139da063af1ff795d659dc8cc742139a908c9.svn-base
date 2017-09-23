<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Bootstrap Gallery">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <title>RESTABLECER CONTRASEÑA</title>
        <link href="../css/login.css" rel="stylesheet" media="screen">
        <link href="../fonts/icomoon/icomoon.css" rel="stylesheet">

    </head>
    <body class="login background_images">
            <div id="login-wrapper">
                <div id="login_header">
                    <img src="../img/logo.png" class="logo" alt="Admin Dashboard">
                </div>
                <div class="login-user">
                    <i class="icon-account_circle" style="font-size:48px;"></i>
                </div>
                <h5>Introduzca su dirección de correo electrónico a continuación para restablecer su contraseña.</h5>
                <div id="inputs">
                    <strong><div id="msn_result_ok" style="display:none; font-size: 18; color: green">Por favor verifique su correo</div></strong>
                    <strong><div id="msn_result_error" style="display:none; font-size: 18; color: red">Su solicitud no pudo ser procesada</div></strong>
                    <div class="form-block">
                        <input type="text" placeholder="Email" id="inputuserrec"> <i class="icon-envelope">
                        </i>
                    </div>
                    <input type="submit" id="buttonSendMail" onclick="sendMailPass()" value="Restablecer Contraseña">
                    <?=  Html::a( Yii::t('app', "INICIO"), array("site/login"), array('style' => 'color: #337ab7;text-decoration: none;')); ?>
                </div>
            </div>
    </body>
    
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
    <script>
        function sendMailPass(){
            $("#buttonSendMail").css("display", "none");
            var correo = $("#inputuserrec").val();
            $.ajax({
                url: '<?php echo Url::toRoute('administracion/recuperarcontrasena'); ?>',
                data: {'mail' : correo},
                success: function( data ) {
                    
                    if(data == "true"){
                        $("#inputuserrec").val("");
                        $("#msn_result_error").css("display", "none");
                        $("#msn_result_ok").css("display", "block");
                        setTimeout(function(){
                            window.location.href = "<?php echo Url::toRoute('site/index'); ?>";
                        }, 3000);
                        
                    } else {
                        $("#msn_result_ok").css("display", "none");
                        $("#msn_result_error").css("display", "block");
                        $("#buttonSendMail").css("display", "block");
                    }
                }
            });
        }
    </script>
</html>