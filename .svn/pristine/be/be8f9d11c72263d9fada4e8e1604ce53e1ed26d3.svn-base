<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use app\controllers\EscenarioController;
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<body class="background_images">

    <!-- Navegación -->
    <div class="container-fluid">
        <div class="dashboard-wrapper">
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
                                echo Html::a('<i class="icon-graphic_eq"></i>'. Yii::t("app", "INICIO") ,array("evento/index"));
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "CONJUNTO") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Barra Azul -->
            <div class="top-bar clearfix">
                
            </div>
            
            <div class="main-container panel-body icons">
                <div class="row gutter">
<!--                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 green-bg">
                        <?php 
                            echo Html::a('<img src="../img/torch.png" alt="EVENTOS">
                                <h3>'.Yii::t('app', "EVENTOS") .'</h3>
                                <div class="demo-btn-group">
                                    <button type="button" class="btn teal-bg btn-block"><i class="icon-circle-plus icon-left"></i>'.Yii::t('app', "LISTAR_EVENTOS").'</button>
                                </div>',array("evento/listar"));
                        ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 yellow-bg">
                        <?php 
                            echo Html::a('<img src="../img/flag.png" alt="ESCENARIOS">
                                <h3>'.Yii::t('app', "ESCENARIOS") .'</h3> 
                                <div class="demo-btn-group">
                                    <button type="button" class="btn teal-bg btn-block"><i class="icon-circle-plus icon-left"></i>'.Yii::t('app', "LISTAR_ESCENARIOS").'</button>
                                </div>',array("escenario/listar"));
                        ?>
                    </div>-->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 orange-bg">
                        <img src="../img/campeonato.png" alt="CAMPEONATOS">
                        <h3><?= Yii::t('app', "CAMPEONATOS") ?></h3>
                        <div class="demo-btn-group">
                            <button type="button" class="btn teal-bg btn-block" data-toggle="modal" data-target="#modalForm3"><i class="icon-circle-plus icon-left"></i> Crear Campeonato</button>
                        </div>			
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 red-bg">
                        <img src="../img/medal-1.png" alt="PROGRAMACION">
                        <h3><?= Yii::t('app', "PROGRAMACION") ?></h3>
                        <div class="demo-btn-group">
                            <button type="button" class="btn teal-bg btn-block" data-toggle="modal" data-target="#modalForm4"><i class="icon-circle-plus icon-left"></i> Crear Programación</button>
                        </div>			
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 block-195 tw-bg">
                        <img src="../img/trophy.png" alt="REGISTRO DE RESULTADOS">
                        <h3><?= Yii::t('app', "REG_RESULTADOS") ?></h3>
                        <div class="demo-btn-group">
                            <button type="button" class="btn teal-bg btn-block" data-toggle="modal" data-target="#modalRegResul"><i class="icon-circle-plus icon-left"></i> Crear Resultados</button>
                        </div>			
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    <!-- CREAR CAMPEONATO MODAL -->
    <div class="modal fade" id="modalForm3" tabindex="-1" role="dialog" aria-labelledby="modalForm3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">NUEVO CAMPEONATO</h4>
                </div>
                <div class="modal-body">
                    <form action="eventos_fin4.html" onsubmit="return confirm('Desea enviar formulario')">
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    <label class="control-label">Evento</label>
                                    <?php
                                        $items = ArrayHelper::map(\app\models\Evento::find()->all(),'eve_id','eve_nombre');
                                        echo Html::dropDownList('evento','eve_id',$items,['prompt'=>'Seleccione', 'class'=>'form-control']);
                                    ?>
                                    <!-- <select class="form-control" name="Evento">
                                        <option value="Region 1">Evento 1
                                        <option value="Region 2">Evento 2
                                    </select> -->

                                    <label class="control-label">Tipo</label>
                                    <select class="form-control" name="Tipo">
                                        <option value="Region 1">Tipo 1
                                        <option value="Region 2">Tipo 2
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Género</label>
                                    <select class="form-control" name="Género">
                                        <option value="Region 1">Género 1
                                        <option value="Region 2">Género 2
                                    </select>

                                    <label class="control-label">Categoría</label>
                                    <select class="form-control" name="Categoría">
                                        <option value="Region 1">Categoría 1
                                        <option value="Region 2">Categoría 2
                                    </select>
                                </div>
                            </div>
                            <div class="row gutter">
                                <div class="col-md-12">
                                    <label class="control-label">Deportes</label>								
                                </div>
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio1"> Deporte 1</label>
                                    <label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio2"> Deporte 2</label>
                                    <label class="radio-inline"><input type="radio" checked="checked" name="inlineRadioOptions" id="inlineRadio3"> Deporte 3</label>
                                    <label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio4"> Deporte 4</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="message-texta" class="control-label">Disponibilidad:</label>
                            <div class="panel-body">
                                <table class="table table-striped success no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="col-md-4 col-xs-4"><input type="checkbox" name="inlineRadioOptions" id="check1"></th>
                                            <th class="col-md-5 col-xs-5">ESCENARIOS</th>
                                            <th class="col-md-5 col-xs-5"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $escenarios = EscenarioController::listarEscenarios(0);
                                            $num = 1;
                                            foreach ($escenarios as $escenario) {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $num ?></th>
                                                    <td><input type="checkbox" name="inlineRadioOptions" id="esc<?php echo $escenario->esc_id ?>"></td>
                                                    <td><?php echo $escenario->esc_nombre ?></td>
                                                    <td>
                                                        <input id="urlBorrarEscenario" type="hidden" value="<?= Url::toRoute(['escenario/borrarescenario']) ?>">
                                                        <span class="b label label-success"><i class="icon-circle-plus"></i></span> <span class="b label label-warning"><i class="icon-edit"></i></span> <span id="bor<?php echo $escenario->esc_id?>" class="b label label-danger" onclick="eliminarEscenario(this.id)"><i class="icon-circle-with-cross"></i></span>
                                                    </td>
                                                </tr>
                                                <?php
                                                $num++;
                                            }
                                        ?>
                                        <!-- <tr>
                                            <th scope="row">1</th>
                                            <td><input type="checkbox" name="inlineRadioOptions" id="check1"></td>
                                            <td>ESCENARIOS 1</td>
                                            <td><span class="label label-success"><i class="icon-circle-plus"></i></span> 
                                                <span class="label label-warning"><i class="icon-edit"></i></span>
                                                <span class="label label-danger"><i class="icon-circle-with-cross"></i></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td><input type="checkbox" name="inlineRadioOptions" id="check1"></td>
                                            <td>ESCENARIOS 2</td>
                                            <td><span class="label label-success"><i class="icon-circle-plus"></i></span> 
                                                <span class="label label-warning"><i class="icon-edit"></i></span>
                                                <span class="label label-danger"><i class="icon-circle-with-cross"></i></span>
                                            </td>
                                        </tr> -->

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message-texta" class="control-label">Observaciones:</label>
                            <textarea class="form-control" id="message-texta"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> Cerrar</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal" onclick=" location.href = 'eventos_fin4.html'"><i class="icon-save icon-left"></i> Sistema de Campeonato</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
	
    <!-- CREAR ESCENARIO MODAL -->
    <div class="modal fade" id="modalRegResul" tabindex="-1" role="dialog" aria-labelledby="modalRegResul">
        <div class="modal-dialog" role="document" STYLE="width:1024px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">RESULTADOS</h4>
                </div>
                <div class="modal-body">
                    <form action="eventos_fin4.html" onsubmit="return confirm('Desea enviar formulario')">
                        <div class="form-group">
                            <label for="message-texta" class="control-label">Disponibilidad:</label>
                            <div class="panel-body">
                                <table class="table table-striped success no-margin">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1 col-xs-1">FECHA</th>
											<th class="col-md-1 col-xs-1">EQUIPO 1</th>
											<th class="col-md-1 col-xs-1">MARCADOR</th>
											<th class="col-md-1 col-xs-1">VS</th>
											<th class="col-md-1 col-xs-1">EQUIPO 2</th>
											<th class="col-md-1 col-xs-1">MARCADOR</th>
											<th class="col-md-1 col-xs-1">HORA</th>
											<th class="col-md-1 col-xs-1">FECHA</th>
											<th class="col-md-1 col-xs-1">ESCENARIOS</th>
                                            <th class="col-md-1 col-xs-1">OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>EQUIPO 1</td>
                                            <td>3</td>
											<td>VS</td>
											<td>EQUIPO 2</td>
                                            <td>2</td>
											<td>12:00</td>
                                            <td>31-12-2017</td>
											<td>CAMPIN</td>
                                            <td> 
                                                <span class="label label-warning"><i class="icon-edit"></i></span>
                                                <span class="label label-danger"><i class="icon-circle-with-cross"></i></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>EQUIPO 1</td>
                                            <td><a href="javascript:MostrarOcultar('marcadorequipo1');"><span class="label label-warning"><i class="icon-edit"></i></span></a></td>
											<td>VS</td>
											<td>EQUIPO 2</td>
                                            <td><a href="javascript:MostrarOcultar('marcadorequipo1');"><span class="label label-warning"><i class="icon-edit"></i></span></a></td>
											<td>12:00</td>
                                            <td>31-12-2017</td>
											<td>CAMPIN</td>
                                            <td> 
                                                <span class="label label-warning"><i class="icon-edit"></i></span>
                                                <span class="label label-danger"><i class="icon-circle-with-cross"></i></span>
                                            </td>
                                        </tr> 
										<tr>
                                            <th scope="row">2</th>
                                            <td>EQUIPO 1</td>
                                            <td><a href="javascript:MostrarOcultar('marcadorequipo1');"><span class="label label-warning"><i class="icon-edit"></i></span></a></td>
											<td>VS</td>
											<td>EQUIPO 2</td>
                                            <td><a href="javascript:MostrarOcultar('marcadorequipo1');"><span class="label label-warning"><i class="icon-edit"></i></span></a></td>
											<td>12:00</td>
                                            <td>31-12-2017</td>
											<td>CAMPIN</td>
                                            <td> 
                                                <span class="label label-warning"><i class="icon-edit"></i></span>
                                                <span class="label label-danger"><i class="icon-circle-with-cross"></i></span>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
							<div class="cp_oculta" id="marcadorequipo1">
								<!--  EMPIEZA EL  TAB DE CADA  MENU INTERNEO -->
									<div class="row gutter">
										<div class="panel panel-light">
											
											<table class="table table-striped success no-margin">
													<thead>
														<tr>
															<th>#</th>
															<th class="col-md-5 col-xs-5">JUGADORES</th>
															<th class="col-md-4 col-xs-4">GOLES</th>
															<th class="col-md-4 col-xs-4">FALTAS</th>
															<th class="col-md-4 col-xs-4">AUTOGOLES</th>
															<th class="col-md-4 col-xs-4">TIEMPOS/EXTRAS</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th scope="row">1</th>
															<td><select class="form-control"><option>Seleccione</option></select></td>
															<td><select class="form-control"><option>1</option></select></td>
															<td><a href="javascript:MostrarOcultar('faltas2');"><span class="label label-warning"><img src="../img/whistle.png" alt="Faltas"/></span></a></td>
															<td><select class="form-control"><option>1</option></select></td>
															<td>
																<select class="form-control">
																	<option>1 TIEMPO</option>
																	<option>2 TIEMPO</option>
																	<option>3 TIEMPO</option>
																	<option>4 TIEMPO</option>
																	<option>EXTRA TIEMPO</option>
																	<option>PENALTIES</option>
																	<option>MUERTE SUBITA</option>
																</select>
															</td>
														</tr>
														<tr>
															<th scope="row">2</th>
															<td><select class="form-control"><option>Seleccione</option></select></td>
															<td><select class="form-control"><option>1</option></select></td>
															<td><a href="javascript:MostrarOcultar('faltas2');"><span class="label label-warning"><img src="../img/whistle.png" alt="Faltas"/></span></a></td>
															<td><select class="form-control"><option>1</option></select></td>
															<td>
																<select class="form-control">
																	<option>1 TIEMPO</option>
																	<option>2 TIEMPO</option>
																	<option>3 TIEMPO</option>
																	<option>4 TIEMPO</option>
																	<option>EXTRA TIEMPO</option>
																	<option>PENALTIES</option>
																	<option>MUERTE SUBITA</option>
																</select>
															</td>
														</tr>
														<tr>
															<th scope="row">3</th>
															<td><select class="form-control"><option>Seleccione</option></select></td>
															<td><select class="form-control"><option>1</option></select></td>
															<td><a href="javascript:MostrarOcultar('faltas2');"><span class="label label-warning"><img src="../img/whistle.png" alt="Faltas"/></span></a></td>
															<td><select class="form-control"><option>1</option></select></td>
															<td>
																<select class="form-control">
																	<option>1 TIEMPO</option>
																	<option>2 TIEMPO</option>
																	<option>3 TIEMPO</option>
																	<option>4 TIEMPO</option>
																	<option>EXTRA TIEMPO</option>
																	<option>PENALTIES</option>
																	<option>MUERTE SUBITA</option>
																</select>
															</td>
														</tr>
													</tbody>
												</table>
										</div>
									</div>
								<!--  FIN  DEL  TAB DE CADA  MENU INTERNEO -->
							</div>	
							<div class="cp_oculta" id="faltas2">
								<div class="row gutter">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="panel panel-light">
											<FORM>
												<div class="panel-body">
													<h2>FALTAS Y SANCIONES</h2>
													<H1 for="message-texta" class="control-label">JUAN PEREZ:</H1>
													<table class="table table-striped success no-margin">
														<thead>
															<tr>
																<th>#</th>
																<th class="col-md-5 col-xs-5">AMONESTACIÓN</th>
																<th class="col-md-4 col-xs-4">MINUTO</th>
																<th class="col-md-4 col-xs-4">CANTIDAD</th>
																<th class="col-md-4 col-xs-4">OBSERVACIÓN</th>
																<th class="col-md-4 col-xs-4">OPCIONES</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<th scope="row">1</th>
																<td><select class="form-control"><option>Seleccione</option></select></td>
																<td><input type="text"/></td>
																<td><select class="form-control"><option>1</option></select></td>
																<td><select class="form-control"><option>1</option></select></td>
																<td><span class="label label-warning"><i class="icon-edit"></i></span><span class="label label-danger"><i class="icon-circle-with-cross"></i></span></td>
															</tr>
															<tr>
																<th scope="row">1</th>
																<td><select class="form-control"><option>Seleccione</option></select></td>
																<td><input type="text"/></td>
																<td><select class="form-control"><option>1</option></select></td>
																<td><select class="form-control"><option>1</option></select></td>
																<td><span class="label label-warning"><i class="icon-edit"></i></span><span class="label label-danger"><i class="icon-circle-with-cross"></i></span></td>
															</tr>
															<tr>
																<th scope="row">1</th>
																<td><select class="form-control"><option>Seleccione</option></select></td>
																<td><input type="text"/></td>
																<td><select class="form-control"><option>1</option></select></td>
																<td><select class="form-control"><option>1</option></select></td>
																<td><span class="label label-warning"><i class="icon-edit"></i></span><span class="label label-danger"><i class="icon-circle-with-cross"></i></span></td>
															</tr>
														</tbody>
													</table>
												</div>
												<button type="button" class="btn btn-success"><i class="icon-save icon-left"></i> Guardar</button>
											</FORM>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> Cerrar</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal" onclick=" location.href = 'eventos_fin4.html'"><i class="icon-save icon-left"></i> Guardar Resultados</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
	
    
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