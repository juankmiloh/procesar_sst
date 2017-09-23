<?php
    use yii\helpers\Html;
?>


<body class="background_images">

    <div class="container-fluid">

        <div class="dashboard-wrapper">
            
            <!-- MIGA DE PAN -->
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">
                            Toggle navigation</span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "INICIO"), array("evento/index"));
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "CAMPEONATO") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Barra Azul -->
            <div class="top-bar clearfix">
            </div>


        <div class="main-container panel-body icons">
	
	
	
	
	<!-- EMPIEZA EL MENU EN TREE --> 
	<div class="left-sidebar">
		
		
		<div class="row gutter">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-light">
					<div class="panel-heading">
						<h4><?php Yii::t("app", "CAMPEONATO") ?></h4>
					</div>

<!--					<div class="panel-body">
						<form class="form-horizontal" action="eventos_fin2-sub2.html" method="post">
							<div class="form-group row gutter">
								<label for="inputEmail3" class="col-sm-2 control-label">Evento</label>
								<div class="col-sm-8">
									<select class="form-control" name="Region">
										<option value="Region 1" onselect=" location.href='eventos_fin2-sub2.html'">Evento Regional 1</option>
										<option value="Region 2" onselect=" location.href='eventos_fin2-sub2.html'">Evento Regional 2</option>
										<option value="Region 3" onselect=" location.href='eventos_fin2-sub2.html'">Evento Regional 3</option>
										<option value="Region 4" onselect=" location.href='eventos_fin2-sub2.html'">Evento Regional 4</option>
									</select>
								</div>
								<div class="col-sm-1">
									<button type="button" class="btn btn-info" data-dismiss="modal" onclick=" location.href='eventos_fin2-sub2.html'"><i class="icon-save icon-left"></i> CARGAR TORNEO</button>
								</div>
							</div>
						</form>
					</div>-->
					
					<div class="panel-body">
						<div class="baguetteBoxThree gallery">
							<ul>
                                                            <?php for($i = 0; $i < count($deportes); $i++) { 
                                                            		if ($deportes[$i]->dep_id == ID_ATLETISMO) {
                                                            			$ruta = "atletismo/listar";			
                                                            		}else{
                                                            			$ruta = "campeonato/listar";
                                                            		}
                                                                    echo "<li>";
                                                                            echo Html::a('<img src="../img/torneos/'.$deportes[$i]->dep_imagen.'" class="img-responsive" alt="TORNEOS"> '
                                                                                    . '<i class="ion-ios-search"></i><div class="ftr">'.$deportes[$i]->dep_nombre.'</div>', [$ruta, 'idDeporte' => $deportes[$i]->dep_id]);
                                                                    echo "</li>";

                                                                }
                                                             ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- FIN EL MENU EN TREE -->
	
	
	


</div>
	<!-- FIN EL MENU EN TREE -->
      </div>
    </div>
</body>
    