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
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "PROMOCION_DEP_CONJUNTO"), array("promocion/listar"));
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "EQUIPOS_PROMOCIONADOS") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "ASOCIAR_EQUIPOS") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "ASOCIAR_EQUIPOS") ?></button>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "PROMOCION"); ?></th>
                        <th><?php echo Yii::t("app", "DEPARTAMENTO"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
                        <th><?php echo Yii::t("app", "ENTIDAD"); ?></th>
                        <th><?php echo Yii::t("app", "PRUEBA"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "PROMOCION"); ?></th>
                        <th><?php echo Yii::t("app", "DEPARTAMENTO"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
                        <th><?php echo Yii::t("app", "ENTIDAD"); ?></th>
                        <th><?php echo Yii::t("app", "PRUEBA"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>
        
    </div>
    
    <!-- CREAR/EDITAR MODAL -->
    <input id="urlConsultarEquipos" type="hidden" value="<?= Url::toRoute(['promocion/consultarequipos']); ?>">
    <input id="urlGuardar" type="hidden" value="<?= Url::toRoute(['promocion/guardarequipospromocionados']); ?>">
    <input id="idRegistro" name="idRegistro" type="hidden" value="<?php echo $promocion->prom_id; ?>">
    
    <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm">
        <div class="modal-dialog" role="document" style="margin: 10px 5%; width: 95%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?= Yii::t('app', "ASOCIAR_EQUIPOS"); ?></h4>
                </div>
                <div class="modal-body">
                    <p id="msn"></p> 
                    <form id="formulario">
                        
                        <div class="form-group">
                            <div class="row gutter">
                                
                                <div class="col-md-3">
                                    <label class="control-label"><?= Yii::t('app', "FASE_ANTERIOR") ?></label><br>
                                    <?php
                                        
                                        echo Html::dropDownList('tp_id', 'tp_id', $tipoFase, 
                                                [   'prompt' => Yii::t('app', "SELECCIONE"), 
                                                    'style' => 'width: 280px', 
                                                    'class' => "form-control",
                                                    'id' => 'tp_id',
                                                ]);
                                    ?>
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="control-label"><?= Yii::t('app', "DEPARTAMENTO") ?></label><br>
                                    <?php
                                        
                                        echo Html::dropDownList('dpto_id', 'dpto_id', $departamentos, 
                                                [   'prompt' => Yii::t('app', "SELECCIONE"), 
                                                    'style' => 'width: 280px', 
                                                    'class' => "form-control",
                                                    'id' => 'dpto_id',
                                                    'onchange' => '
                                                        $.ajax({
                                                                url: "' . Url::toRoute('helper/getmunicipios') . '",
                                                                data: {id : $("#dpto_id").val()},
                                                                success: function (response) {
                                                                    $("#muni_id").html(response);
                                                                },
                                                        })',
                                                ]);
                                    ?>
                                </div>
                                
                                <div class="col-md-3">
                                    
                                    <label class="control-label"><?= Yii::t('app', "CIUDAD") ?></label><br>
                                    <?php
                                        $items = array();
                                        echo Html::dropDownList('muni_id', 'muni_id', $items, 
                                                [   'prompt' => 'Seleccione', 
                                                    'style' => 'width: 220px', 
                                                    'class' => "form-control",
                                                    'id' => 'muni_id'
                                                ]);
                                    ?>
         
                                </div>
                                
                                <div class="col-md-2">
                                    <br>
                                    <button type="button" class="btn btn-success" onclick="buscarPromociones(<?= $promocion->pi_id ?>);" id="botonCrear"><i class="icon-search4 icon-left"></i> <?= Yii::t('app', "BUSCAR") ?></button>
                                </div>
                                
                            </div>
                            <br><br>
                            
                            <!-- Agregar equipos promocionados -->
                            <div class="row gutter">

                                    <div class="row style-select">
                                            <div class="col-xs-5">
                                                    <label class="control-label" id="consultadas"><?=Yii::t('app', "ENTIDADES")?></label>
                                                    <?php
                                                        echo Html::dropDownList('multiselect', 'multiselect', $items, 
                                                                ['class' => 'form-control click', 'multiple'=>"multiple", 'id' => 'multiselect', 
                                                                    "style" =>"font-size: 10px; height: 280px;"]);
                                                    ?>
                                                    <div id="tooltip_container2"></div>
                                            </div>
                                            <div class="col-xs-2" style="width: 10%;">
                                            <label class="control-label"><?=Yii::t('app', "OPCIONES")?></label>
                                                  <button type="button" id="multiselect_rightAll" onclick="setTimeout(calcular,700);" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                                  <button type="button" id="multiselect_rightSelected" onclick="setTimeout(calcular,700);" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                                  <button type="button" id="multiselect_leftSelected" onclick="setTimeout(calcular,700);" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                                  <button type="button" id="multiselect_leftAll" onclick="setTimeout(calcular,700);" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                            </div>
                                            <div class="col-xs-5">
                                                  <label class="control-label" id="asignadas"><?=Yii::t('app', "SEDES_ASIGNADAS")?></label>
                                                  <select name="equipos[]" id="multiselect_to" class="form-control click" size="8" multiple="multiple" 
                                                          style="font-size: 10px;height: 280px;"></select>
                                                  <div id="tooltip_container"></div>
                                            </div>
                                            
                                    </div>
                            </div>

                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?= Yii::t('app', "CERRAR") ?></button>
                            <button type="button" class="btn btn-info" onclick="nuevoRegistro(<?php echo $promocion->prom_id; ?>);" id="botonCrear"><i class="icon-save icon-left"></i> <?= Yii::t('app', "GUARDAR") ?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
</body>


<script>
    
    
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    var ENTIDAD_SEL = '<?php echo Yii::t("app", "ENTIDAD_SEL") ?>'; 
    var EQUPOS_PROMOCIONADOS = '<?php echo Yii::t("app", "EQUPOS_PROMOCIONADOS") ?>'; 
    
    
    $(document).ready(function () {

//        //Data table, lista eventos
        var table = $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "dom": 'lrtip', //Esconde el campo de busqueda
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['promocion/datapromocionados']); ?>&idPromocion=<?php echo $promocion->prom_id; ?>",
//            "columnDefs" : [
//                { 
//                    //Solo la columna 2 (usuario) es buscable
//                    'searchable'    : false, 
//                    'targets'       : [0,1,3,4] 
//                },
//                {
//                    //Solo la columna 2 (usuario) es ordenable
//                    'orderable' : false,
//                    'targets'   : [1,4]
//                }
//            ],
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
        * Multiselect para sedes
         */
        $('#multiselect').multiselect();
        
        /**
        * Lista de departamentos con campo de busqueda
         */
        $('#dpto_id').select2();
        $('#muni_id').select2();
        
    });
    
</script>
<script src="../views/promocion/js/equipospromocionados.js"></script>