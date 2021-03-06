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
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "FASES"), ["campeonato/listarfases", 'idCamp' => $fase->camp_id]);
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "PROGRAMACION") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Barra Azul -->
            <div class="top-bar clearfix">
            </div>


            <!-- EMPIEZA EL MENU EN TREE --> 
            <div class="left-sidebar">


                <div class="row gutter">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-light">
                            <div class="panel-heading">
                                <h4><?= Yii::t("app", "ENCUENTROS"); ?></h4>
                                 <!-- Publicar programación -->
                                <div class="toggle" style="left: 10%;" id="switch" title="<?php echo $fase->ctf_id ?>">
                                    <div class='toggle-text-off'><?= Yii::t("app", "PUBLICAR") ?></div>
                                    <div class='glow-comp'></div>
                                    <div class='toggle-button'></div>
                                    <div class='toggle-text-on'><?= Yii::t("app", "PUBLICADO") ?></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="page-title"><?= Yii::t('app', "FASES")." (".$campeonato->camp_nombre.")" ?></h3>
                                <h4 class="page-title"><?= Yii::t('app', "PROMOCION")." (".$promocion->prom_nombre.")" ?></h4>
                                <h4><?= Yii::t('app', "EVENTO_LOWWER").": ".$campeonato->getEve()->one()->eve_nombre; ?></h4>
                            </div>
                            
                            <div class="row gutter">
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <?=
                                    Html::a('<img src="../img/sorteo.png" class="img-responsive" alt="SORTEOS"><h1>' . Yii::t("app", "SORTEO") . "</h1>", ["programacion/sorteo", 'ctf_id' => $fase->ctf_id], array("class" => "block-40 green-bg", "style" => "display: flex;"));
                                    ?>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <a disabled="disabled" style="display: flex;" class="img-responsive block-40 grey-bg"><img src="../img/enuentros.png" class="img-responsive " alt="<?= Yii::t("app", "ENCUENTROS"); ?>"><h1><?= Yii::t("app", "ENCUENTROS"); ?></h1></a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <?=
                                    Html::a('<img src="../img/resultados.png" class="img-responsive" alt="RESULTADOS"><h1>' . Yii::t("app", "RESULTADOS") . "</h1>", ["programacion/resultados", 'ctf_id' => $fase->ctf_id], array("class" => "block-40 red-bg", "style" => "display: flex;"));
                                    ?>
                                </div>
                            </div>
                            
                            
                            <input id="urlGuardar" type="hidden" value="<?= Url::toRoute(['programacion/guardarprogramacion']); ?>">
                            <input id="urlPublicar" type="hidden" value="<?= Url::toRoute(['programacion/publicarprogramacion']); ?>">
                           
                            <div class="panel-group" id="leftSidebar" role="tablist" aria-multiselectable="true">
                            <?php 
                                $fecha = 1;
                                $i = 0;
                                for (; $i < count($encuentros); ) { 
                                    $fecha = $encuentros[$i]->tfs_ronda; ?>
                                
                                
                                <div class="panel">
                                    <div class="panel-heading" role="tab" id="heading<?= $fecha; ?>">
                                        <h4 class="panel-title">
                                            <a style="height: 35px" class="collapsed" role="button" data-toggle="collapse" href="#collapse<?= $fecha; ?>" aria-expanded="false" aria-controls="collapse<?= $fecha; ?>"><?php  echo Yii::t("app", "FECHA")." ".$fecha ?>  <span class="label label-warning"><i class="icon-circle-down"></i></span></a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?= $fecha; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $fecha; ?>">
                                        
                                        <div class="panel-body">
                                                                    <table class="table table-striped success no-margin">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="col-md-2 col-xs-2" style="width: 15px">#</th>
                                                                                <th class="col-md-2 col-xs-2" style="width: 15px"><?= Yii::t("app", "GRUPO") ?></th>
                                                                                <th class="col-md-2 col-xs-2"><?= Yii::t("app", "LOCAL") ?></th>
                                                                                <th class="col-md-2 col-xs-2" style="width: 15px">VS</th>
                                                                                <th class="col-md-2 col-xs-2"><?= Yii::t("app", "VISITANTE") ?></th>
                                                                                <th class="col-md-2 col-xs-2"><?= Yii::t("app", "FECHA") ?></th>
                                                                                <th class="col-md-2 col-xs-2"><?= Yii::t("app", "ESCENARIO") ?></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php while(isset($encuentros[$i]->tfs_ronda) && $fecha == $encuentros[$i]->tfs_ronda ) { ?>
                                                                            <tr>
                                                                                <th scope="row"><?= ($i + 1); ?></th>
                                                                                <th><?= $encuentros[$i]->fts_grupo; ?></th>
                                                                                <td><?= $encuentros[$i]->getEquiId1()->one()->getEnt()->one()->ent_nombre; ?></td>
                                                                                <td>VS</td>
                                                                                <td><?= $encuentros[$i]->getEquiId2()->one()->getEnt()->one()->ent_nombre; ?></td>
                                                                                <td><input type="text" id="datetimepicker<?= $i; ?>" onblur="guardarEncuentro(<?= $encuentros[$i]->fts_id; ?>, this.value, $('#esc_id').val())" value="<?= $encuentros[$i]->tfs_fecha_hora; ?>"></td>
                                                                                <td>
                                                                                    <?php
                                                                                        echo Html::dropDownList($encuentros[$i]->esc_id,$encuentros[$i]->esc_id,$escenarios,['prompt'=>Yii::t("app", "SELECCIONE"), 'class'=>'form-control', 'id' => 'esc_id', "onchange" => "guardarEncuentro(". $encuentros[$i]->fts_id.",$('#datetimepicker". $i."').val(), this.value)"]);
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $i++; } ?>
                                                                        </tbody>
                                                                    </table>
                                                 
                                            
                                            
                                        </div>
                                    </div>        
                                </div>            
                                            
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <!-- FIN EL MENU EN TREE -->

        </div>
    </div>
</body>

<script src="../views/programacion/js/encuentros.js"></script>
<script>
    
    var VISIBLE_PUBLICO2 = '<?php echo Yii::t("app", "VISIBLE_PUBLICO2") ?>'; 
    
    $(document).ready(function () {
        
        //Al publicar los resultados
        $('.toggle').click(function (e) {
            e.preventDefault(); // The flicker is a codepen thing
            var id = e.currentTarget.title;
            if (confirm(VISIBLE_PUBLICO2)) {
                $.LoadingOverlay('show');
                $(this).toggleClass('toggle-on');
                
                //Publicar resultados... 
                publicarEncuentros(id);
            } 
            
        });
        
        for(var j = 0; j < <?= $i ?>; j++){
            var fechaini = new Date("<?php echo $evento->eve_fecha_ini; ?>");
            var fechafin = new Date("<?php echo $evento->eve_fecha_fin; ?>");
            $("#datetimepicker"+j).datetimepicker({
                showSecond:false,
                format:'Y-m-d H:i',
                step: 15,
                minDate: fechaini.setDate(fechaini.getDate() + 1),
                maxDate: fechafin.setDate(fechafin.getDate() + 1),
            });
        }
        
    });

</script>