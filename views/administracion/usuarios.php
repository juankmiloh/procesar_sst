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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "USUARIOS") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "USUARIOS") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modal-registro"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_USUARIO") ?></button>
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
                        <th><?php echo Yii::t("app", "APELLIDOS"); ?></th>
                        <th><?php echo Yii::t("app", "DOCUMENTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_REGISTRO"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "NOMBRES"); ?></th>
                        <th><?php echo Yii::t("app", "APELLIDOS"); ?></th>
                        <th><?php echo Yii::t("app", "DOCUMENTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA_REGISTRO"); ?></th>
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
    <input id="urlCrear" type="hidden" value="<?= Url::toRoute(['administracion/crearusuario']); ?>">
    <input id="urlEditar" type="hidden" value="<?= Url::toRoute(['administracion/datosusuario']); ?>">

    <div class="modal fade" id="modal-registro" tabindex="-1" role="dialog" aria-labelledby="modal-registro">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?= Yii::t('app', "CREAR_USUARIO") ?></h4>
                </div>
                <div class="modal-body">
                    <p id="msnResultado"></p> 
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                        <div class="form-group">
                            <div class="row gutter">
                                <div class="col-md-6">
                                    <label class="control-label"><?= Yii::t('app', "NOMBRE") ?></label>
                                    <input tabindex="1" type="url" id="nombre_usuario" class="form-control" name="nombre_usuario" onkeypress="soloLetras(event);">


                                    <label class="control-label"><?= Yii::t('app', "TIPO_DOCUMENTO") ?></label>
                                    <?php
                                        $items = ArrayHelper::map(\app\models\TipoDocumento::find()->all(), 'tid_id', 'tid_nombre');
                                        echo Html::dropDownList('tipo_doc', 'tipo_doc', $items, ['prompt' => Yii::t('app', "SELECCIONE"), 'class' => 'form-control',  'tabindex'=>"3", 'id' => 'tipo_doc', 'name' => 'tipo_doc']);
                                    ?>

                                    <label class="control-label"><?= Yii::t('app', "EMAIL") ?></label>
                                    <input tabindex="5" type="url" id="correo" class="form-control" name="correo" onblur="this.value = validateEmail(this.value);">

