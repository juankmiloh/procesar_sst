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
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "PARAMETRIZAR_ATLETISMO"));
                            ?>
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
                        <h3 class="page-title"><?= Yii::t('app', "CAMPEONATOS") ?></h3>
                        
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <button type="button" class="btn teal-bg btn-block" onclick="cleanModal();" data-toggle='modal' data-target='#modalNuevaRegla'><i class="icon-circle-plus icon-left"></i><?= Yii::t('app', "CREAR_REGLA") ?></button>
                    </div>                                                                                 
                </div>
            </div>

            <!-- Listado -->
            <table id="list-parametros" class="display" cellspacing="0" width="90%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t('app',"PRUEBA") ?></th>
                        <th><?php echo Yii::t('app',"PARAMETRO_1")?></th>
                        <th><?php echo Yii::t('app',"VALOR")?></th>
                        <th><?php echo Yii::t('app',"PARAMETRO_2")?></th>
                        <th><?php echo Yii::t('app',"VALOR")?></th>
                        <th><?php echo Yii::t('app',"ESTADO")?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t('app',"PRUEBA") ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?php echo Yii::t('app',"ESTADO")?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t('app',"PRUEBA") ?></th>
                        <th><?php echo Yii::t('app',"PARAMETRO_1")?></th>
                        <th><?php echo Yii::t('app',"VALOR")?></th>
                        <th><?php echo Yii::t('app',"PARAMETRO_2")?></th>
                        <th><?php echo Yii::t('app',"VALOR")?></th>
                        <th><?php echo Yii::t('app',"ESTADO")?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>            
        </div>
    </div>

    <!-- MODAL NUEVA REGLA -->
    <div class="modal fade" id="modalNuevaRegla" role="dialog" aria-labelledby="modalNuevaRegla">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="titulo-modal" class="modal-title"></h4>
                </div>                
                <div class="modal-body">
                    <div class="form-group">    
                        <p id="msnFormRegla"></p>
                        <form id="formularioGuardarRegla">
                            <input id="idRegla" type="hidden" name="idRegla">
                            <div class="row gutter">
                                <div class="col-md-6 col-xs-12">
                                    <label class="label-control"><?php echo Yii::t('app', "TIPO_PRUEBA")?></label>
                                    <?php
                                        echo Html::dropDownList('tipo_prueb_id','tipo_prueb_id',$tipo_prueba,['prompt'=> Yii::t('app',"SELECCIONE"), 'class' => 'form-control form-edit', 'id'=>'tipo_prueba', 'onchange' => 'mostrarParametros(this.value)']);
                                    ?>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="label-control"><?php echo Yii::t('app', "CATEGORIA")?></label>
                                    <div id="categoria-div">
                                        <?php echo Html::dropDownList('cat_id','cat_id', $categoria, ['prompt'=> Yii::t('app',"SELECCIONE"), 'class'=>'form-control form-edit','id'=>'categoria', 'onchange' => 'filtrarPruebas();']); 
                                        ?>
                                    </div>
                                </div>
                            </div> 
                            <div class="row gutter">
                                <div class="col-md-6 col-xs-12">
                                    <label class="label-control"><?php echo Yii::t('app',"GENERO") ?></label>
                                    <?php echo Html::dropDownList('gen_id','gen_id',$genero, ['prompt'=>Yii::t('app',"SELECCIONE"), 'class'=>'form-control form-edit','id'=>'genero','onchange' => 'filtrarPruebas();']); ?>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="label-control"><?php echo Yii::t('app',"PRUEBA") ?></label>
                                    <?php echo Html::dropDownList('prueb_id','prueb_id', $pruebas, ['prompt'=>Yii::t('app',"SELECCIONE"), 'class' => 'form-control form-edit','id' => 'prueba']) ?>                                    
                                </div>
                            </div><hr>
                            <div class="row gutter">
                                <div class="col-md-6 col-xs-12">
                                    <label id="parametro-1" class="label-control"><?php echo Yii::t('app',"PARAMETRO_1")?></label>
                                    <input id="parametro-1_id" type="hidden" name="parametro-1_id">
                                    <input id="valor-p-1" type="number" name="valor-p-1" style="float: right;width: 50px;" class="form-control" min="1" onclick="verificarSuma(this.id);">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label id="parametro-2" class="label-control"><?php echo Yii::t('app',"PARAMETRO_2")?></label>
                                    <input id="parametro-2_id" type="hidden" name="parametro-2_id">
                                    <input id="valor-p-2" type="number" name="valor-p-2" style="float: right;width: 50px;" class="form-control" min="1" onclick="verificarSuma(this.id);">
                                </div>
                            </div> 
                            <br>
                            <p id="msnFormRegla2"></p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-circle-with-cross icon-left"></i> <?=Yii::t('app', "CERRAR")?></button>
                                <button type="button" class="btn btn-info" onclick="guardarRegla();" id="botonCrear"><i class="icon-save icon-left"></i> <?=Yii::t('app', "GUARDAR")?></button>
                            </div> 
                        </form>                    
                    </div>
                </div>

            </div>            
        </div>
    </div>
    <!--  FIN MODAL NUEVA REGLA -->

    <input id="urlCargarDatosModal" type="hidden" value="<?php echo Url::toRoute(['atletismo/cargardatosregla']);?>">
    <input id="urlFiltrarPruebas" type="hidden" value="<?php echo Url::toRoute(['atletismo/filtrarpruebaparametrizacion']);?>">
    <input id="urlModificarEstado" type="hidden" value="<?php echo Url::toRoute(['atletismo/cambiarestadoparam'])?>">
    <input id='urlParamTipoPrueba' type="hidden" value="<?php echo Url::toRoute(['atletismo/parametrosportipoprueba'])?>">
    <input id="urlGuardarRegla" type="hidden" value="<?php echo Url::toRoute(['atletismo/agregarregla'])?>">
