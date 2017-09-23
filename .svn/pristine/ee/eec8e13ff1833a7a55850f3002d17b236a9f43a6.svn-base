<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "EVENTOS") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Barra Azul -->
            <div class="top-bar clearfix">
            </div>

            <!-- Botón CREAR -->
            <div class="container-fluid">
                <div class="row gutter">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <h3 class="page-title"><?= Yii::t('app', "SISTEMA_COMPETENCIA") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanEvento()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREATE_EVENT") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-evento" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "PROMOCION"); ?></th>
                        <th><?php echo Yii::t("app", "EVENTOS"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_INICIO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_FINAL"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><?php echo Yii::t("app", "PROMOCION"); ?></th>
                        <th><?php echo Yii::t("app", "EVENTOS"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_INICIO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_FINAL"); ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "PROMOCION"); ?></th>
                        <th><?php echo Yii::t("app", "EVENTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_INICIO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_FINAL"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>



    </div>
    
    
    <!-- CREAR EVENTO MODAL -->
    <input id="urlCrearEvento" type="hidden" value="<?= Url::toRoute(['evento/crearevento']); ?>">
    <input id="urlEditarEvento" type="hidden" value="<?= Url::toRoute(['evento/editarevento']); ?>">
    
    <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?= Yii::t('app', "NUEVO_EVENTO") ?></h4>
                </div>
                <div class="modal-body">
                    <p id="msnEvento"></p> 
                    <form id="nuevo_evento_form">
                        <input id="idEvento" name="idEvento" type="hidden" value="0">
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    <label class="control-label"><?= Yii::t('app', "NOMBRE") ?></label>
                                    <input type="text" class="form-control" id="eve_nombre" name="eve_nombre" onkeypress="soloAlfanumerico(event);">

                                    <label class="control-label"><?= Yii::t('app', "FECHA_INICIO") ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="eve_fecha_ini" name="eve_fecha_ini" placeholder="dd/mm/aaaa" readonly> <span class="input-group-addon"><span class="icon-calendar"></span></span>
                                    </div>

                                    <label class="control-label"><?= Yii::t('app', "PROMOCION") ?></label>
                                    <?php
                                        echo Html::dropDownList('prom_id', 'prom_id', $promociones, ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'prom_id']);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "ESTADO") ?></label>
                                    <?php
                                        echo Html::dropDownList('eve_activo', 'eve_activo', $estados, [ 'class' => 'form-control', 'id' => 'eve_activo', "style" => "margin-bottom: 20px;" ]);
                                    ?>
                                    
                                    <!--button type="button" class="btn btn-info" style="margin-bottom: 15px; margin-top: 25px;"><i class="icon-add_box icon-left"></i>Agregar Sede</button-->

                                    <label class="control-label"><?= Yii::t('app', "FECHA_FIN") ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="eve_fecha_fin" name="eve_fecha_fin" placeholder="dd/mm/aaaa" readonly> <span class="input-group-addon"><span class="icon-calendar"></span></span>
                                    </div>
                                    
                                    

                                </div>
                            </div>

                        </div>
                        
                        <!-- Agregar sedes al evento -->
                        <div class="row gutter">

                                <div class="row style-select">
                                        <div class="col-xs-5">
                                                <label class="control-label"><?=Yii::t('app', "SEDES"); ?><?= Html::a(" (".Yii::t('app', "CREAR_SEDE").") ", ['sede/listar'], ['style' => 'color: blue']); ?></label>
                                                <?php
                                                    echo Html::dropDownList('multiselect', 'multiselect', $sedes, ['class' => 'form-control', 'multiple'=>"multiple", 'id' => 'multiselect']);
                                                ?>
                                          </div>
                                          <div class="col-xs-2">
                                          <label class="control-label"><?=Yii::t('app', "OPCIONES")?></label>
                                                <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                                <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                          </div>
                                          <div class="col-xs-5">
                                                <label class="control-label"><?=Yii::t('app', "SEDES_ASIGNADAS")?></label>
                                                <select name="sedes[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                                          </div>
                                </div>
                        </div>
                        
                        <!-- Detalles evento -->
                        <div class="form-group">
                            <label for="message-texta" class="control-label"><?= Yii::t('app', "DETALLE_EVENTO") ?></label>
                            <textarea class="form-control" id="eve_detalle" name="eve_detalle"></textarea>
                        </div>
                        

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?= Yii::t('app', "CERRAR") ?></button>
                            <button type="button" class="btn btn-info" onclick="nuevoEvento();" id="crearEventoBtn"><i class="icon-save icon-left"></i> <?= Yii::t('app', "GUARDAR") ?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
</body>

<script>
    
    var MAX_NOMBRE_EVENTO = '<?php echo Yii::t("app", "MAX_NOMBRE_EVENTO") ?>';
    var MIN_NOMBRE_EVENTO = '<?php echo Yii::t("app", "MIN_NOMBRE_EVENTO") ?>';
    var SEDE_SELECT = '<?php echo Yii::t("app", "SEDE_SELECT") ?>';
    var FECHA_INICIO_EVENTO = '<?php echo Yii::t("app", "FECHA_INICIO_EVENTO") ?>';
    var FECHA_FINAL_EVENTO = '<?php echo Yii::t("app", "FECHA_FINAL_EVENTO") ?>';
    var PROMOCION_EVENTO = '<?php echo Yii::t("app", "PROMOCION_EVENTO") ?>';
    var DETALLE_EVENTO_MSN = '<?php echo Yii::t("app", "DETALLE_EVENTO_MSN") ?>';
    var EVENTO_EXITO = '<?php echo Yii::t("app", "EVENTO_EXITO") ?>';
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    var EVENTO_EXITO_EDICION = '<?php echo Yii::t("app", "EVENTO_EXITO_EDICION") ?>';
    
    $(document).ready(function () {

//        //Data table, lista eventos
        var table = $('#list-evento').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['evento/eventos']); ?>",
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
        $("#eve_fecha_ini").datepicker({
            format:'yyyy-mm-dd',
                autoclose: true,
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#eve_fecha_fin').datepicker('setStartDate', minDate);
        });

        //Fecha final (Crear evento)
        $("#eve_fecha_fin").datepicker({
            format:'yyyy-mm-dd',
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                startDate: $("#eve_fecha_ini").datepicker("getDate"),
        }).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#eve_fecha_ini').datepicker('setEndDate', maxDate);
        });
        
        /**
        * Multiselect para sedes
         */
        $('#multiselect').multiselect();
        
        //Contador de columnas
        $.fn.columnCount = function() {  
            return $('th', $(this).find('tfoot')).length;  
        }; 
        
       // Filtros por columnas
        var column = 0;
        $('#list-evento thead tr:eq(1) th').each( function () {
            
            //No agregue filtro para el registro ID
            if(column > 0 && column < ($('#list-evento').columnCount() - 1)){ 
                
                if(column == 1){//Construye una lista 
                    <?php
                        $html = Html::dropDownList('prom_id2', 'prom_id2', $promociones, ['prompt' => Yii::t('app', ''), 'class' => 'form-control filter', 'id' => 'prom_id2', 'name' => 'prom_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>
                    $(this).html( '<?php echo $html; ?>' );
                    $('#prom_id2').select2();
                }
                else if(column == 3 || column == 4){ //Campo de fecha
                    $(this).html( '<input class="form-control filter" style="height: 15px;" id="datapicker" type="text"  readonly/>' );
                    $('#datapicker').datepicker({
                        format:'yyyy-mm-dd',
                        autoclose: true,
                        todayBtn: 'linked',
                        clearBtn: true,
                        changeMonth: true,
                        changeYear: true,
                        endDate: new Date(),
                    });
                }
                else if(column == 5){//Construye una lista con los estados
                    <?php
                        $html = Html::dropDownList('prom_id2', 'prom_id2', $estados, ['prompt' => Yii::t('app', ''), 'class' => 'form-control filter', 'id' => 'prom_id2', 'name' => 'prom_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>
                    $(this).html( '<?php echo $html; ?>' );
                    $('#prom_id2').select2();
                }  else {
                    $(this).html( '<input class="form-control filter" style="height: 15px;" id="" type="text"  />' );
                }
            }
            column++;
        }); 
        
        $('.filter, .select2').on('click', function(e){
            e.stopPropagation();    
        });
        
        // Buscar los valores ingresados
        table.columns().every(function (index) {
        
            $('#list-evento thead tr:eq(1) th:eq(' + index + ') select').on('change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
            });
            
            $('#list-evento thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                if(this.value.length > 3 || this.value.length == 0){
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
                }
            });
            
        });

    });
    
</script>
<script src="../views/evento/js/evento.js"></script>