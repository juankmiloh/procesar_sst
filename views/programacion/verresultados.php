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

            <div class="left-sidebar">


                <div class="row gutter">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-light">
                            <div class="panel-heading">
                                <h4><?= Yii::t("app", "POS_GRUPO"); ?></h4>
                            </div>

                            <div class="row gutter">
                                <div class="col-md-8 col-sm-6 col-xs-6">
                                    <h3 class="page-title"><?= Yii::t('app', "FASES") . " (" . $campeonato->camp_nombre . ")" ?></h3>
                                    <h4 class="page-title"><?= Yii::t('app', "PROMOCION") . " (" . $promocion->prom_nombre . ")" ?></h4>
                                    <h4><?= Yii::t('app', "EVENTO_LOWWER") . ": " . $campeonato->getEve()->one()->eve_nombre; ?></h4>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <?=
                                    Html::a('<img src="../img/sorteo.png" class="img-responsive" alt="SORTEOS"><h1>' . Yii::t("app", "SORTEO") . "</h1>", ["programacion/sorteo", 'ctf_id' => $fase->ctf_id], array("class" => "block-40 green-bg", "style" => "display: flex;"));
                                    ?>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <?=
                                    Html::a('<img src="../img/enuentros.png" class="img-responsive" alt="SORTEOS"><h1>' . Yii::t("app", "ENCUENTROS") . "</h1>", ["programacion/encuentros", 'ctf_id' => $fase->ctf_id], array("class" => "block-40 yellow-bg", "style" => "display: flex;"));
                                    ?>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <?=
                                    Html::a('<img src="../img/resultados.png" class="img-responsive" alt="RESULTADOS"><h1>' . Yii::t("app", "RESULTADOS") . "</h1>", ["programacion/resultados", 'ctf_id' => $fase->ctf_id], array("class" => "block-40 red-bg", "style" => "display: flex;"));
                                    ?>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                                    <a disabled="disabled" style="display: flex;" class="img-responsive block-40 grey-bg"><img src="../img/medal.png" class="img-responsive " alt="<?= Yii::t("app", "POSICIONES"); ?>"><h1><?= Yii::t("app", "POSICIONES"); ?></h1></a>
                                </div>
                            </div>


                      
                                <div class="panel-group" id="leftSidebar" role="tablist" aria-multiselectable="true">
                                   

                                                        <!-- GRUPOS -->
                                                        <div class="panel panel-light">
                                                            <div class="panel-body" >
                                                                <input id="urlGuardar" type="hidden" value="<?= Url::toRoute(['programacion/publicarresultados', 'ctf_id' => $fase->ctf_id]); ?>">
                                                                <?php
                                                                $j = 0;

                                                                $counter = 0;
                                                                $connection = Yii::$app->getDb();
                                                                $table = 2;
                                                                for (; $j < $totalTablas; $j++) {
                                                                    ?>


                                                                    <div class="panel">
                                                                        <div class="panel-heading" role="tab" id="heading<?= $alphas[$j]; ?>">
                                                                            <h4 class="panel-title" style="height: 50px;">
                                                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse<?= $alphas[$j]; ?>" aria-expanded="false" aria-controls="collapse<?= $alphas[$j]; ?>"><?php echo Yii::t("app", "GRUPO"); ?> <?php echo $alphas[$j]; ?>  <span class="label label-warning"><i class="icon-circle-down"></i></span></a>
                                                                                <div class="toggle" id="switch" title="<?php echo $table; ?>">
                                                                                    <div class='toggle-text-off'><?= Yii::t("app", "PUBLICAR") ?></div>
                                                                                    <div class='glow-comp'></div>
                                                                                    <div class='toggle-button'></div>
                                                                                    <div class='toggle-text-on'><?= Yii::t("app", "PUBLICADO") ?></div>
                                                                                </div>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapse<?= $alphas[$j]; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $alphas[$j]; ?>">

                                                                            <table class="mytable" id="mytable<?php echo $table; ?>">
                                                                                <tbody  class="connectedSortable" id='table<?php echo $table; ?>'>
                                                                                    <tr>
                                                                                        <th class="col-md-5 col-xs-5" style="width: 10px">ID</th>
                                                                                        <th class="col-md-5 col-xs-5" style="width: 20px">DEPARTAMENTO</th>
                                                                                        <th class="col-md-5 col-xs-5">CIUDAD</th>
                                                                                        <th class="col-md-5 col-xs-5">EQUIPOS</th>
                                                                                        <th class="col-md-5 col-xs-5">GRUPO</th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "PJ") ?></th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "PG") ?></th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "PE") ?></th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "PP") ?></th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "GF") ?></th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "GC") ?></th>

                                                                                        <!-- Para futbole se debe agregar la columna diferencia de goles. -->
                                                                                        <?php if ($deporte->dep_id == 13 || $deporte->dep_id == 14 || $deporte->dep_id == 15) { ?>
                                                                                            <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "DIF") ?></th>
                                                                                        <?php } ?>

                                                                                        <th class="col-md-5 col-xs-5" style="width:5px"><?= Yii::t("app", "JL") ?></th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:3px; background-color: #2b408a">PUNTOS</th>
                                                                                        <th class="col-md-5 col-xs-5" style="width:10px">AVANZA</th>
                                                                                    </tr>

                                                                                    <?php
                                                                                    if ($programacion != null) {

                                                                                        for ($gh = 0; $gh < $equiposPorGrupo[$j]; $gh++) {

                                                                                            if (isset($programacion[$j][$gh])) {
                                                                                                $equipo = app\models\Equipo::find()->where('equi_id = ' . $programacion[$j][$gh]['equipo'])->one();

                                                                                                //Partidos ganados
                                                                                                $dql = "SELECT count(*) FROM fase_tiene_encuentros fte WHERE fte.tfs_gan = " . $equipo->equi_id . " and tfs_fecha_hora < now() AND fte.ctf_id = " . $fase->ctf_id;
                                                                                                $PG = $connection->createCommand($dql)->queryScalar();

                                                                                                //Partidos perdidos
                                                                                                $sql = "SELECT count(*) FROM fase_tiene_encuentros fte WHERE"
                                                                                                        . "(fte.equi_id_1 = " . $equipo->equi_id . " or fte.equi_id_2 = " . $equipo->equi_id . ") and tfs_fecha_hora < now() and fte.tfs_gan <> " . $equipo->equi_id . " AND fte.ctf_id = " . $fase->ctf_id;
                                                                                                $PP = $connection->createCommand($sql)->queryScalar();

                                                                                                //Partidos jugados
                                                                                                $sql = "SELECT count(*) FROM fase_tiene_encuentros fte WHERE"
                                                                                                        . " (fte.equi_id_1 = " . $equipo->equi_id . " or fte.equi_id_2 = " . $equipo->equi_id . ") and tfs_fecha_hora < now() AND fte.ctf_id = " . $fase->ctf_id;
                                                                                                $PJ = $connection->createCommand($sql)->queryScalar();

                                                                                                //Partidos empatados
                                                                                                $PE = $PJ - $PG - $PP;

                                                                                                echo "<tr>";
                                                                                                echo "<td>" . $equipo->equi_id . "</td>";
                                                                                                if ($equipo->getEnt()->one() != null && $equipo->getEnt()->one()->getEntDpto()->one() != null) {
                                                                                                    echo "<td>" . $equipo->getEnt()->one()->getEntDpto()->one()->dptos_name . "</td>";
                                                                                                } else {
                                                                                                    echo "<td></td>";
                                                                                                }
                                                                                                if ($equipo->getEnt()->one() != null && $equipo->getEnt()->one()->getEntMunicipio()->one()) {
                                                                                                    echo "<td>" . $equipo->getEnt()->one()->getEntMunicipio()->one()->municipios_name . "</td>";
                                                                                                } else {
                                                                                                    echo "<td></td>";
                                                                                                }
                                                                                                echo "<td>" . $equipo->getEnt()->one()->ent_nombre . "</td>";
                                                                                                echo "<td>" . $alphas[$j] . "</td>";
                                                                                                echo "<td>" . $PJ . "</td>";
                                                                                                echo "<td>" . $PG . "</td>";
                                                                                                echo "<td>" . $PE . "</td>";
                                                                                                echo "<td>" . $PP . "</td>";
                                                                                                echo "<td>" . $programacion[$j][$gh]['gf'] . "</td>";
                                                                                                echo "<td>" . $programacion[$j][$gh]['ge'] . "</td>";

                                                                                                //Columna diferencia de goles, solo para futbol
                                                                                                if ($deporte->dep_id == 13 || $deporte->dep_id == 14 || $deporte->dep_id == 15) {
                                                                                                    echo "<td>" . ($programacion[$j][$gh]['gf'] - $programacion[$j][$gh]['ge']) . "</td>";
                                                                                                }


                                                                                                echo "<td>" . $programacion[$j][$gh]['gl'] . "</td>";
                                                                                                echo '<td style="background-color: #717da7; color:white">' . $programacion[$j][$gh]['pu'] . '</td>';
                                                                                                echo "<td><input type='checkbox' onclick='validarClasificadosGrupo(" . $table . ")' id='check" . $table . "_" . $gh . "'></td>";
                                                                                                echo "</tr>";
                                                                                                $counter++;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <?php $table++;
                                                                }
                                                                ?>
				

                                                </div>
                                            </div>
                                     </div>
                        </div>
                    </div>

                </div>
            </div>






            </body>

            <script src="../views/programacion/js/verresultados.js"></script>
            <script>

                //arreglo para definir cuantos clasificados tenemos por grupo
                var clasificadosPorGrupo = <?php echo $fase->ctf_clasificados_grupo; ?>;
                var MAX_GRUPO = '<?php echo Yii::t("app", "MAX_GRUPO") ?>';
                var VISIBLE_PUBLICO = '<?php echo Yii::t("app", "VISIBLE_PUBLICO") ?>';

                $(document).ready(function () {

                    //Al publicar los resultados
                    $('.toggle').click(function (e) {
                        e.preventDefault(); // The flicker is a codepen thing
                        var id = e.currentTarget.title;
                        if (confirm(VISIBLE_PUBLICO)) {
                            $.LoadingOverlay('show');
                            $(this).toggleClass('toggle-on');

                            //Publicar resultados... 
                            publicarResultados(id);
                        }

                    });
                });
            </script>        

            <style>
                .mytable a:link {
                    color: #fff;
                    font-weight: bold;
                    text-decoration:none;
                }
                .mytable a:visited {
                    color: #fff;
                    font-weight:bold;
                    text-decoration:none;
                }
                table.mytable {
                    width:90%;
                    font-family:Arial, Helvetica, sans-serif;
                    color:#666;
                    margin-left:auto;
                    margin-right:auto;
                    font-size:12px;
                    background:#eaebec;
                    border:#ccc 1px solid;
                    -moz-border-radius:3px;
                    -webkit-border-radius:3px;
                    border-radius:3px;
                    -moz-box-shadow: 10px 10px 5px #888;
                    -webkit-box-shadow: 10px 10px 5px #888;
                    box-shadow: 10px 10px 5px #888;
                }
                .mytable th {
                    color:#fff;
                    padding:21px 25px 22px 25px;
                    border-top:1px solid #fafafa;
                    border-bottom:1px solid #e0e0e0;
                    background:#191970;
                }
                .mytable th:first-child {
                    text-align: center;
                    padding-left:20px;
                }
                .mytable tr {
                    text-align: center;
                    padding-left:20px;
                }
                .mytable tr td:first-child {
                    text-align: center;
                    padding-left:20px;
                    border-left: 0;
                }
                .mytable tr td {
                    padding:6px;
                    border-top: 1px solid #ffffff;
                    border-bottom:1px solid #e0e0e0;
                    border-left: 1px solid #e0e0e0;
                    background: #fafafa;
                    background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafa fa));
                    background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
                }
                .mytable tr.even td {
                    background: #f6f6f6;
                    background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6 f6));
                    background: -moz-linear-gradient(top, #f8f8f8, #f6f6f6);
                }
                .mytable tr:last-child td {
                    border-bottom:0;
                }
                .mytable tr:last-child td:first-child {
                    -moz-border-radius-bottomleft:3px;
                    -webkit-border-bottom-left-radius:3px;
                    border-bottom-left-radius:3px;
                }
                .mytable tr:last-child td:last-child {
                    -moz-border-radius-bottomright:3px;
                    -webkit-border-bottom-right-radius:3px;
                    border-bottom-right-radius:3px;
                }
            </style>
