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
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "EVENTOs_LOWWER"), array("evento/listar"));
                            ?>
                        </li>
                        <li class="active">
                             <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "SEDES") ?></a>
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
                        <h3 class="page-title"><?= Yii::t('app', "SEDES") ?></h3>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <ul class="tasks pull-right clearfix">
                            <button type="button" class="btn teal-bg btn-block" onclick="cleanForm()" data-toggle="modal" data-target="#modalForm"><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_SEDE") ?></button>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "SEDE"); ?></th>
                        <th><?php echo Yii::t("app", "DEPARTAMENTO"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
                        <th><?php echo Yii::t("app", "ESTADO"); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "SEDE"); ?></th>
                        <th><?php echo Yii::t("app", "DEPARTAMENTO"); ?></th>
                        <th><?php echo Yii::t("app", "CIUDAD"); ?></th>
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
    <input id="urlEditData" type="hidden" value="<?= Url::toRoute(['sede/editar']); ?>">
    
    <div class="modal fade" id="modalForm" role="dialog" aria-labelledby="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?= Yii::t('app', "CREAR_SEDE"); ?></h4>
                </div>
                <div class="modal-body">
                    <p id="msn"></p> 
                    <form id="formulario">
                        <input id="idRegistro" name="idRegistro" type="hidden" value="0">
                        <div class="form-group">
                            <div class="row gutter">
                                
                                <div class="col-md-6">
                                    <label class="control-label"><?= Yii::t('app', "NOMBRE") ?></label>
                                    <input type="text" class="form-control" id="sede_nombre" name="sede_nombre" onkeypress="soloAlfanumerico(event);">

                                    <label class="control-label"><?= Yii::t('app', "DEPARTAMENTO") ?></label><br>
                                    <?php
                                        $items = ArrayHelper::map(\app\models\Departamentos::find()->all(), 'dptos_id', 'dptos_name');
                                        echo Html::dropDownList('dpto_id', 'dpto_id', $items, 
                                                [   'prompt' => Yii::t('app', "SELECCIONE"), 
                                                    'style' => 'width: 375px', 
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
                                
                                <div class="col-md-6">
                                    
                                    <label class="control-label"><?= Yii::t('app', "ESTADO") ?></label>
                                    <?php
                                        echo Html::dropDownList('sede_estado', 'sede_estado', array(ESTADO_ACTIVO => Yii::t('app', "ACTIVO"), ESTADO_INACTIVO => Yii::t('app', "INACTIVO")), [ 'class' => 'form-control', 'id' => 'sede_estado', "style" => "margin-bottom: 20px;" ]);
                                    ?>
                                    <label class="control-label"><?= Yii::t('app', "CIUDAD") ?></label>
                                    <?php
                                        $items = array();
                                        echo Html::dropDownList('muni_id', 'muni_id', $items, 
                                                [   'prompt' => 'Seleccione', 
                                                    'style' => 'width: 375px', 
                                                    'id' => 'muni_id'
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
    var SEDE_NAME = '<?php echo Yii::t("app", "SEDE_NAME") ?>'; 
    var DPTO_SEL = '<?php echo Yii::t("app", "DPTO_SEL") ?>'; 
    var MUNI_SEL = '<?php echo Yii::t("app", "MUNI_SEL") ?>'; 
    var SEDE_NAME_MIN = '<?php echo Yii::t("app", "SEDE_NAME_MIN") ?>'; 
    var SEDE_NAME_MAX = '<?php echo Yii::t("app", "SEDE_NAME_MAX") ?>';  
    var SEDE_EXITO = '<?php echo Yii::t("app", "SEDE_EXITO") ?>';  
    var SEDE_EXITO_EDIT = '<?php echo Yii::t("app", "SEDE_EXITO_EDIT") ?>';  
    
    $(document).ready(function () {

//        //Data table, lista eventos
        $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['sede/data']); ?>",
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
        * Lista de departamentos con campo de busqueda
         */
        $('#dpto_id').select2();
        $('#muni_id').select2();

    });
    
</script>
<script src="../views/sede/js/sede.js"></script>