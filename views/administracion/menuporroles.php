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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "MENU_X_ROL") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "MENU_X_ROL") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modal-registro"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-registros" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "ROL"); ?></th>
                        <th><?php echo Yii::t("app", "MENU"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "ROL"); ?></th>
                        <th><?php echo Yii::t("app", "MENU"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>
    </div>
    
    <!-- URLS, se deben personalizar para cada form -->
    <input id="urlCrear" type="hidden" value="<?= Url::toRoute(['administracion/crearmenuporroles']); ?>">
    <input id="urlEditar" type="hidden" value="<?= Url::toRoute(['administracion/datosmenuporroles']); ?>">
    
    <div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="modal-registro">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?=Yii::t('app', "CREAR")?></h4>
                </div>
                <div class="modal-body">
                    <p id="msnResultado"></p> 
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                                        <div class="form-group">
                                                <div class="row gutter">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="row gutter">
                                                                
                                                                <label class="control-label"><?= Yii::t('app', "ROL") ?></label>
                                                                <?php
                                                                    $items = ArrayHelper::map(\app\models\Rol::find()->all(), 'rol_id', 'rol_nombre');
                                                                    echo Html::dropDownList('rol', 'rol', $items, ['prompt' => Yii::t('app', "SELECCIONE"), 'class' => 'form-control', 'id' => 'rol', 'name' => 'rol']);
                                                                ?>

                                                            </div>

                                                        </div>
                                                    
                                                        <div class="col-md-1">
                                                        </div>
                                                    
                                                        <div class="col-md-5">
                                                            <div class="row gutter">
                                                                
                                                                <label class="control-label"></label><br>
                                                                <?php
                                                                    echo Html::a(Yii::t("app", "CREAR_ROL"), array("administracion/roles"), array("class"=>"btn btn-info"));
                                                                ?>

                                                            </div>

                                                        </div>
                                                    
                                                </div>
                                            
                                                <div class="row gutter">

                                                        <div class="row style-select">
                                                                <div class="col-xs-5">
                                                                        <label class="control-label"><?=Yii::t('app', "MENUS")?></label>
                                                                        <?php
                                                                            $items = ArrayHelper::map(\app\models\Menu::find()->all(), 'menu_id', 'menu_nombre');
                                                                            echo Html::dropDownList('multiselect', 'multiselect', $items, ['class' => 'form-control', 'multiple'=>"multiple", 'id' => 'multiselect']);
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
                                                                        <label class="control-label"><?=Yii::t('app', "MENU_ASIGNADOS")?></label>
                                                                        <select name="menus[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                                                                  </div>
                                                        </div>
                                                    </div>
                                        </div>


                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?= Yii::t('app', "CERRAR") ?></button>
                                                <button type="button" class="btn btn-info" onclick="nuevoRegistro()" id="botonCrear" name="botonCrear"><i class="icon-save icon-left"></i> <?= Yii::t('app', "GUARDAR") ?></button>
                                        </div>
                                </form>
                </div>
            </div>

        </div>
    </div>
    
</body>


<script>
    
    var MENU_NECESARIO = '<?php echo Yii::t("app", "MENU_NECESARIO") ?>';
    var ROL_NECESARIO = '<?php echo Yii::t("app", "ROL_NECESARIO") ?>';
    var REGISTRO_EXITO = '<?php echo Yii::t("app", "REGISTRO_EXITO") ?>'; 
    var REGISTRO_EXITO_EDICION = '<?php echo Yii::t("app", "REGISTRO_EXITO_EDICION") ?>';
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    
    $(document).ready(function () {

        $('#multiselect').multiselect();
        
        //Data table, lista eventos
        $('#list-registros').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['administracion/getmenuporroles']); ?>",
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
<script src="../views/administracion/js/menuporroles.js"></script>