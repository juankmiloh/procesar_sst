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
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "INICIO"), array("site/index"));
                            ?>
                        </li>
                        <li class="active">
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "PARAM_DEPORTE"), array("paramdeporte/listar"));
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "REGLAS_PARAM") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "REGLAS_PARAM") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_REGLA") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "DEPORTE_"); ?></th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "VALOR"); ?></th>
                        <th><?php echo Yii::t("app", "TIPO"); ?></th>
                        <th><?php echo Yii::t("app", "ROL"); ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "DEPORTE_"); ?></th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "VALOR"); ?></th>
                        <th><?php echo Yii::t("app", "TIPO"); ?></th>
                        <th><?php echo Yii::t("app", "ROL"); ?></th>
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
    <input id="urlEditData" type="hidden" value="<?= Url::toRoute(['paramdeporte/editarregla']); ?>">
    <input id="parametro" type="hidden" value="<?= $parametrizacion->param_id; ?>" >
    
    <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?= Yii::t('app', "REGLA"); ?></h4>
                </div>
                <div class="modal-body">
                    <p id="msn"></p> 
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                        <input id="idParam" name="idParam" type="hidden" value="0">
                        <div class="form-group">
                            <div class="row gutter">
                                
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "NOMBRE") ?></label>
                                    <input type="text" class="form-control" id="pts_suceso" name="pts_suceso">
                                    
                                    <label class="control-label"><?= Yii::t('app', "TIPO") ?></label><br>
                                    <?php
                                        echo Html::dropDownList('ts_id', 'ts_id', $tipos, 
                                                [   'prompt' => Yii::t('app', "SELECCIONE"), 
                                                    'style' => 'width: 375px', 
                                                    'class' => "form-control",
                                                    'id' => 'ts_id'
                                                ]);
                                    ?>
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "VALOR") ?></label>
                                    <input type="number" class="form-control" id="pts_suceso_valor" name="pts_suceso_valor" style="margin-bottom: 20px;">
                                    
                                    <label class="control-label"><?= Yii::t("app", "ROL_PARTICIPANTE") ?>:</label>
                                    <?php 
                                        echo Html::dropDownList('pts_rol', 'pts_rol', unserialize(ROLES_PARTICIPANTE), 
                                            [   
                                                'style' => 'width: 375px',
                                                'class' => 'form-control',
                                                'id' => 'pts_rol',
                                                'onchange' => 'buscarJugadores(this.value)',
                                            ]);
                                    ?>
                                    
                                </div>
                            </div>

                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?= Yii::t('app', "CERRAR") ?></button>
                            <button type="button" class="btn btn-info" onclick="nuevoRegistro();" id="botonCrear"><i class="icon-save icon-left"></i> <?= Yii::t('app', "GUARDAR") ?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
</body>

<script>
    
    
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    var MAX_LENGHT_USU_NOMBRE = '<?php echo Yii::t("app", "MAX_LENGHT_USU_NOMBRE") ?>'; 
    var MIN_LENGHT_USU_NOMBRE = '<?php echo Yii::t("app", "MIN_LENGHT_USU_NOMBRE") ?>'; 
    var INGRESE_VALOR = '<?php echo Yii::t("app", "INGRESE_VALOR") ?>'; 
    var SEL_TS = '<?php echo Yii::t("app", "SEL_TS") ?>'; 
    var ROL_NECESARIO = '<?php echo Yii::t("app", "ROL_NECESARIO") ?>'; 
    var REGISTRO_EXITO = '<?php echo Yii::t("app", "REGISTRO_EXITO") ?>'; 
    var REGISTRO_EXITO_EDICION = '<?php echo Yii::t("app", "REGISTRO_EXITO_EDICION") ?>'; 
    
    $(document).ready(function () {

//        //Data table, lista eventos
        $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['paramdeporte/datareglas',  'idParam' => $parametrizacion->param_id]); ?>",
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

    });
    
</script>
<script src="../views/paramdeporte/js/reglas.js"></script>