<!--                                                                <label class="control-label"><?= Yii::t('app', "DPTO") ?></label>
                                                                <select class="form-control" name="Departamento">
                                                                        <option value="Departamento 1">Departamento 1
                                                                </select>

                                                                <label class="control-label"><?= Yii::t('app', "NACIMIENTO") ?></label>
                                                                <input type="text" class="form-control"  id="nacimiento" name="nacimiento" class="datepicker" placeholder="dd/mm/aaaa"/> -->


                                </div>
                                <div class="col-md-6">
                                    <div class="row gutter">

                                        <label class="control-label"><?= Yii::t('app', "APELLIDOS") ?></label>
                                        <input tabindex="2" type="url" id="apellido_usuario" class="form-control" name="apellido_usuario" onkeypress="soloLetras(event);">

                                        <label class="control-label"><?= Yii::t('app', "DOCUMENTO") ?></label>
                                        <input tabindex="4" type="url" id="documento_usuario" class="form-control" name="documento_usuario" onkeypress="soloAlfanumerico(event);">

                                        <label class="control-label"><?= Yii::t('app', "ESTADO") ?></label>
                                        <?php
                                            echo Html::dropDownList('estado', 'estado', array(ESTADO_ACTIVO => Yii::t('app', "ACTIVO"), ESTADO_INACTIVO => Yii::t('app', "INACTIVO")), [ 'class' => 'form-control', "tabindex"=>"6", 'id' => 'estado']);
                                        ?>

                                        <!--                                                                        <label class="control-label">Ciudad</label>
                                                                                                                <select class="form-control" name="Ciudad">
                                                                                                                        <option value="Ciudad 1">Ciudad 1
                                                                                                                </select>-->

                                    </div>

                                </div>
                            </div>
                            <div class="row gutter">

                                <div class="row style-select">
                                    <div class="col-xs-5">
                                        <label class="control-label"><?= Yii::t('app', "ROLES") ?></label>
                                        <?php
                                            $items = ArrayHelper::map(\app\models\Rol::find()->all(), 'rol_id', 'rol_nombre');
                                            echo Html::dropDownList('multiselect', 'multiselect', $items, ['class' => 'form-control', 'multiple' => "multiple", "tabindex" => "7", 'id' => 'multiselect']);
                                        ?>
                                    </div>
                                    <div class="col-xs-2">
                                        <label class="control-label"><?= Yii::t('app', "OPCIONES") ?></label>
                                        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                    </div>
                                    <div class="col-xs-5">
                                        <label class="control-label"><?= Yii::t('app', "ROL_ASIGNADOS") ?></label>
                                        <select name="roles[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutter">
                                <div class="col-md-6">
                                    <label class="control-label"><?= Yii::t('app', "PASSWORD") ?></label>
                                    <input tabindex="8" type="password" id="pass1_usuario" name="pass1_usuario" class="form-control" name="website">


                                </div>
                                <div class="col-md-6">
                                    <label class="control-label"><?= Yii::t('app', "PASSWORD2") ?></label>
                                    <input tabindex="9" type="password" id="pass2_usuario" name="pass2_usuario" class="form-control" name="website">
                                </div>
                            </div>
                            <!--                                                <div class="row gutter">
                                                                                    <div class="form-group">
                                                                                            <div class="col-md-6">
                                                                                                    <label for="message-texta" class="control-label">Avatar de usuario:</label>
                                                                                                    <input type="file" name="fileupload" value="fileupload" id="fileupload">
                                                                                            </div>
                                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                                    <div class="panel-no-padding pink-bg center-text">
                                                                                                            <a class="user-profile block-195">
                                                                                                                    <img src="../img/gold-medal.png" class="profile-thumb" alt="AVATAR DEL USUARIO">
                                                                                                            </a>
                                                                                                    </div>
                                                                                            </div>
                                                                                    </div>
                                                                            </div>	-->
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

    var MAX_LENGHT_USU_NOMBRE = '<?php echo Yii::t("app", "MAX_LENGHT_USU_NOMBRE") ?>';
    var MIN_LENGHT_USU_NOMBRE = '<?php echo Yii::t("app", "MIN_LENGHT_USU_NOMBRE") ?>';
    var MAX_LENGHT_USU_APELLIDO = '<?php echo Yii::t("app", "MAX_LENGHT_USU_APELLIDO") ?>';
    var MIN_LENGHT_USU_APELLIDO = '<?php echo Yii::t("app", "MIN_LENGHT_USU_APELLIDO") ?>';
    var TIPO_DOC_USU = '<?php echo Yii::t("app", "TIPO_DOC_USU") ?>';
    var MAX_LENGHT_DOC_USU = '<?php echo Yii::t("app", "MAX_LENGHT_DOC_USU") ?>';
    var MIN_LENGHT_DOC_USU = '<?php echo Yii::t("app", "MIN_LENGHT_DOC_USU") ?>';
    var ROLES_USU = '<?php echo Yii::t("app", "ROLES_USU") ?>';
    var CONTRASENA2 = '<?php echo Yii::t("app", "CONTRASENA2") ?>';
    var CONTRASENA = '<?php echo Yii::t("app", "CONTRASENA") ?>';
    var CONTRASENA_CONFI = '<?php echo Yii::t("app", "CONTRASENA_CONFI") ?>';
    var USU_EXITO = '<?php echo Yii::t("app", "USU_EXITO") ?>';
    var USU_EXITO_EDICION = '<?php echo Yii::t("app", "USU_EXITO_EDICION") ?>';
    var ERROR = '<?php echo Yii::t("app", "ERROR") ?>';

    $(document).ready(function () {

        $('#multiselect').multiselect();

        //Data table, lista eventos
        $('#list-registros').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[0, "desc"]],
            "ajax": "<?php echo Url::toRoute(['administracion/getusuarios']); ?>",
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
<script src="../views/administracion/js/administracion.js"></script>