<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>  
<div class="kode-subheader subheader-height">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>RESULTADOS POR DEPORTE - Fixture</h1>
            </div>
            <div class="col-md-6">
                <ul class="kode-breadcrumb">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Fixture</a></li>
                    <li><a href="#">Resultado por Deporte</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--// SubHeader //-->

<!--// Main Content //-->
<div class="kode-content">

    <!--// Page Content //-->
    <section class="kode-pagesection kode-pagecontent kode-result-list shape-view margin-bottom-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading heading-12 margin-top10-bottom-80" style="margin-bottom:80px;">
                        <p style="margin-bottom: 40px;font-weight: bold;font-size: 20px;">TABLA DE POSICIONES</p>

                        <section class="pick-event padding-30-topbottom margin-top-minus-40">
                            <div class="container">

                                <div class="form">
                                    
                                    <div class="cover">
                                        <label>Evento:</label>
                                        <?php
                                        echo Html::dropDownList('eve_id', 'eve_id', $eventos, [ 'prompt' => "SELECCIONE",
                                            'class' => "form-control",
                                            'id' => 'eve_id',
                                            'style' => 'width: 280px',
                                            'onchange' => '
                                                $("#ctf_id").html("");
                                                $.ajax({
                                                        url: "' . Url::toRoute('helper/getcampeonatos') . '",
                                                        data: {id : $("#eve_id").val()},
                                                        success: function (response) {
                                                            $("#camp_id").html(response);
                                                        },
                                                })',
                                        ]);
                                        ?>
                                    </div>
                                    
                                    <div class="cover">
                                        <label>Campeonato</label>
                                        <?php
                                        $items = array();
                                        echo Html::dropDownList('camp_id', 'camp_id', $items, [ 'prompt' => 'Seleccione',
                                            'class' => "form-control",
                                            'style' => 'width: 280px',
                                            'id' => 'camp_id',
                                            'onchange' => '
                                                $.ajax({
                                                        url: "' . Url::toRoute('helper/getfases') . '",
                                                        data: {id : $("#camp_id").val()},
                                                        success: function (response) {
                                                            $("#ctf_id").html(response);
                                                        },
                                                })'
                                        ]);
                                        ?>
                                    </div>
                                    
                                    <div class="cover">
                                        <label>Fase</label>
                                        <?php
                                        $items = array();
                                        echo Html::dropDownList('ctf_id', 'ctf_id', $items, [ 'prompt' => 'Seleccione',
                                            'class' => "form-control",
                                            'style' => 'width: 280px',
                                            'id' => 'ctf_id'
                                        ]);
                                        ?>
                                    </div>

                                    <div class="cover">
                                        <a class="kode-modren-btn thbg-colortwo" style="margin-top: 26px;" onclick="buscar()">Buscar</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            
            <!-- Tabla de posiciones -->
            <div class="col-md-12" id="posiciones">
            </div>
            
        </div>
    </section>
    <!--// Page Content //-->

</div>
<!--// Main Content //-->

<!--// NewsLatter //-->
<div class="kode-newslatter kode-bg-color">
    <span class="kode-halfbg thbg-color"></span>
    <div class="container">
        <div class="row">

        </div>
    </div>
</div>
<!--// NewsLatter //-->


<script>
    
    /**
     * Consulta los resultados acorde a los filtros. 
     * @returns {undefined}
     */
    function buscar(){
        
        var evento = $("#eve_id").val();
        var campeonato = $("#camp_id").val();
        var fase = $("#ctf_id").val();
        
        if(evento == "" || evento == undefined){
            alert("Seleccione un evento");
        } else if(campeonato == "" || campeonato == undefined){
            alert("Seleccione un campeonato");
        } else if(fase == "" || fase == undefined){
            alert("Seleccione una fase");
        } 
        
        
        else {
        
            $.ajax({
                    url: "<?php echo Url::toRoute('helper/buscarposiciones'); ?>",
                    data: {fase : fase},
                    success: function (response) {
                        var posiciones = jQuery.parseJSON( response );
                        
                        var final = false;
                        
                        if(posiciones.length == 2){
                            final = true;
                        }
                        
                        var temps = "";
                        var grupo = "";
                        temps += '<table class="mytable">';
                        temps += '        <tbody  class="connectedSortable">';
                        temps += '            <tr>';
                        temps += '                <th>Dpto</th>';
                        temps += '                <th>Entidad</th>';
                        temps += '                <th>PJ</th>';
                        temps += '                <th>PG</th>';
                        temps += '                <th>PE</th>';
                        temps += '                <th>PP</th>';
                        temps += '                <th>GF</th>';
                        temps += '                <th>GC</th>';
                        temps += '                <th>DIF</th>';
                        temps += '                <th>JL</th>';
                        temps += '                <th>PU</th>';
                        temps += '                <th>AVANZA</th>';
                        temps += '            </tr>';
                        
                        
                        
//                        if(posiciones.length > 0 && posiciones[0]['ctf_archivo_resultado'] != null){
//                            $("#urlArchivo").attr("href", urlFile + "&ctf="+ $("#ctf_id").val())
//                            $('#urlArchivo').css('display','block');
//                        } else {
//                            $('#urlArchivo').css('display','none');
//                        }
                        
                        for(var i = 0; i < posiciones.length; i++){
                            if(grupo != posiciones[i]['ftr_grupo'] && !final){
                                temps += '<tr style="border-style: solid; border-bottom-color: #1e2abd; border-top-color: #1e2abd;">\n\
                                            <td colspan=12>GRUPO '+posiciones[i]['ftr_grupo']+'</td>\n\
                                        <tr>';
                                grupo = posiciones[i]['ftr_grupo'];
                            }
                            temps += '<tr>';
                            temps += '<td>'+posiciones[i]['dptos_name']+'</td>';
                            temps += '<td>'+posiciones[i]['ent_nombre']+'</td>';
                            temps += '<td>'+( parseInt(posiciones[i]['ftr_partidos_ganados'])+ parseInt(posiciones[i]['ftr_partidos_perdidos'])+ parseInt(posiciones[i]['ftr_partidos_emptados']))+'</td>';
                            temps += '<td>'+posiciones[i]['ftr_partidos_ganados']+'</td>';
                            temps += '<td>'+posiciones[i]['ftr_partidos_emptados']+'</td>';
                            temps += '<td>'+posiciones[i]['ftr_partidos_perdidos']+'</td>';
                            temps += '<td>'+posiciones[i]['ftr_goles_favor']+'</td>';
                            temps += '<td>'+posiciones[i]['ftr_goles_encontra']+'</td>';
                            temps += '<td>'+ (parseInt(posiciones[i]['ftr_goles_favor']) - (posiciones[i]['ftr_goles_encontra'])) +'</td>';
                            temps += '<td>'+posiciones[i]['ftr_juego_limpio']+'</td>';
                            temps += '<td style="width:3px; background-color: white">'+posiciones[i]['ftr_puntos']+'</td>';
                            if(posiciones[i]['ftr_clasifica'] == 1){
                                  temps += '<td><img src="../views/resultados/images/ok.png"></td>';
                            } else {
                                  temps += '<td></td>';
                            }
                            temps += '</tr>';  
                        }
                        temps += '       </tbody>';
                        temps += '    </table>';
                        $("#posiciones").html(temps);
                    }
            });
        }
    }
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
    }
    .mytable tr {
        text-align: center;
    }
    .mytable tr td:first-child {
        text-align: center;
        border-left: 0;
    }
    .mytable tr td {
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