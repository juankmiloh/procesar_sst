<?php
    use yii\helpers\Html;
    use yii\helpers\UrL;
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<body class="background_images">

    <?php if(Yii::$app->user->identity->getRol() == "Administrador") { ?>
    <!-- Navegación -->
    <div class="container-fluid">
        <div class="dashboard-wrapper">
            
            <!-- Barra Azul -->
            <div class="top-bar clearfix">
                <div class="container-fluid">
                    <div class="row gutter">
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <h3 class="page-title"><?= Yii::t('app', "SISTEMA_COMPETENCIA") ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="main-container panel-body icons">
                <div class="row gutter">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 yellow-bg">
                        <?php 
                            echo Html::a('<img src="../img/flag.png" alt="'.Yii::t('app', "ESCENARIOS") .'">
                                <h3>'.Yii::t('app', "ESCENARIOS") .'</h3>',array("escenario/listar"));
                        ?>
                    </div>
                    <a href="<?php echo Url::toRoute(["escenario/listar"]) ?>">ESCENARIS</a>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 green-bg">
                        <?php 
                            echo Html::a('<img src="../img/torch.png" alt="'.Yii::t('app', "EVENTOS") .'">
                                <h3>'.Yii::t('app', "EVENTOS") .'</h3>',array("evento/listar"));
                        ?>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 orange-bg">
                        <?php 
                            echo Html::a('<img src="../img/campeonato.png" alt="'.Yii::t('app', "CAMPEONATOS") .'">
                                <h3>'.Yii::t('app', "CAMPEONATOS") .'</h3>',array("campeonato/torneos"));
                        ?>
                    </div>
<!--                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 red-bg">
              
                        <?php 
                            echo Html::a('<img src="../img/medal-1.png" alt="'.Yii::t('app', "PROGRAMACION") .'">
                                <h3>'.Yii::t('app', "PROGRAMACION") .'</h3>',array("programacion/index"));
                        ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 tw-bg">
                        <img src="../img/trophy.png" alt="REGISTRO DE RESULTADOS">
                        <h3><?= Yii::t('app', "REG_RESULTADOS") ?></h3>
                        <div class="demo-btn-group">
                            <button type="button" class="btn teal-bg btn-block" data-toggle="modal" data-target="#modalRegResul"><i class="icon-circle-plus icon-left"></i> Crear Resultados</button>
                        </div>			
                    </div>-->
                </div>

            </div>

        </div>
    </div>
    
    <?php } ?>
	
    
    <!-- FIN EDITAR usuario modal -->
    <script src="../views/evento/js/evento.js"></script>
    <script src="../views/escenario/js/escenario.js"></script>
	
    <!-- SCRIP PARA OCULTAR DIV-->
    <script languaje="Javascript">   
	document.write('<style type="text/css">div.cp_oculta{display: none;}</style>');  
	function MostrarOcultar(capa,enlace)  
	{  
		if (document.getElementById)  
		{  
			var aux = document.getElementById(capa).style;  
			aux.display = aux.display? "":"block";  
		}  
	}  
    </script>
	
	
</body>