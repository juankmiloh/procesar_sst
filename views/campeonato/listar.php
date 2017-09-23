<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
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
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "TORNEOS"), array("campeonato/torneos"));
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

            <!-- Botón CREAR -->
            <div class="container-fluid">
                <div class="row gutter">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <h3 class="page-title"><?= Yii::t('app', "CAMPEONATOS") ?></h3>
                        <h4><?= Yii::t('app', "DEPORTE_").": ".$deporte->dep_nombre; ?></h4>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_CAMPEONATO") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "EVENTOs_LOWWER"); ?></th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "CATEGORIA"); ?></th>
                        <th><?php echo Yii::t("app", "TIPO_DEPORTE"); ?></th>
                        <th><?php echo Yii::t("app", "DEPORTES"); ?></th>
                        <th><?php echo Yii::t("app", "GENERO"); ?></th>
                        <th><?php echo Yii::t("app", "PRUEBA"); ?></th>
                        <th><?php echo Yii::t("app", "AVANCE"); ?></th>
                        <th><?php echo Yii::t("app", "FASES"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "EVENTOs_LOWWER"); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?php echo Yii::t("app", "PRUEBA"); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "EVENTOs_LOWWER"); ?></th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "CATEGORIA"); ?></th>
                        <th><?php echo Yii::t("app", "TIPO_DEPORTE"); ?></th>
                        <th><?php echo Yii::t("app", "DEPORTES"); ?></th>
                        <th><?php echo Yii::t("app", "GENERO"); ?></th>
                        <th><?php echo Yii::t("app", "PRUEBA"); ?></th>
                        <th><?php echo Yii::t("app", "AVANCE"); ?></th>
                        <th><?php echo Yii::t("app", "FASES"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>



    </div>
    
    
    <!-- CREAR/EDITAR MODAL -->
    <input id="urlEditData" type="hidden" value="<?= Url::toRoute(['campeonato/editar']); ?>">
    <input id="listarFases" type="hidden" value="<?= Url::toRoute(['campeonato/listarfases']); ?>">
    <input id="urlEventoFechas" type="hidden" value="<?= Url::toRoute(['evento/fechasevento']); ?>">
    <input id="dep_id" type="hidden" value="<?= $deporte->dep_id; ?>">
    
    <!-- MODAL -->
    <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo Yii::t("app", "CREAR_CAMPEONATO"); ?></h4>
                </div>
                <div class="modal-body">
                    
                    <!-- Mensaje de resultados -->
                    <p id="msn"></p> 
                    
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="">
                        
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "EVENTOs_LOWWER") ?></label>
                                    <?php
                                        echo Html::dropDownList('eve_id','eve_id',$eventos,['prompt'=>Yii::t("app", "SELECCIONE"), 'style' => 'width: 375px', 'id' => 'eve_id', 'tabindex' => 1]);
                                    ?>
                                    
                                    <label class="control-label"><?= Yii::t('app', "CATEGORIA") ?></label>
                                    <?php
                                        echo Html::dropDownList('cat_id','cat_id',$categorias,['prompt'=>Yii::t("app", "SELECCIONE"), 'class'=>'form-control', 'id' => 'cat_id', 'tabindex' => 2,
                                            'onchange' => '
                                                $.ajax({
                                                        url: "' . Url::toRoute('helper/getpruebas') . '",
                                                        data: {tipoDeporte : $("#tipo_deporte_id").val(), idDeporte : '.$deporte->dep_id.', idCategoria : $("#cat_id").val(), idGenero : $("#genero_id").val()},
                                                        success: function (response) {
                                                            $("#prueb_id").html(response);
                                                        },
                                                })',
                                        ]);
                                    ?>
                                    
                                    <label class="control-label"><?php echo Yii::t("app", "TIPO_DEPORTE"); ?></label>
                                    <?php
                                        echo Html::dropDownList('tipo_deporte_id','tipo_deporte_id',$tipoDeporte,['prompt'=>Yii::t("app", "SELECCIONE"), 'class'=>'form-control', 'id' => 'tipo_deporte_id', 'style' => 'margin-bottom: 12px', 'tabindex' => 4,
                                                'onchange' => '
                                                        $.ajax({
                                                                url: "' . Url::toRoute('helper/getpruebas') . '",
                                                                data: {tipoDeporte : $("#tipo_deporte_id").val(), idDeporte : '.$deporte->dep_id.', idCategoria : $("#cat_id").val(), idGenero : $("#genero_id").val()},
                                                                success: function (response) {
                                                                    $("#prueb_id").html(response);
                                                                },
                                                        })',
                                            ]);
                                    ?>
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    
                                    
                                    
                                    <label class="control-label"><?php echo Yii::t("app", "DEPORTE"); ?></label>
                                    <input type="text" id="deporte" name="deporte" class="form-control" value="<?php echo $deporte->dep_nombre; ?>" readonly style="height: 20px;">
                                    
                                    <label class="control-label"><?= Yii::t('app', "GENERO") ?></label>
                                    <?php
                                        echo Html::dropDownList('genero_id', 'genero_id',$genero, ['prompt'=>Yii::t("app", "SELECCIONE"), 'class' => 'form-control', 'id' => 'genero_id', 'tabindex' => 3,
                                            'onchange' => '
                                                $.ajax({
                                                        url: "' . Url::toRoute('helper/getpruebas') . '",
                                                        data: {tipoDeporte : $("#tipo_deporte_id").val(), idDeporte : '.$deporte->dep_id.', idCategoria : $("#cat_id").val(), idGenero : $("#genero_id").val()},
                                                        success: function (response) {
                                                            $("#prueb_id").html(response);
                                                        },
                                                })',
                                        ]);
                                    ?>
                                    
                                    <label class="control-label"><?php echo Yii::t("app", "PRUEBA"); ?></label>
                                        <?php
                                            echo Html::dropDownList('prueb_id','prueb_id',array(),['prompt'=>Yii::t("app", "SELECCIONE"), 'class'=>'form-control', 'id' => 'prueb_id', 'style' => 'width: 375px', 'tabindex' => 5]);
                                        ?>
                                    
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="control-label"><?= Yii::t('app', "ESTADO") ?></label>
                                    <?php
                                        echo Html::dropDownList('camp_estado', 'camp_estado', array(ESTADO_ACTIVO => Yii::t('app', "ACTIVO"), ESTADO_INACTIVO => Yii::t('app', "INACTIVO")), [ 'class' => 'form-control', 'id' => 'camp_estado', 'tabindex' => 6 ]);
                                    ?> 
                                </div>
                                
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "FECHA_INICIO") ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="camp_fecha_inicio" name="camp_fecha_inicio" placeholder="dd/mm/aaaa" readonly> <span class="input-group-addon"><span class="icon-calendar"></span></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label"><?= Yii::t('app', "FECHA_FIN") ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="camp_fecha_fin" name="camp_fecha_fin" placeholder="dd/mm/aaaa" readonly> <span class="input-group-addon"><span class="icon-calendar"></span></span>
                                    </div>
                                </div>
                                
                            </div>
                            <br>
                            
                            <!-- Agregar escenarios al campeonatos -->
                            <div class="row gutter">

                                    <div class="row style-select">
                                            <div class="col-xs-5">
                                                    <label class="control-label"><?=Yii::t('app', "ESCENARIOS"); ?><?= Html::a(" (".Yii::t('app', "CREAR_ESCENARIO").") ", ['escenario/listar'], ['style' => 'color: blue']); ?></label>
                                                    <?php
                                                        echo Html::dropDownList('multiselect', 'multiselect', $escenarios, ['class' => 'form-control', 'multiple'=>"multiple", 'id' => 'multiselect']);
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
                                                    <label class="control-label"><?=Yii::t('app', "ESCENARIOS_ASIGNADOS")?></label>
                                                    <select name="escenario[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                                              </div>
                                    </div>
                            </div>
                           
                        </div>


