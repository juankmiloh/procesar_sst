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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "USU_TIENE_CAMPEONATOS") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "USU_TIENE_CAMPEONATOS") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "USUARIO"); ?></th>
                        <th><?php echo Yii::t("app", "CAMPEONATO"); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "USUARIO"); ?></th>
                        <th><?php echo Yii::t("app", "CAMPEONATO"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "USUARIO"); ?></th>
                        <th><?php echo Yii::t("app", "CAMPEONATO"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>



    </div>
    
    
    <!-- CREAR/EDITAR MODAL -->
    <input id="urlEditData" type="hidden" value="<?= Url::toRoute(['permisos/editar']); ?>">
    
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
                    <p id="msn"></p> 
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "EVENTOs_LOWWER") ?></label>
                                    <?php
                                        
                                        echo Html::dropDownList('eve_id','eve_id',$eventos,
                                                [
                                                    'prompt'=>Yii::t("app", "SELECCIONE"), 
                                                    'class' => 'form-control', 
                                                    'style' => 'width: 375px', 
                                                    'id' => 'eve_id', 
                                                    'onchange' => '
                                                        $.ajax({
                                                                url: "' . Url::toRoute('helper/getdeportesfromevento') . '",
                                                                data: {id : $("#eve_id").val()},
                                                                success: function (response) {
                                                                    $("#dep_id").html(response);
                                                                },
                                                        })',
                                                ]);
                                    ?>
                                    
                                    <label class="control-label"><?= Yii::t('app', "USUARIOS") ?></label>
                                    <?php
                                        
                                        echo Html::dropDownList('usu_id','usu_id',$usuarios,['prompt'=>Yii::t("app", "SELECCIONE"), 'class' => 'form-control', 'style' => 'width: 375px', 'id' => 'usu_id']);
                                    ?>

                                </div>
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "DEPORTES") ?></label>
                                    <?php
                                        $array = [];
                                        echo Html::dropDownList('dep_id','dep_id',$array,
                                                [
                                                    'prompt'=>Yii::t("app", "SELECCIONE"), 
                                                    'class' => 'form-control', 
                                                    'style' => 'width: 375px', 
                                                    'id' => 'dep_id',
                                                    'onchange' => '
                                                        $.ajax({
                                                                url: "' . Url::toRoute('helper/getcampeonatospordeporte') . '",
                                                                data: {dep : $("#dep_id").val(), eve : $("#eve_id").val()},
                                                                success: function (response) {
                                                                    $("#multiselect").html(response);
                                                                },
                                                        })',
                                                ]);
                                    ?>

                                </div>
                            </div>
                            <br>
                            
                            <!-- Agregar campeonatos al usuario -->
                            <div class="row gutter">

                                    <div class="row style-select">
                                        <div class="col-xs-5">
                                            <label class="control-label"><?=Yii::t('app', "CAMPEONATOS"); ?><?= Html::a(" (".Yii::t('app', "CREAR_CAMPEONATO").") ", ['campeonato/listar'], ['style' => 'color: blue']); ?></label>
                                            <?php
                                                $array = [];
                                                echo Html::dropDownList('multiselect', 'multiselect', $array, ['class' => 'form-control', 'multiple'=>"multiple", 'id' => 'multiselect']);
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
                                              <label class="control-label"><?=Yii::t('app', "CAMPEONATOS_ASIGNADOS")?></label>
                                              <select name="campeonatos[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                                        </div>
                                    </div>
                            </div>
                           
                        </div>

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
    var SELEC_USUARIO = '<?php echo Yii::t("app", "SELEC_USUARIO") ?>'; 
    var SELEC_CAMPEONATOS = '<?php echo Yii::t("app", "SELEC_CAMPEONATOS") ?>'; 
    var REGISTRO_EXITO = '<?php echo Yii::t("app", "REGISTRO_EXITO") ?>'; 
    var REGISTRO_EXITO_EDICION = '<?php echo Yii::t("app", "REGISTRO_EXITO_EDICION") ?>'; 
    var EVENTO_SEL = '<?php echo Yii::t("app", "EVENTO_SEL") ?>'; 
    var DEPORTE_SEL = '<?php echo Yii::t("app", "DEPORTE_SEL") ?>'; 

    
    $(document).ready(function () {

//        //Data table, lista eventos
        var table = $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['permisos/data']); ?>",
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
        $('#usu_id').select2(); 
        $('#eve_id').select2(); 
        
        
        //Contador de columnas
        $.fn.columnCount = function() {  
            return $('th', $(this).find('tfoot')).length;  
        }; 
        
        // Filtros por columnas
        var column = 0;
        $('#list-datos thead tr:eq(1) th').each( function () {
            
            //No agregue filtro para el registro ID
            if(column > 0 && column < ($('#list-datos').columnCount() - 1)){ 
                
                if(column == 1){//Construye lista de usuarios
                    <?php
                        $html = Html::dropDownList('usu_id2', 'usu_id2', $usuarios, ['prompt' => Yii::t('app', ''), 'class' => 'form-control', 'id' => 'usu_id2', 'name' => 'usu_id2']);
                        $html = preg_replace( "/\r|\n/", "", $html );;
                        $data = "";
                    ?>
                    $(this).html( '<?php echo $html; ?>' );
                    $('#usu_id2').select2();
                } 
            }
            column++;
        });
        
        // Buscar los valores ingresados
        table.columns().every(function (index) {
        
            $('#list-datos thead tr:eq(1) th:eq(' + index + ') select').on('change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
            });
            
            $('#list-datos thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
            });
            
        });

    });
    
</script>
<script src="../views/permisos/js/permisos.js"></script>