</body>
<script src="../js/validaciones/validaciones.js"></script>
<script src='../views/atletismo/js/parametrizacion_atletismo.js'></script>
<script>

    var NUEVA_REGLA = '<?php echo Yii::t('app',"NUEVA_REGLA")?>';
    var EDITAR_REGLA = '<?php echo Yii::t('app',"EDITAR_REGLA")?>';
    var TIPO_PRUEBA_SEL = '<?php echo Yii::t('app',"TIPO_PRUEBA_SEL")?>';
    var CATEGORIA_SEL = '<?php echo Yii::t('app',"CATEGORIA_SEL")?>';
    var GENERO_SEL = '<?php echo Yii::t('app',"GENERO_SEL")?>';
    var PRUEBA_SEL = '<?php echo Yii::t('app',"PRUEBA_SEL")?>';
    var PARAMETRO_MIN = '<?php echo Yii::t('app',"PARAMETRO_MIN")?>';
    var SUM_PARAMETRIZACION_ATLETISMO = '<?php echo SUM_PARAMETRIZACION_ATLETISMO; ?>';
    var PARAMETRO_SUMA_MAX = '<?php echo Yii::t('app',"PARAMETRO_SUMA_MAX")?>';
    var NUEVA_REGLA_EXITO = '<?php echo Yii::t('app',"NUEVA_REGLA_EXITO")?>';
    var NUEVA_REGLA_EXISTE = '<?php echo Yii::t('app',"NUEVA_REGLA_EXISTE")?>';
    var REGLA_EDITAR_EXITO = '<?php echo Yii::t('app',"REGLA_EDITAR_EXITO")?>';

    $(document).ready(function(){
        var table = $("#list-parametros").DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "ajax": "<?php echo Url::toRoute(['atletismo/dataparametros']); ?>", 
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

        //Contador de columnas
        $.fn.columnCount = function() {  
            return $('th', $(this).find('tfoot')).length;  
        };

        // Filtros por columnas
        var column = 0;
        $('#list-parametros thead tr:eq(1) th').each( function (){
            //No agregue filtro para el registro ID
            if(column > 0 && column < ($('#list-parametros').columnCount() - 1)){ 
                if(column == 1){
                    <?php
                        $html = Html::dropDownList('prueb_id2','prueb_id2', $pruebas, ['prompt'=>Yii::t('app',""), 'class' => "form-control filter", 'id'=>"prueb_id2", 'name'=>"prueb_id2"]);
                        $html = preg_replace( "/\r|\n/", "", $html );
                    ?>
                    $(this).html('<?php echo $html?>');
                    $("#prueb_id2").select2();
                }else if(column == 6){
                    $(this).html("<select class='filter form-control'><option value=''><?php echo Yii::t('app',"TODO")?></option><option value='<?php echo ESTADO_ACTIVO; ?>'><?php echo Yii::t('app',"ACTIVO")?></option><option value='<?php echo ESTADO_INACTIVO; ?>'><?php echo Yii::t('app',"INACTIVO")?></option></select>");                    
                }
            }
            column++;
        });

        // Impide que al dar click sobre estos elementos, se genere el organizador
        $('.filter, .select2').on('click', function(e){
            e.stopPropagation();    
        });

        // Buscar los valores ingresados
        table.columns().every(function (index) {        
            $('#list-parametros thead tr:eq(1) th:eq(' + index + ') select').on('change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value).draw();
            });                                    
        });
    });

</script>