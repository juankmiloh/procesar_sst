<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<script src="../js/ckeditor/ckeditor.js"></script>
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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "LOGOS") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "LOGOS") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_LOGO") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <input id="urlEditData" type="hidden" value="<?= Url::toRoute(['contenido/editarlogo']); ?>">

            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "FOTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA"); ?></th>
                        <th><?php echo Yii::t("app", "AUTOR"); ?></th>
                        <th><?php echo Yii::t("app", "EVENTO"); ?></th>
                        <th></th>
                        <th></th>
                    </tr>

                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "FOTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA"); ?></th>
                        <th><?php echo Yii::t("app", "AUTOR"); ?></th>
                        <th><?php echo Yii::t("app", "EVENTO"); ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
            
            <!-- Modal -->
            <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm3">
                <div class="modal-dialog" role="document" style="margin: 10px 5%; width: 90%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title"><?php echo Yii::t("app", "CREAR_LOGO"); ?></h4>
                        </div>
                        <div class="modal-body">

                            <!-- Mensaje de resultados -->
                            <p id="msn"></p> 

                            <form id="formulario">
                                <input id="idRegistro" name="idRegistro" type="hidden" value="">

                                <div class="form-group">
                                    <div class="row gutter">
                                        
                                        <div class="col-md-12">
                                            <label class="control-label"><?= Yii::t('app', "EVENTO") ?></label>
                                            <?php
                                                echo Html::dropDownList('eve_id','eve_id',$eventos,['prompt'=>Yii::t("app", "SELECCIONE"), 'style' => 'width: 100%', "class"=>"form-control", 'id' => 'eve_id', 'tabindex' => 1]);
                                            ?>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label class="control-label"><?= Yii::t('app', "FOTO") ?></label>
                                            <input type="file" id="logo_foto_ruta" name="logo_foto_ruta" class="form-control"> 
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


        </div>
    </div>
</body>


<script type="text/javascript">
    
    var SEL_VAL =  '<?php echo Yii::t("app", "SEL_VAL") ?>'; 
    var ARCHIVO_IMG =  '<?php echo Yii::t("app", "ARCHIVO_IMG") ?>'; 
    var REGISTRO_EXITO =  '<?php echo Yii::t("app", "REGISTRO_EXITO") ?>'; 
    var ENLACE_EXITO_EDICION =  '<?php echo Yii::t("app", "ENLACE_EXITO_EDICION") ?>'; 
    var ERROR =  '<?php echo Yii::t("app", "ERROR") ?>'; 
    
    $(document).ready(function () {
        
        var table = $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[0, "desc"]],
            "dom": 'lrtip', //Esconde el campo de busqueda
            "ajax": "<?php echo Url::toRoute(['contenido/datalogos']); ?>",
            "language": {
                "lengthMenu": "<?php echo Yii::t("app", "DISPLAY_RESULT") ?>",
                "zeroRecords": "<?php echo Yii::t("app", "NO_RESULT") ?>",
                "info": "<?php echo Yii::t("app", "RES_PAG") ?>",
                "infoEmpty": "<?php echo Yii::t("app", "NO_RESULT_SEARCH") ?>",
                "infoFiltered": "<?php echo Yii::t("app", "FILTER_RESULT") ?>",
                "loadingRecords": "<?php echo Yii::t("app", "CARGANDO") ?>",
                "processing": "<?php echo Yii::t("app", "PROCESANDO") ?>.",
                "search": "<?php echo Yii::t("app", "BUSCAR") ?>",
                "zeroRecords":    "<?php echo Yii::t("app", "NO_RESULT_SEARCH") ?>",
                        "paginate": {
                            "first": "<?php echo Yii::t("app", "PRIMERO") ?>",
                            "last": "<?php echo Yii::t("app", "ULTIMO") ?>",
                            "next": "<?php echo Yii::t("app", "SIGUIENTE") ?>",
                            "previous": "<?php echo Yii::t("app", "ANTERIOR") ?>"
                        },
            }
        });


    });
</script>
<script src="../views/contenido/js/logo.js"></script>
