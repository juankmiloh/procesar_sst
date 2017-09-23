<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
?>
<body class="background_images" ondragstart="return false">
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
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "ESCENARIOS"));
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Barra Azul -->
            <div class="top-bar clearfix"></div>
            <!-- Botón CREAR -->
            <div class="container-fluid">
                <div class="row gutter">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <h3 class="page-title"><?php echo Yii::t('app', "SISTEMA_COMPETENCIA"); ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanEscenario()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i> <?php echo Yii::t('app',"CREAR_ESCENARIO")?></button>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Listado -->
            <input type="hidden" id="urlCambiarEstadoEscenario" value="<?php echo Url::toRoute(['escenario/cambiarestadoescenario']) ?>">
            <table id="list-escenario" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "ESCENARIOS"); ?></th>
                        <th><?php echo Yii::t("app", "DIRECCION"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
                        <th><?php echo Yii::t("app", "CONTACTO"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "ESCENARIOS"); ?></th>
                        <th><?php echo Yii::t("app", "DIRECCION"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
                        <th></th>                        
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "ESCENARIOS"); ?></th>
                        <th><?php echo Yii::t("app", "DIRECCION"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
                        <th><?php echo Yii::t("app", "CONTACTO"); ?></th>                        
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>                                    
                </tbody>
            </table>            
        </div>
    </div>
    <!-- CREAR ESCENARIO MODAL -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo Yii::t('app',"NUEVO_ESCENARIO")?></h4>
                </div>
                <div class="modal-body">
                	<p id="msnNuevoEscenario"></p>
                    <p id="msnValidacionEmailemail"></p>
                    <form id="form-add-escenario">
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-12">
                                	<div class="col-md-6 col-xs-12">
                                		<label class="control-label"><?php echo Yii::t('app',"NOMBRE")?></label>
                                    	<input type="url" class="form-control" id="esc_nombre" name="esc_nombre" maxlength="254">
                                	</div>
                                	<div class="col-md-6 col-xs-12">
                                		<input id="urlMostrarCiudad" type="hidden" value="<?= Url::toRoute(['escenario/listarciudades']); ?>">
                                		<label class="control-label"><?= Yii::t('app',"DEPARTAMENTO") ?></label>
	                                    <?php	                                    	
	                                    	echo Html::dropDownList('departamento', 'dptos_id', $departamentos, ['prompt'=>Yii::t('app',"SELECCIONE"),'class'=>'form-control', 'onchange'=>'mostrarCiudad(this.value, 1);','id'=>'depa']);
	                                    ?>
                                	</div>	
                                </div>
                                <div class="col-md-12"> 
                                	<div class="col-md-6 col-xs-12">
                                		<label class="control-label"><?= Yii::t('app',"CIUDAD") ?></label>
                                    	<div class="ciudad"></div>   
                                	</div>
                                	<div class="col-md-6 col-xs-12">
                                		<label class="control-label"><?php echo Yii::t('app',"DIRECCION")?></label>
                                    	<input type="url" class="form-control" id="esc_direccion" name="esc_direccion" maxlength="54">
                                	</div>                                     
                                </div>
                            </div>
                            <div class="row gutter">                                
                                <div class="col-md-12">                                	
                                    <div class="checkbox deportes col-md-6 col-xs-12"> 
                                    	<label class="control-label"><?= Yii::t('app',"DEPORTES") ?></label>
                                        <?php                                        	
                                        	echo Html::dropDownList('dep_id', 'dep_id', $deportesActivos,['class'=>"selectpicker", 'multiple'=>'multiple','title'=>Yii::t('app',"SELECCIONE"),'id'=>'deport']);
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="control-label"><?php echo Yii::t('app',"FOTO_ESCENARIO")?></label><label style="color:gray;">&nbsp;<?php echo "- (".Yii::t('app',"MAX_SIZE")." ".MAX_SIZE_PHOTO_SCENARIO.")" ?></label>
                                        <input type="file" id="foto-escenario" name="foto-escenario" class="form-control">
                                    </div>
                                </div>                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                    	<label id="msnContacto" style="color:red;font-weight: bold;"></label><br>
                                        <label class="control-label"><?php echo Yii::t('app',"CONTACTO")?></label>
                                        <div class="row gutter">
                                            <div class="col-md-4">
                                                <label class="control-label"><?php echo Yii::t('app',"NOMBRE")?></label>
                                                <input type="text" class="form-control" id="ce_nombre" name="ce_nombre" maxlength="54" onfocus="$('#msnContacto').text(ADVERTENCIA_CONTACTO)" onblur="$('#msnContacto').text('')">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label"><?php echo Yii::t('app',"APELLIDOS")?></label>
                                                <input type="text" class="form-control" id="ce_apellidos" name="ce_apellidos" maxlength="54">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label"><?php echo Yii::t('app',"TELEFONO")?></label>
                                                <input type="text" class="form-control" id="ce_telefono" name="ce_telefono" maxlength="12" onkeypress="return validarNumero(event);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gutter">
                                        <div class="col-md-6">
                                            <label class="control-label"><?php echo Yii::t('app',"CELULAR")?></label>
                                            <input type="text" class="form-control" id="ce_celular" name="ce_celular" maxlength="12" onkeypress="return validarNumero(event);">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label"><?php echo Yii::t('app',"EMAIL")?></label>
                                            <input type="email" class="form-control" id="email" name="ce_email" onchange="validarEmail(this.id,'msnContacto');" maxlength="54">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-texta" class="control-label"><?php echo Yii::t('app',"OBSERVACIONES")?>:</label>
                            <textarea class="form-control" id="message-texta" name="esc_observaciones" maxlength="254"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-texta" class="control-label"><?php echo Yii::t('app',"DISPONIBILIDAD")?>:</label>
                            <div class="panel-body">
                            <p id="msnFechasValidar1"></p>
                                <table class="table table-striped success no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="col-md-5 col-xs-5"><?php echo Yii::t("app", "FECHA_INICIO"); ?></th>
                                            <th class="col-md-5 col-xs-5"><?php echo Yii::t("app", "FECHA_FINAL"); ?></th>
                                            <th class="col-md-4 col-xs-4"><?php echo Yii::t("app", "HORARIO"); ?></th>
                                            <th class="col-md-5 col-xs-5"><?php echo Yii::t("app", "OPCIONES"); ?></th>
                                        </tr>
                                    </thead>                                    
                                    <input id="urlBorrarDisp" type="hidden" value="<?= Url::toRoute(['escenario/borrardisponibilidad']);?>">
                                    <input id="urlModifDisp" type="hidden" value="<?= Url::toRoute(['escenario/modificardisponibilidad']); ?>">
                                    <tbody class="cuerpo-dis">
                                    	<?php \app\controllers\EscenarioController::limpiarDisponibilidad();?>
                                    </tbody>
                                </table>
                                <table class="table success no-margin"> 
                                	<tr>
                                        <th scope="row"></th>
                                        <td>
                                        	<div class="input-group">
                                        		<input type="text" id="fecha-ini" class="form-control fecha" placeholder="<?php echo Yii::t('app',"ANIO_MES_DIA") ?>" readonly onchange="activarFechaFin();"> 
                                        		<span class="input-group-addon">
                                        			<span class="icon-calendar"></span>
                                        		</span>
                                        	</div>
                                        </td>
                                        <td>
                                        	<div class="input-group">
                                        		<input type="text" id="fecha-fin" class="form-control fecha" placeholder="<?php echo Yii::t('app',"ANIO_MES_DIA") ?>" readonly> 
                                        		<span class="input-group-addon">
                                        			<span class="icon-calendar"></span>
                                        		</span>
                                        	</div>
                                        </td>
                                        <td>                                        	
                                    		<select id="horas" class="selector selectpicker" multiple title="<?php echo Yii::t('app',"SELECCIONE")?>" >
                                    		<?php
                                    		foreach ($horas as $hora) {
                                    			?>
                                    			<option id="hor<?php echo $hora->hor_id ?>" value="<?php echo $hora->hor_id ?>"><?php echo $hora->hor_nombre_12_horas ?></option>
                                    			<?php
                                    		}                                        		
                                	        ?>
                                    		</select>	
                                        </td>
                                        <td>
                                            <input id="urlNuevaDisponibilidad" type="hidden" value="<?= Url::toRoute(['escenario/agregardisponibilidad'])?>">
                                            <span class="btn btn-success btn-xs" onclick="agregarFecha(0)">
                                        	   <span class="icon-add" ></span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>                        
                        <div class="modal-footer">
                        	<p id="msnNuevoEscenario1"></p>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?php echo Yii::t('app',"CERRAR"); ?></button>
                            <input id="urlNuevoEscenario" type="hidden" value="<?= Url::toRoute(['escenario/crearescenario'])?>">
                            <button type="button" class="btn btn-info" onclick="guardarEscenario();"><i class="icon-save icon-left"></i> <?php echo Yii::t('app',"GUARDAR")?></button>
                            <!-- data-dismiss="modal" -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN CREAR ESCENARIO MODAL -->

    <!-- MODAL VER/EDITAR ESCENARIO -->    
    <input type="hidden" id="urlModalEditar" value="<?php echo Url::toRoute(['escenario/modalescenario']); ?>">
    <div class="modal fade" id="modalVerEscenario" tabindex="-1" role="dialog" aria-labelledby="modalVerEscenario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo Yii::t('app',"ESCENARIO_EDITAR")?></h4>
                </div>
                <div class="modal-body" id="modal-editar">
	                <div class='panel'>                    
	                    <div class='panel-body'>
	                        <div class=row gutter'>
	                            <form id='form_escenario'>
	                            	<input type="hidden" id="idEscenario">
	                                <input type='hidden' id='urlModificarEscenario' value='<?php echo Url::toRoute(['escenario/modificarescenario'])?>'>
	                                <input type='hidden' id='urlNuevoContacto' value='<?php echo Url::toRoute(['escenario/agregarcontacto'])?>'>
	                                <p id='msnModifEscenario'></p>
	                                <div class='col-xs-12 col-md-5'>
	                                    <textarea id='nombre_esc' type='text' class='form-control' name='nombre_esc'></textarea>
	                                </div>
                                    <input type="hidden" id="urlModificarFoto" value="<?php echo Url::toRoute(['escenario/modificarfoto'])?>">
                                    <div class="col-xs-12 col-md-7">
                                        <div id="foto" class="col-md-3 col-xs-12">
                                            
                                        </div>
                                        <div class="col-md-9 col-xs-12">                                            
                                                <input id='nueva-foto'  type='file' name='file'><label style="color:gray;"><?php echo "(".Yii::t('app',"MAX_SIZE")." ".MAX_SIZE_PHOTO_SCENARIO.")" ?></label><br><span class='btn btn-success btn-xs' onclick='modificarFoto($("#idEscenario").val())'><span class='icon-check'></span></span> 
                                        </div>                                        
                                    </div>
	                                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	                                    <div class='panel'>
	                                        <div class='panel-body'>
	                                            <table class='table table-striped'>
	                                                <tbody>
	                                                    <tr>
	                                                        <td colspan='3'>
                                                                <a class='collapsed' role='button' data-toggle='collapse' data-parent='#leftSidebar' href='#collapseOne' aria-expanded='true' aria-controls='collapse'>
	                                                                <div class='azul panel-heading' role='tab' id='headingOne'>
    	                                                                <h3 class='panel-title'>
    	                                                                    <i class='icon-room'></i><?php echo Yii::t('app',"DIRECCION")?><span class="label label-info" style="float: right;"><i class="icon-chevron-down"></i></span>
    	                                                                </h3>
                                                                    </div>
                                                                </a>
	                                                            <div id='collapseOne' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'>
	                                                                <span><input id='direccion_esc' type='text' class='form-control' name='direccion_esc'></span>                                     
	                                                            </div>
                                                                <a class='collapsed' role='button' data-toggle='collapse' data-parent='#leftSidebar' href='#collapseTwo' aria-expanded='true' aria-controls='collapse'>
    	                                                            <div class='azul panel-heading' role='tab' id='headingTwo'>
    	                                                                <h3 class='panel-title'>
    	                                                                    <i class='icon-person'></i><?php echo Yii::t('app',"CONTACTO")?><span class="label label-info" style="float: right;"><i class="icon-chevron-down"></i></span>
    	                                                                </h3>
    	                                                            </div>
                                                                </a>
	                                                            <div id='collapseTwo' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingTwo'>
	                                                            	<p id='msnNuevoContacto'></p>
	                                                                <input id='verificador' type='hidden' name='verificador'>
	                                                                <input type='hidden' id="id_contact" name='id_contact'>
	                                                                <div class ='row'>
	                                                                    <div class='col-xs-4'>
	                                                                        <input id='nombre_ce' type='text' class='form-control' name='nombre_ce' maxlength='54' placeholder="<?php echo Yii::t('app',"NOMBRE")?>">
	                                                                    </div>
	                                                                    <div class='col-xs-4'>
	                                                                        <input id='apellidos_ce' type='text' class='form-control' name='apellidos_ce' maxlength='54' placeholder="<?php echo Yii::t('app',"APELLIDOS")?>">
	                                                                    </div>
	                                                                    <div class='col-xs-4'>
	                                                                        <input id='telefono_ce' type='text' class='form-control' name='telefono_ce' maxlength='12' onkeypress='return validarNumero(event);' placeholder="<?php echo Yii::t('app',"TELEFONO")?>">
	                                                                    </div>
	                                                                </div><br>
	                                                                <div class ='row'>
	                                                                    <div class='col-xs-4'>
	                                                                        <input id='celular_ce' type='text' class='form-control' name='celular_ce' maxlength='12' onkeypress='return validarNumero(event);' placeholder="<?php echo Yii::t('app',"CELULAR")?>">
	                                                                    </div>
	                                                                    <div class='col-xs-4'>
	                                                                        <input type='text' id='mmail' class='form-control' name='email_ce' onchange='validarEmail(this.id,"msnNuevoContacto");' placeholder="<?php echo Yii::t('app',"EMAIL")?>">
	                                                                    </div>
	                                                                    <div class='col-xs-4' id="div-add-contact">
										                                    <center>
										                                    	<span class="btn btn-success btn-xs" onclick='agregarContacto($("#idEscenario").val());'>
										                                    		<span class='icon-check'></span>
										                                    	</span>                                 
										                                    </center>
										                                </div>
	                                                                </div>                                                                 
	                                                            </div>
                                                                <a class='collapsed' role='button' data-toggle='collapse' data-parent='#leftSidebar' href='#collapseThree' aria-expanded='true' aria-controls='collapse'>
    	                                                            <div class='azul panel-heading' role='tab' id='headingThree'>
    	                                                                <h3 class='panel-title'>
    	                                                                    <i class='icon-paper'></i><?php echo Yii::t('app',"OBSERVACIONES")?><span class="label label-info" style="float: right;"><i class="icon-chevron-down"></i></span>
    	                                                                </h3>
    	                                                            </div>
                                                                    <!--  -->
                                                                </a>
	                                                            <div id='collapseThree' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree'>
	                                                                <label>
	                                                                    <textarea cols="50" rows="3" id='observaciones_esc' class='form-control' name='observaciones_esc' maxlength="254"></textarea>
	                                                                </label>
	                                                            </div>
	                                                        </td>
	                                                    </tr>
	                                                </tbody>
	                                            </table>  
	                                            <button id="btn-save" class='btn btn-info' onclick='editarEscenario($("#idEscenario").val());'><i class='icon-save'></i></button>
	                                        </div>                                                        
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                    <div class='panel-body'>
	                        <div class='tabbable tabs-left clearfix'>
	                            <ul class='nav nav-tabs'>
	                                <li class='active'><a href='#tabOne' data-toggle='tab' aria-expanded='false'><?php echo Yii::t('app',"DEPORTES")?></a></li>
	                                <li class=''><a href='#tabTwo' data-toggle='tab' aria-expanded='false'><?php echo Yii::t('app',"DISPONIBILIDAD")?></a></li>
	                                <li class=''><a href='#tabThree' data-toggle='tab' aria-expanded='false'><?php echo Yii::t('app',"LOCACION")?></a></li>                                               
	                                <!-- <li class=''><a href='#tabFour' data-toggle='tab' aria-expanded='false'><?php //echo Yii::t('app',"ENCUENTROS")?></a></li> -->
	                            </ul>
	                            <div class='tab-content'>                                                
	                                <div class='tab-pane  fade in active' id='tabOne'>
	                                    <p id='msnDeportesEditar'></p>
	                                    <table class='table table-striped'>
	                                        <input type='hidden' id='urlBorrarDeporteEsc' value='<?php echo Url::toRoute(['escenario/borrardeporteescenario']) ?>'>
	                                        <input type='hidden' id='urlAgregarDeporteEscenario' value='<?php echo Url::toRoute(['escenario/agregardeporteescenario'])?>'>
	                                        <tbody id="deporte-escenario">                                            
	                                        </tbody>                                        
	                                    </table>
	                                    <?php 	    									           
	                                  		echo Html::dropDownList('deporte', 'dep_id', $deportesActivos, ['prompt'=>Yii::t('app',"AGREGAR_DEPORTE"),'class'=>'form-control', 'onchange'=>'agregarDeporteEscenario(this.value,$("#idEscenario").val());', 'id'=>'select-depor']);
	                                  	?>
	                                </div>
	                                <div class='tab-pane' id='tabTwo'>
	                                	<p id='msnFechasValidar'></p>
	                                    <table class='table table-striped'>
	                                        <thead>
	                                            <th>#</th>
	                                            <th><?php echo Yii::t('app',"FECHA_INICIO")?></th>
	                                            <th><?php echo Yii::t('app',"FECHA_FIN")?></th>
	                                            <th><?php echo Yii::t('app',"HORARIO")?></th>
	                                            <th></th>
	                                        </thead>
	                                        <tbody class='cuerpo-diss'></tbody>
	                                    </table>
	                                    <table class='table success no-margin'> 
	                                        <tr>
	                                            <th scope='row'></th>
	                                            <td>
	                                                <div class='input-group'>
	                                                    <input type='text' id='fecha-inic' class='form-control fecha' placeholder='<?php echo Yii::t("app","ANIO_MES_DIA")?>' readonly onchange='activarFechaFin();'>
	                                                    <span class='input-group-addon'>
	                                                        <span class='icon-calendar'></span>
	                                                    </span>
	                                                </div>
	                                            </td>
	                                            <td>
	                                                <div class='input-group'>
	                                                	<input id="urlValidarFechas" type="hidden" value="<?php echo Url::toRoute(['escenario/validarfechadisp']); ?>">
	                                                    <input type='text' id='fecha-fina' class='form-control fecha' placeholder='<?php echo Yii::t("app","ANIO_MES_DIA")?>' readonly> 
	                                                    <span class='input-group-addon'>
	                                                        <span class='icon-calendar'></span>
	                                                    </span>
	                                                </div>
	                                            </td>
	                                            <td>	                                            	
	                                                <select id='horario' class='selector selectpicker' multiple title='<?php echo Yii::t('app',"SELECCIONE")?>'>                   
	                                                <?php             
	                                                	$ho ="";                                                                                
	                                                	for ($i=1; $i <= HORAS; $i++) {
	                                                		if($i<HORAS/2){$ho=$i."am";}else if($i==HORAS){$ho=($i-HORAS/2)."am";}else{if($i==HORAS/2){$ho=$i."pm";}else{$ho=($i-HORAS/2)."pm";}}
	                                                		echo "<option id='ho$i' value='$i'>$ho</option>";		
	                                                	}
	                                                ?>                                            		
	                                         		</select>   		                                         	
	                                            </td>
	                                            <td>                                                
	                                                <span id="add_disp" class='btn btn-success btn-xs' onclick='agregarFecha($("#idEscenario").val())'><span class="icon-add"></span></span>
	                                            </td>
	                                        </tr>
	                                    </table>                                
	                                </div>
	                                <div class='tab-pane' id='tabThree'>
	                                	<p id='msnLocacionEditar'></p>
	                                    <table class='table table-striped'>
	                                        <tr>
	                                            <td>
	                                            	<div class='row gutter'>
	                                                    <div>
	                                                        <strong><?php echo Yii::t('app','CIUDAD')?>: </strong><label id="ciud"></label> 
	                                                    </div>
	                                                    <div>
	                                                        <strong><?php echo Yii::t('app','DEPARTAMENTO')?>: </strong><label id="depto"></label> 
	                                                    </div>
	                                                </div>                                                      
	            	                            </td>
	            	                            <td>
	                                                <input type='hidden' id='urlModificarLocacion' value='<?php echo Url::toRoute(['escenario/cambiarciudadescenario'])?>'>
	                                                <span id='btn-loc' class='btn btn-success btn-xs' onclick='cambiarLocacion($("#idEscenario").val());'>
	                                                    <span class='icon-cached'></span>
	                                                </span>
	                                            </td>
	                                            <td>
	            									<?php 	            									         
	                                          		echo Html::dropDownList('departamento', 'dptos_id', $departamentos, ['prompt'=>Yii::t('app',"DEPARTAMENTO"),'class'=>'form-control', 'onchange'=>'mostrarCiudad(this.value, 2);','id'=>'depar']);
	                                          		?>
	                                            	<div class='city'></div>                            
	                                            </td>
	                                        </tr>
	                                    </table>
	                                </div>
	                                <!-- <div class='tab-pane' id='tabFour'>
	                                </div> -->
	                            </div>
	                        </div>
	                    </div>
	                </div>                
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL VER/EDITAR ESCENARIO -->
</body>
<style>
	.b{cursor: pointer;}
</style> 
<script type="text/javascript">
	var MAX_NOMBRE_ESCENARIO = '<?php echo Yii::t('app','MAX_NOMBRE_ESCENARIO') ?>';
	var MIN_NOMBRE_ESCENARIO = '<?php echo Yii::t('app','MIN_NOMBRE_ESCENARIO') ?>';
	var DEPARTAMENTO_ESCENARIO = '<?php echo Yii::t('app','DEPARTAMENTO_ESCENARIO') ?>';
	var CIUDAD_ESCENARIO = '<?php echo Yii::t('app','CIUDAD_ESCENARIO') ?>';
	var DIRECCION_ESCENARIO = '<?php echo Yii::t('app','DIRECCION_ESCENARIO') ?>';
	var TIPO_DEPORTE_ESCENARIO = '<?php echo Yii::t('app','TIPO_DEPORTE_ESCENARIO') ?>';
	var DEPORTES_ESCENARIO = '<?php echo Yii::t('app','DEPORTES_ESCENARIO') ?>';
	var DISPONIBILIDAD_ESCENARIO = '<?php echo Yii::t('app','DISPONIBILIDAD_ESCENARIO') ?>';
	var ESCENARIO_EXITO = '<?php echo Yii::t('app','ESCENARIO_EXITO') ?>';
	var EMAIL_VALIDACION = '<?php echo Yii::t('app','EMAIL_VALIDACION') ?>';
	var ADVERTENCIA_CONTACTO = '<?php echo Yii::t('app','ADVERTENCIA_CONTACTO') ?>';
	var CONTACTO_ESCENARIO_EXITO = '<?php echo Yii::t('app','CONTACTO_ESCENARIO_EXITO') ?>';
	var ESCENARIO_EXITO_EDICION = '<?php echo Yii::t('app','ESCENARIO_EXITO_EDICION') ?>';
    var DEPORTE_ESCENARIO_BORRAR = '<?php echo Yii::t('app','DEPORTE_ESCENARIO_BORRAR') ?>';
    var DEPORTE_ESCENARIO_AGREGAR = '<?php echo Yii::t('app','DEPORTE_ESCENARIO_AGREGAR') ?>';
    var DEPORTE_ESCENARIO_BORRAR_ERROR = '<?php echo Yii::t('app','DEPORTE_ESCENARIO_BORRAR_ERROR') ?>';
    var DEPORTE_ESCENARIO_AGREGAR_ERROR = '<?php echo Yii::t('app','DEPORTE_ESCENARIO_AGREGAR_ERROR') ?>';
    var LOCACION_EDITAR = '<?php echo Yii::t('app','LOCACION_EDITAR') ?>';
    var LOCACION_EDITAR_ERROR = '<?php echo Yii::t('app','LOCACION_EDITAR_ERROR') ?>';
    var FECHA_INICIAL_FECHA_FINAL_VALIDACION = '<?php echo Yii::t('app','FECHA_INICIAL_FECHA_FINAL_VALIDACION') ?>';
    var HORARIO_NO_SELECCIONADO = '<?php echo Yii::t('app','HORARIO_NO_SELECCIONADO') ?>';
    var FECHA_INICIO_DISPONIBILIDAD = '<?php echo Yii::t('app','FECHA_INICIO_DISPONIBILIDAD') ?>';
    var FECHA_FIN_DISPONIBILIDAD = '<?php echo Yii::t('app','FECHA_FIN_DISPONIBILIDAD') ?>';
    var PROCESANDO = '<?php echo Yii::t('app','PROCESANDO') ?>';
    var CONTACTO_ESCENARIO_ERROR = '<?php echo Yii::t('app','CONTACTO_ESCENARIO_ERROR') ?>';    
    var GENERANDO = '<?php echo Yii::t('app','GENERANDO') ?>';
    var ERROR = '<?php echo Yii::t('app','ERROR') ?>';
    var ACTUALIZANDO = '<?php echo Yii::t('app','ACTUALIZANDO') ?>';
    var CARGANDO = '<?php echo Yii::t('app','CARGANDO') ?>';
    var ESCENARIO_EDITAR = '<?php echo Yii::t('app','ESCENARIO_EDITAR') ?>';
    var MIN_NOMBRE_CONTACTO = '<?php echo Yii::t('app','MIN_NOMBRE_CONTACTO') ?>';
    var MIN_APELLIDO_CONTACTO = '<?php echo Yii::t('app','MIN_APELLIDO_CONTACTO') ?>';
    var MIN_TELEFONO_CONTACTO = '<?php echo Yii::t('app','MIN_TELEFONO_CONTACTO') ?>';
    var MIN_CELULAR_CONTACTO = '<?php echo Yii::t('app','MIN_CELULAR_CONTACTO') ?>';
    var EMAIL_NO_VACIO = '<?php echo Yii::t('app','EMAIL_NO_VACIO') ?>';
    var AGREGAR_DEPORTE =  '<?php echo Yii::t('app','AGREGAR_DEPORTE') ?>';
    var SELECCIONE = '<?php echo Yii::t('app',"SELECCIONE")?>';
    var CIUDAD = '<?php echo Yii::t('app',"CIUDAD")?>';
    var DISPONIBILIDAD_HORA_CRUZADA = '<?php echo Yii::t('app',"DISPONIBILIDAD_HORA_CRUZADA")?>';
    var TODO = '<?php echo Yii::t('app',"TODO")?>';
    var ESTADO_ACTIVO = '<?php echo ESTADO_ACTIVO;?>';
    var ESTADO_INACTIVO = '<?php echo ESTADO_INACTIVO;?>';
    var ACTIVO = '<?php echo Yii::t('app', "ACTIVO")?>';
    var INACTIVO = '<?php echo Yii::t('app', "INACTIVO")?>';
    var ARCHIVO_IMG = '<?php echo Yii::t('app', "ARCHIVO_IMG")?>';
    var CLICK_VER_IMAGEN = '<?php echo Yii::t('app', "CLICK_VER_IMAGEN")?>';
    var MAX_SIZE_PHOTO_SCENARIO = '<?php echo MAX_SIZE_PHOTO_SCENARIO; ?>';
    var MAX_SIZE = '<?php echo Yii::t('app', "MAX_SIZE")?>';
    var ESCENARIO_EXITO_NO_IMG = '<?php echo Yii::t('app', "ESCENARIO_EXITO_NO_IMG")?>';

</script>
<script src="../views/escenario/js/escenario.js"></script>
<script>
	$(document).ready(function(){
		var table = $("#list-escenario").DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['escenario/escenarios']); ?>",
            "language": {
                "lengthMenu": "<?php echo Yii::t("app", "DISPLAY_RESULT") ?>",
                "zeroRecords": "<?php echo Yii::t("app", "NO_RESULT") ?>",
                "info": "<?php echo Yii::t("app", "RES_PAG") ?>",
                "infoEmpty": "<?php echo Yii::t("app", "NO_RESULT_SEARCH") ?>",
                "infoFiltered": "<?php echo Yii::t("app", "FILTER_RESULT") ?>",
                "loadingRecords": "<?php echo Yii::t("app", "CARGANDO") ?>",
                "processing":     "<?php echo Yii::t("app", "PROCESANDO") ?>.",
                "search":         "<?php echo Yii::t("app", "BUSCAR") ?>",
                "zeroRecords":    "<?php echo Yii::t("app", "NO_RESULT_SEARCH") ?>",
                "paginate": {
                    "first":      "<?php echo Yii::t("app", "PRIMERO") ?>",
                    "last":       "<?php echo Yii::t("app", "ULTIMO") ?>",
                    "next":       "<?php echo Yii::t("app", "SIGUIENTE") ?>",
                    "previous":   "<?php echo Yii::t("app", "ANTERIOR") ?>"
                },
            }
        });

       	//Fecha inicial (Crear evento)
        $("#fecha-ini").datepicker({
            format:'yyyy-mm-dd',
                autoclose: true,
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#fecha-fin').datepicker('setStartDate', minDate);
        });

        //Fecha final (Crear evento)
        $("#fecha-fin").datepicker({
            format:'yyyy-mm-dd',
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                startDate: $("#fecha-ini").datepicker("getDate"),
        }).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#fecha-ini').datepicker('setEndDate', maxDate);
        });
        $("#fecha-fin").prop( "disabled", true );

        //Contador de columnas
        $.fn.columnCount = function() {  
            return $('th', $(this).find('tfoot')).length;  
        };

        // Filtros por columnas
        var column = 0;
        $('#list-escenario thead tr:eq(1) th').each( function () {
            
            //No agregue filtro para el registro ID
            if(column > 0 && column < ($('#list-escenario').columnCount() - 1)){                
                if(column == 1 || column == 2){//Construye una lista 
                    $(this).html("<input type='text' class='form-control filter'>")
                }else if(column == 3){//Construye una lista 
                    <?php
                        $html = Html::dropDownList('municipios_id2', 'municipios_id2', $municipios, ['prompt' => Yii::t('app', "TODO"), 'class' => 'form-control filter', 'id' => 'municipios_id2', 'name' => 'municipios_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>
                    $(this).html( '<?php echo $html; ?>' );
                    $('#municipios_id2').select2();
                }else if(column == 5){
                    $(this).html("<select id='estado' class='form-control filter'><option value=''>"+TODO+"</option><option value='"+ESTADO_ACTIVO+"'>"+ACTIVO+"</option><option value='"+ESTADO_INACTIVO+"'>"+INACTIVO+"</option></select>");
                }                
            }
            column++;
        }); 
        
        $('.filter, .select2').on('click', function(e){
            e.stopPropagation();    
        });
        
        // Buscar los valores ingresados
        table.columns().every(function (index) {        
            $('#list-escenario thead tr:eq(1) th:eq(' + index + ') select').on('change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
            });
            
            $('#list-escenario thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                if(this.value.length > 3 || this.value.length == 0){
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
                }
            });            
        });

	});
</script>