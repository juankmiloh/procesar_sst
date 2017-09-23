<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "FOTOS") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Barra Azul -->
            <div class="top-bar clearfix">
            </div>

            <br>
            <h3>Cargue de archivos (FOTOS)</h3>
            <div class="form-group">
                <div class="row gutter">

                    <div class="col-md-12">
                        <label class="control-label"><?= Yii::t('app', "EVENTO") ?></label>
                        <?php
                            echo Html::dropDownList('eve_id2','eve_id2',$eventos,['prompt'=>Yii::t("app", "SELECCIONE"), 'style' => 'width: 100%', "class"=>"form-control", 'id' => 'eve_id2', 'tabindex' => 1]);
                        ?>
                    </div>

                </div>

            </div>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => "dropzone", "id"=>'MyDropzone']]) ?>
                <input id="eve_id" name="eve_id" type="hidden">
            <?php ActiveForm::end() ?>
            
            <input id="urlDelete" type="hidden" value="<?= Url::toRoute(['contenido/deletefoto']); ?>">
            
            <!-- Listado -->
            <table id="list-datos" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "RUTA"); ?></th>
                        <th><?php echo Yii::t("app", "FOTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA"); ?></th>
                        <th></th>
                    </tr>
              
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t("app", "RUTA"); ?></th>
                        <th><?php echo Yii::t("app", "FOTO"); ?></th>
                        <th><?php echo Yii::t("app", "FECHA"); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        
        var table = $('#list-datos').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "dom": 'lrtip', //Esconde el campo de busqueda
            "ajax": "<?php echo Url::toRoute(['contenido/data']); ?>",
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

        Dropzone.options.MyDropzone = {
            //maxFilesize: 10,
            dictDefaultMessage: "Arrastre archivos aqui",
            init: function () {
                myDropzone = this;
                this.on("addedfile", function(file) {
                    var evento = $("#eve_id2").val();
                    if(evento != "") {
                        $("#eve_id").val(evento);
                    } else {
                        // don't add file 
                        alert("Debe seleccionar un evento");
                        myDropzone.removeFile(file);
                    }
                });
                this.on("success", function(file, responseText) {
                    var obj = jQuery.parseJSON( responseText );
                    var error = obj['error'];
                    if(error != undefined && error != ""){
                        alert(error); // console should show the ID you pointed to
                    } else {
                        $('#list-datos').DataTable().ajax.reload();
                    }
                });
            }

        };
    });
</script>
<script src="../views/contenido/js/contenido.js"></script>
