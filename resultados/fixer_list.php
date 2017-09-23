<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
?>  
 <div class="kode-subheader subheader-height">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h1>PROGRAMACION</h1>
            </div>
            <div class="col-md-6">
              <ul class="kode-breadcrumb">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Fixture</a></li>
                <li><a href="#">Todos Los Partidos</a></li>
              </ul>
            </div>
          </div>
        </div>
		
      </div>
      <!--// SubHeader //-->
      
      
      <!--// Main Content //-->
      <div class="kode-content">
          
          <section class="kode-pagesection kode-pagecontent kode-result-list shape-view margin-bottom-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading heading-12 " style="margin-bottom:20px;">
                        <p style="margin-bottom: 10px;font-weight: bold;font-size: 20px;">PROGRAMACIÓN</p>

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
                                        <a class="kode-modren-btn thbg-colortwo" style="margin-top: 26px;" onclick="buscar('')">Buscar</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <div id="paginator"></div>

        </div>
    </section>
          
          

        <!--// Page Content //-->
        <section class="kode-pagesection margin-bottom-40">
          <div class="container">
            <div class="row">
                <div class="kode-pagecontent col-md-12">
                    <div class="kode-section-title"> <h2>PROGRAMACION DE ENCUENTROS</h2> </div>
                  <div class="kode-fixer-list" id="encuentros">
                    
                        
                  </div>
                                
                </div>
                

                <div class="col-md-12">
                  
                </div>

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

      <script src="http://code.jquery.com/jquery-1.9.1.js"></script>  
    <script>
        $(document).ready(function () {
            
            var options = {
                    selectedDateFormat:  'YYYY-MM-DD',
                    textSelected: 'YYYY-MM-DD',
                    onSelectedDateChanged: function(event, date) {
                        var date = new Date(date);
                        var thedate = date.getDate();
                        var themonth = date.getMonth()+1;
                        var theyear = date.getFullYear();
                        var newdate = theyear +"-"+themonth+"-"+thedate;
                            //alert(newdate);
                            buscar(newdate);
                    }
            }
            
           $('#paginator').datepaginator(options);
           
       });
       
       /**
        * Consulta las programaciones 
        * @returns {undefined}
        */
       function buscar(fecha){
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
                        url: "<?php echo Url::toRoute('helper/buscarprogramacion'); ?>",
                        data: {fase : fase, fecha : fecha},
                        success: function (response) {
                            var obj = jQuery.parseJSON( response );
                            var html = $("#encuentros");
                            
                            var temp = '<ul class="table-head thbg-color">';
                            temp += '    <li><h5>Equipos</h5></li>';
							temp += '    <li><h5>Departamentos</h5></li>';
                            temp += '    <li style="width: 5%"><h5>Grupo</h5></li>';
                            temp += '    <li> <h5>Fecha & Hora</h5> </li>';
                            temp += '    <li> <h5>Lugar</h5> </li>';
							temp += '</ul>';

                            for(var i = 0; i < obj.length; i++){
                                temp += '<ul class="table-body">';
                                temp += '    <li>';
                                temp += '      <div>'+obj[i]['n1']+'</div>';
                                temp += '      <span>vs</span>';
                                temp += '      <div>'+obj[i]['n2']+'</div>';
                                temp += '    </li>';
                                temp += '    <li>';								
                                temp += '      <div>ARAUCA</div>';
                                temp += '      <span>/</span>';
                                temp += '      <div>CASANARE</div>';								
								temp += '    </li>';
								temp += '    <li><small>'+obj[i]['fts_grupo']+'</small></li>';
                                temp += '    <li><small>'+obj[i]['tfs_fecha_hora']+'</small></li>';
                                temp += '    <li><small>'+obj[i]['esc_nombre']+'</small></li>';
                                temp += '</ul>';
                            }
                            html.html(temp);
                        }
                });
            }
       }
           
    </script>