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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "MENUS") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "MENUS") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modal-registro"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_MENU") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-registros" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "NOMBRE"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
        </div>
    </div>
    
    <!-- URLS, se deben personalizar para cada form -->
    <input id="urlCrear" type="hidden" value="<?= Url::toRoute(['administracion/crearmenu']); ?>">
    <input id="urlEditar" type="hidden" value="<?= Url::toRoute(['administracion/datosmenu']); ?>">
    
    <div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="modal-registro">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?=Yii::t('app', "CREAR_MENU")?></h4>
                </div>
                <div class="modal-body">
                    <p id="msnResultado"></p> 
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                                        <div class="form-group">
                                                <div class="row gutter">
                                                        <div class="col-md-6">
                                                                <label class="control-label"><?=Yii::t('app', "NOMBRE")?></label>
                                                                <input type="url" id="nombre_menu" class="form-control" name="nombre_menu" onkeypress="soloLetras(event);">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row gutter">
                                                                
                                                                <label class="control-label"><?= Yii::t('app', "ESTADO") ?></label>
                                                                <?php
                                                                    echo Html::dropDownList('estado', 'estado', array(ESTADO_ACTIVO => Yii::t('app', "ACTIVO"), ESTADO_INACTIVO => Yii::t('app', "INACTIVO")), [ 'class' => 'form-control', 'id' => 'estado']);
                                                                ?>

                                                            </div>

                                                        </div>
                                                    
                                                        <div class="col-md-12">

                                                                <label class="control-label"><?=Yii::t('app', "DESCRIPCION")?></label>
                                                                <textarea class="form-control" id="detalle_menu" name="detalle_menu"></textarea>

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
    
    var MAX_LENGHT_MENU_NOMBRE = '<?php echo Yii::t("app", "MAX_LENGHT_MENU_NOMBRE") ?>';
    var MIN_LENGHT_MENU_NOMBRE = '<?php echo Yii::t("app", "MIN_LENGHT_MENU_NOMBRE") ?>';
    var MENU_EXITO = '<?php echo Yii::t("app", "MENU_EXITO") ?>'; 
    var MENU_EXITO_EDICION = '<?php echo Yii::t("app", "MENU_EXITO_EDICION") ?>';
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>'; 
    
    $(document).ready(function () {

        $('#multiselect').multiselect();
        
        //Data table, lista eventos
        $('#list-registros').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['administracion/getmenu']); ?>",
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
<script src="../views/administracion/js/menu.js"></script>