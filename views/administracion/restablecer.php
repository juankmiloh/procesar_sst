<?php
    use yii\helpers\Url;
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
                <h5>Ingrese y confirme su contraseña.</h5>
                <div id="inputs">
                    <strong><div id="msn_result" style="display:none; font-size: 18; ">MSN</div></strong>
                    <div class="form-block">
                        <input type="password" placeholder="Contraseña" id="password"> <i class="icon-eye2"></i>
                    </div>    
                    <div class="form-block">
                        <input type="password" placeholder="Confirmar contraseña" id="password2"><i class="icon-eye2"></i>
                    </div>
                    <input type="submit" id="buttonSendMail" onclick="updatePass()" value="Restablecer contraseña">
                </div>
            </div>
    </body>
    
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
    <script>
        function updatePass(){
            $("#buttonSendMail").css("display", "none");
            var pass1 = $("#password").val();
            var pass2 = $("#password2").val();
            $("#msn_result").css("display", "none");
            
            if(pass1.length < 8){
                $("#msn_result").css("display", "block");
                $("#msn_result").css("color", "red");
                $("#msn_result").text("La contraseña debe tener al menos 8 caracteres");
                $("#buttonSendMail").css("display", "block");
            } else if(pass1 != pass2){
                $("#msn_result").css("display", "block");
                $("#msn_result").css("color", "red");
                $("#msn_result").text("La contraseña y su confirmación no coinciden");
                $("#buttonSendMail").css("display", "block");
            } else {
            
                $.ajax({
                    url: '<?php echo Url::toRoute('administracion/actualizarcontrasena'); ?>',
                    data: {key : pass1, token : getUrlParameter('token')},
                    success: function( data ) {

                        if(data == "true"){
                            $("#inputuserrec").val("");
                            $("#msn_result").css("display", "block");
                            $("#msn_result").css("color", "green");
                            $("#msn_result").text("La contraseña ha sido actualizada exitosamente");
                            setTimeout(function(){
                                window.location.href = "<?php echo Url::toRoute('site/index'); ?>";
                            }, 3000);

                        } else {
                            $("#msn_result").css("display", "block");
                            $("#msn_result").css("color", "red");
                            $("#msn_result").text("Ha ocurrido un error");
                        }
                    }
                });
            }
        }
        
        /**
         * Retorna un parametro de la URL
         * @param {type} sParam
         * @returns {getUrlParameter.sParameterName|Boolean}         */
        function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        }
        
    </script>
</html>