<!--                        <div class="form-group">
                            <label for="message-texta" class="control-label"><?=Yii::t('app', "OBSERVACIONES")?>:</label>
                            <textarea class="form-control" id="message-texta"></textarea>
                        </div>-->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?=Yii::t('app', "CERRAR")?></button>
                            <button type="button" class="btn btn-info" onclick="nuevoRegistro();" id="botonCrear"><i class="icon-save icon-left"></i> <?=Yii::t('app', "GUARDAR")?></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
</body>

<script>
    
    
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    var EVENTO_SEL = '<?php echo Yii::t("app", "EVENTO_SEL") ?>'; 
    var GENERO_SEL = '<?php echo Yii::t("app", "GENERO_SEL") ?>'; 
    var TIPO_DEPORTE_SEL = '<?php echo Yii::t("app", "TIPO_DEPORTE_SEL") ?>'; 
    var DEPORTE_SEL = '<?php echo Yii::t("app", "DEPORTE_SEL") ?>'; 
    var CATEGORIA_SEL = '<?php echo Yii::t("app", "CATEGORIA_SEL") ?>';  
    var ESCENARIOS_SEL = '<?php echo Yii::t("app", "ESCENARIOS_SEL") ?>';  
    var CAMPEONATO_EXITO = '<?php echo Yii::t("app", "CAMPEONATO_EXITO") ?>';  
    var CAMPEONATO_EXITO_EDITAR = '<?php echo Yii::t("app", "CAMPEONATO_EXITO_EDITAR") ?>';  
    var PRUEBA_SEL = '<?php echo Yii::t("app", "PRUEBA_SEL") ?>';  
    var FECHA_INICIO = '<?php echo Yii::t("app", "FECHA_INICIO") ?>';  
    var FECHA_FIN = '<?php echo Yii::t("app", "FECHA_FIN") ?>';  
    
    $(document).ready(function () {

        //Data table, lista eventos
        var table = $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "dom": 'lrtip', //Esconde el campo de busqueda
            "ajax": "<?php echo Url::toRoute(['campeonato/data', 'idDeporte' => $idDeporte]); ?>",
            "initComplete": function(settings, json) {
                $("[id$='circle']").percircle();
            },
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
        
        
        /**
        * Multiselect para escenarios
         */
        $('#multiselect').multiselect();
        
        /**
        * Select2 lista evento
         */
        $('#eve_id').select2();
        
        /**
        * Al seleccionar el evento se restringe las fechas de inicio y fin
         */
        $( "#eve_id" ).change(function() {
            $("#camp_fecha_inicio").val("");
            $("#camp_fecha_fin").val("");
            if($( "#eve_id" ).val() != ""){
                var dates = getDatesFromEvent($( "#eve_id" ).val());
            } 
        })
        
        
        //Fecha inicial (Crear campeonato)
        $("#camp_fecha_inicio").datepicker({
            format:'yyyy-mm-dd',
                autoclose: true,
                todayBtn: 'linked',
                changeMonth: true,
                changeYear: true,
                startDate: new Date(),
                endDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#camp_fecha_fin').datepicker('setStartDate', minDate);
        });

        //Fecha final (Crear campeonato)
        $("#camp_fecha_fin").datepicker({
            format:'yyyy-mm-dd',
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                startDate: new Date(),
                endDate: new Date(),
        });
        
        //Contador de columnas
        $.fn.columnCount = function() {  
            return $('th', $(this).find('tfoot')).length;  
        }; 
        
       // Filtros por columnas
        var column = 0;
        $('#list-datos thead tr:eq(1) th').each( function () {
            
            //No agregue filtro para el registro ID
            if(column > 0 && column < ($('#list-datos').columnCount() - 1)){ 
                
                if(column == 1){//Construye una lista 
                    <?php
                        $html = Html::dropDownList('eve_id2', 'eve_id2', $eventos, ['prompt' => 'Buscar', 'class' => 'form-control filter',  'id' => 'eve_id2', 'name' => 'eve_id2', 'style'=>'width: 190px']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>
                    $(this).html( '<?php echo $html; ?>' );
                    $('#eve_id2').select2({
                        //placeholder: "Buscar"
                    });
                } 
//                else if(column == 3){//Construye una lista 
//                    <?php
                        $html = Html::dropDownList('prom_id2', 'prom_id2', $categorias, ['empty' => Yii::t('app', 'Buscar'), 'class' => 'form-control filter', 'id' => 'prom_id2', 'name' => 'prom_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>//
//                    $(this).html( '<?php echo $html; ?>' );
//                    $('#prom_id2').select2();
//                } else if(column == 4){//Construye una lista 
//                    <?php
                        $html = Html::dropDownList('tipo_id2', 'tipo_id2', $tipoDeporte, ['prompt' => Yii::t('app', ''), 'class' => 'form-control filter', 'id' => 'tipo_id2', 'name' => 'tipo_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>//
//                    $(this).html( '<?php echo $html; ?>' );
//                    $('#tipo_id2').select2();
//                }   else if(column == 6){//Construye una lista 
//                    <?php
                        $html = Html::dropDownList('gen_id2', 'gen_id2', $genero, ['prompt' => Yii::t('app', ''), 'class' => 'form-control filter', 'id' => 'gen_id2', 'name' => 'gen_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>//
//                    $(this).html( '<?php echo $html; ?>' );
//                    $('#gen_id2').select2();
//                } 
                else if(column == 7){//Construye una lista 
                    <?php
                        $html = Html::dropDownList('prueb_id2', 'prueb_id2', $pruebas, ['prompt' => Yii::t('app', 'Buscar'), 'class' => 'form-control filter', 'id' => 'prueb_id2', 'name' => 'prueb_id2', 'style'=>'width: 190px']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>
                    $(this).html( '<?php echo $html; ?>' );
                    $('#prueb_id2').select2({
                        //placeholder: "Buscar"
                    });
                }
                
            }
            column++;
        }); 
        
        $('.filter, .select2').on('click', function(e){
            e.stopPropagation();    
        });
        
        // Buscar los valores ingresados
        table.columns().every(function (index) {
        
            $('#list-datos thead tr:eq(1) th:eq(' + index + ') select').on('change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
            });
            
            $('#list-datos thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                if(this.value.length > 3 || this.value.length == 0){
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
                }
            });
            
        });

    });
    
</script>
<script src="../views/campeonato/js/campeonato.js"></script>