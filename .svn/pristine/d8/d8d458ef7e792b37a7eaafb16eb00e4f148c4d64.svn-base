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
                            <?php
                                echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "CAMPEONATO"), ["campeonato/listar", 'idDeporte' => $campeonato->dep_id]);
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "FASES") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Barra Azul -->
            <div class="top-bar clearfix">
            </div>
            
            <!-- Botón CREAR -->
                <div class="row gutter">
                    <div class="col-md-10 col-sm-6 col-xs-6">
                        <h3 class="page-title"><?= Yii::t('app', "FASES")." (".$campeonato->camp_nombre.")" ?></h3>
                        <h4 class="page-title"><?= Yii::t('app', "PROMOCION")." (".$promocion->prom_nombre.")" ?></h4>
                        <h4><?= Yii::t('app', "EVENTO_LOWWER").": ".$campeonato->getEve()->one()->eve_nombre; ?></h4>
                        <h4><?= Yii::t('app', "TOTAL_EQUIPOS_PROMOCIONADOS").": ".$total_equipos_promocionados; ?></h4>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_FASE_CAMPEONATO") ?></button>
                        </ul>
                    </div>
                </div>

            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "CAMPEONATO"); ?></th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "TIPO_ELIMINACION"); ?></th>
                        <th><?php echo Yii::t("app", "IDA_VUELTA"); ?></th>
                        <th><?php echo Yii::t("app", "AVANCE"); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "CAMPEONATO"); ?></th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "TIPO_ELIMINACION"); ?></th>
                        <th><?php echo Yii::t("app", "IDA_VUELTA"); ?></th>
                        <th><?php echo Yii::t("app", "AVANCE"); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>



    </div>
    
    
    <!-- CREAR/EDITAR MODAL -->
    <input id="urlEditData" type="hidden" value="<?= Url::toRoute(['campeonato/editarfases', 'camp_id' => $campeonato->camp_id, 'total_equipos_promocionados' => $total_equipos_promocionados]); ?>">
    
    
    <!-- MODAL -->
    <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?php echo Yii::t("app", "CREAR_FASE_CAMPEONATO"); ?></h4>
                    <strong><?= Yii::t('app', "TOTAL_EQUIPOS_PROMOCIONADOS").": ".$total_equipos_promocionados; ?></strong>
                </div>
                <div class="modal-body">
                    
                    <!-- Mensaje de resultados -->
                    <p id="msn"></p> 
                    
                    <!-- INICIO de form -->
                    <form id="formulario">
                        
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "NOMBRE") ?></label>
                                    <input type="text" class="form-control" id="ctf_nombre" name="ctf_nombre">
                                    
                                    <label class="control-label"><?php echo Yii::t("app", "TIPO_ELIMINACION"); ?></label>
                                    <?php
                                        echo Html::dropDownList('ctf_tipo_eliminacion','ctf_tipo_eliminacion',unserialize(TIPO_ELIMINACION),
                                                ['class'=>'form-control', 'id' => 'ctf_tipo_eliminacion']);                                
                                    ?>
                                    
                                </div>
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?php echo Yii::t("app", "IDA_VUELTA"); ?></label>
                                    <?php
                                        echo Html::dropDownList('ctf_ida_vuelta','ctf_ida_vuelta',unserialize(IDA_VUELTA),
                                                ['class'=>'form-control', 'id' => 'ctf_ida_vuelta']);                                
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <!-- Campos eliminacion por grupos -->
                        <div class="form-group" id="elim_grupos_div" style="display: none">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "CANTIDAD_GRUPOS") ?></label>
                                    <input type="number" class="form-control" id="ctf_cantidad_grupos" name="ctf_cantidad_grupos">
                                </div>    
                                <div class="col-md-6">    
                                    <label class="control-label"><?php echo Yii::t("app", "CLASIFICADOS_POR_GRUPO"); ?></label>
                                    <input type="number" class="form-control" id="ctf_clasificados_grupo" name="ctf_clasificados_grupo">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?=Yii::t('app', "CERRAR")?></button>
                            <button type="button" class="btn btn-info" onclick="nuevoRegistro();" id="botonCrear"><i class="icon-save icon-left"></i> <?=Yii::t('app', "GUARDAR")?></button>
                        </div>
                        
                    </form>
                    <!-- FIN de form -->
                    
                </div>
            </div>

        </div>
    </div>
    
</body>

<script>
    
    
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    var FASE_NAME_MIN = '<?php echo Yii::t("app", "FASE_NAME_MIN") ?>'; 
    var FASE_NAME_MAX = '<?php echo Yii::t("app", "FASE_NAME_MAX") ?>'; 
    var FASE_TIPO_ELIMINACION = '<?php echo Yii::t("app", "FASE_TIPO_ELIMINACION") ?>'; 
    var FASE_IDA_VUELTA = '<?php echo Yii::t("app", "FASE_IDA_VUELTA") ?>'; 
    var FASE_EXITO = '<?php echo Yii::t("app", "FASE_EXITO") ?>'; 
    var FASE_EXITO_EDITAR = '<?php echo Yii::t("app", "FASE_EXITO_EDITAR") ?>'; 
    var SEL_CANTIDAD_GRUPOS = '<?php echo Yii::t("app", "SEL_CANTIDAD_GRUPOS") ?>';
    var SEL_CLASIFICADOS_POR_GRUPO = '<?php echo Yii::t("app", "SEL_CLASIFICADOS_POR_GRUPO") ?>';
    var ELIMINAR = '<?php echo Yii::t("app", "ELIMINAR") ?>';
    var ELIMINAR_ERROR = '<?php echo Yii::t("app", "ELIMINAR_ERROR") ?>';
    
    var NUM_GRUPOS_POSITIVO = '<?php echo Yii::t("app", "NUM_GRUPOS_POSITIVO") ?>';
    var NUM_CLASIFICADOS_PSOITIVO = '<?php echo Yii::t("app", "NUM_CLASIFICADOS_PSOITIVO") ?>';
    
    $(document).ready(function () {
        
        //Data table, lista eventos
        $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "dom": 'lrtip', //Esconde el campo de busqueda
            "ajax": "<?php echo Url::toRoute(['campeonato/datafases',  'camp_id' => $campeonato->camp_id]); ?>",
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
        * Al seleccionar el tipo de eliminación, habilite los campos adicionales...
         */
        $( "#ctf_tipo_eliminacion" ).change(function() {
        
            $("#elim_grupos_div").css('display','none');
            
            if($( "#ctf_tipo_eliminacion" ).val() == <?php echo ELIMINACION_GRUPO ?> ){
                $("#elim_grupos_div").css('display','block');
            } 
        });
        
    });
    
</script>
<script src="../views/campeonato/js/listarfases.js"></script>