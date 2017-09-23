<?php
namespace app\controllers;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\helpers\datatables;
use yii\helpers\ArrayHelper;
use Yii;
use app\models\DeportistaTieneNumero;

/**
* Controlador para el módulo de Atletismo
*/
class AtletismoController extends Controller{

    public $dpto;
	
	public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['data','datafases','listar','listarfases','datadeportistas','asignarnumero','limpiarrnumero','listmunicipios','parametrizar','dataparametros','cargardatosregla','filtrarpruebaparametrizacion','cambiarestadoparam','parametrosportipoprueba','agregarregla','generarreporte'], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    $user = "NO AUTH USER";
                    if (Yii::$app->user->identity != null) {
                        $user = Yii::$app->user->identity->usu_num_doc;
                    }
                    throw new \Exception('User ' . $user . ', not allowed to access controller: "' . $action->controller->id . '", action: ' . $action->actionMethod);
                }  
            ],            
        ];
    }    

    public $enableCsrfValidation = false;

    /**
     * Retorna lista con los registros de los campeonatos asociados a Atletismo. 
     */
    public function actionData(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'camp_id', 'dt' => 0),
            array( 'db' => 'eve_id', 'dt' => 1 ,
                    'formatter' => function( $d, $row ) {
                            return \app\models\Evento::find()->where('eve_id = '.$d)->one()->eve_nombre;
                    }
                ),
            array( 'db' => 'camp_nombre', 'dt' => 2 ),
            array( 'db' => 'cat_id', 'dt' => 3,
                    'formatter' => function( $d, $row ) {
                            return \app\models\Categoria::find()->where('cat_id = '.$d)->one()->cat_nombre;
                    }
                ),
            array( 'db' => 'tipo_deporte_id', 'dt' => 4,
                'formatter' => function( $d, $row ) {
                        return \app\models\TipoDeporte::find()->where('td_id = '.$d)->one()->td_nombre;
                }
            ),
            array( 'db' => 'dep_id', 'dt' => 5,
                'formatter' => function( $d, $row ) {
                        return \app\models\Deporte::find()->where('dep_id = '.$d)->one()->dep_nombre;
                }
            ),
            array( 'db' => 'genero_id', 'dt' => 6,
                'formatter' => function( $d, $row ) {
                        return \app\models\Genero::find()->where('gen_id = '. $d)->one()->gen_nombre;
                }
            ),
            array( 'db' => 'prueb_id', 'dt' => 7,
                'formatter' => function( $d, $row ) {
                        return \app\models\Prueba::find()->where('prueb_id = '. $d)->one()->prueb_nombre;
                }
            ),
            array( 'db' => 'camp_id', 'dt' => 8 , 
                'formatter' => function( $d, $row ) {
                        $r = 0;
                        $total = \app\models\FaseTieneEncuentros::find()
                            ->leftJoin('campeonato_tiene_fases ctf', 'fase_tiene_encuentros.ctf_id = ctf.ctf_id')
                            ->where('ctf.camp_id = '.$d)->count();
                        if($total != 0){
                            $avance = \app\models\FaseTieneEncuentros::find()
                            ->leftJoin('campeonato_tiene_fases ctf', 'fase_tiene_encuentros.ctf_id = ctf.ctf_id')
                            ->where('ctf.camp_id = '.$d." and tfs_fecha_hora is not NULL and esc_id is not null")->count();
                            $r = round(($avance/$total)*100);
                        }
                        $url = '<div id="'.$row['camp_id'].'bluecircle" data-percent="'.$r.'" class="small"></div>';
                        return $url;
                }
            ),
            array( 'db' => 'camp_id', 'dt' => 9,
                'formatter' => function( $d, $row ) {
                        if($row['camp_estado'] == ESTADO_ACTIVO){
                            return '<button class="btn btn-danger" onclick="listarFases('.$row['camp_id'].')">'.Yii::t('app',"FASES").'</button>';
                        } else {
                            return "";
                        }
                }
            ),
            array( 'db' => 'camp_estado', 'dt' => 10, 
                'formatter' => function( $d, $row ) {
                    if($d == ESTADO_ACTIVO){
                        return '<button class="btn btn-success" onclick="cambiarEstado('.$row['camp_id'].','.ESTADO_INACTIVO.')">'.Yii::t('app',"ACTIVO").'</button>';
                    }else{
                        return '<button class="btn btn-warning" onclick="cambiarEstado('.$row['camp_id'].','.ESTADO_ACTIVO.')">'.Yii::t('app',"INACTIVO").'</button>';
                    }
                }
            ),
        );
        
        //Indice
        $primaryKey = "camp_id";
        
        //Tabla
        $table = "campeonato";
        
        
        if(isset($_GET['idDeporte'])){
            //Filtramos para que solo traiga las fases del campeonato indicado
            $_GET['columns'][5]['search']['value'] = $_GET['idDeporte'];
        }
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
    }

    /**
     * Retorna lista con las fases de cada campeonato. 
     */
    public function actionDatafases(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'ctf_id', 'dt' => 0 ),
            array( 'db' => 'camp_id', 'dt' => 1 ,
                    'formatter' => function( $d, $row ) {
                            return \app\models\Campeonato::find()->where('camp_id = '.$d)->one()->camp_nombre;
                    }
                ),
            array( 'db' => 'ctf_nombre', 'dt' => 2), 
            array( 'db' => 'ctf_tipo_eliminacion', 'dt' => 3, 
                    'formatter' => function( $d, $row ) {
                            $tiposElim = unserialize(TIPO_ELIMINACION);
                            return $tiposElim[$d];
                    }
                ),
            array( 'db' => 'ctf_ida_vuelta', 'dt' => 4 , 
                    'formatter' => function( $d, $row ) {
                            $tipos = unserialize(IDA_VUELTA);
                            return $tipos[$d];
                    }
                ),
            array( 'db' => 'ctf_id', 'dt' => 5 , 
                    'formatter' => function( $d, $row ) {
                            $r = 0;
                            $total = \app\models\FaseTieneEncuentros::find()
                                ->where('ctf_id = '.$d)->count();
                            if($total != 0){
                                $avance = \app\models\FaseTieneEncuentros::find()
                                    ->where('ctf_id = '.$d.' and tfs_fecha_hora is not NULL and esc_id is not null')->count();
                                $r = round(($avance/$total)*100);
                            }                    
                            $url = '<div id="'.$row['ctf_id'].'bluecircle" data-percent="'.$r.'" class="small"></div>';
                            return $url;
                    }
                ),
            array( 'db' => 'ctf_ida_vuelta', 'dt' => 6 , 
                    'formatter' => function( $d, $row ) {
                            $url = "window.location.href = '".Url::to(['programacion/sorteo', 'ctf_id' => $row['ctf_id']])."'";
                            return '<button class="btn btn-warning" onclick="'.$url.'">'.Yii::t('app',"PROGRAMACION").'</button>';
                    }
                ),
            array( 'db' => 'ctf_ida_vuelta', 'dt' => 7 , 
                    'formatter' => function( $d, $row ) {                    
                            $maxFaseId = \app\models\CampeonatoTieneFases::find()
                                ->where('camp_id = '.$_GET['camp_id'])
                                ->select('max(ctf_id)') // we need only one column
                                ->scalar();                    
                            //Solo se puede eliminar la ultima fase
                            if($maxFaseId == $row['ctf_id']){
                                return '<button class="btn btn-danger" onclick="eliminarFase('.$row['ctf_id'].')">'.Yii::t('app',"ELIMINAR").'</button>';
                            } else {
                                return "";
                            }
                    }
                ),
        );
        
        //Indice
        $primaryKey = "ctf_id";
        
        //Tabla
        $table = "campeonato_tiene_fases";
        
        //Filtramos para que solo traiga las fases del campeonato indicado
        $_GET['columns'][1]['search']['value'] = $_GET['camp_id'];
        
        echo json_encode(
                datatables::simple( $_GET, $table, $primaryKey, $columns )
        );

    }
    
    /*
     * Renderiza la vista listar
     */
    public function actionListar(){
        
        $deporte = \app\models\Deporte::find()->where('dep_id = '.ID_ATLETISMO)->one();
        $eventos = ArrayHelper::map(\app\models\Evento::find()->where('eve_activo ='. ESTADO_ACTIVO)->orderBy('eve_id desc')->all(),'eve_id','eve_nombre');
        $categorias = ArrayHelper::map(\app\models\Categoria::find()->all(),'cat_id','cat_nombre');
        $tipoDeporte = ArrayHelper::map(\app\models\TipoDeporte::find()->all(),'td_id','td_nombre');
        //$deportes = ArrayHelper::map(\app\models\Deporte::find()->all(),'dep_id','dep_nombre');
        $genero = ArrayHelper::map(\app\models\Genero::find()->all(),'gen_id','gen_nombre');
        $pruebas = ArrayHelper::map(\app\models\Prueba::find()->all(),'prueb_id','prueb_nombre');
        

        $dptos = ArrayHelper::map(\app\models\Departamentos::find()->all(), 'dptos_id','dptos_name');
        $mcipios = ArrayHelper::map(\app\models\Municipios::find()->all(), 'municipios_id','municipios_name');              

        $escenarios = ArrayHelper::map(\app\models\Escenario::find()
                ->leftJoin('escenario_tiene_deportes etd', 'escenario.esc_id = etd.esc_id')
                ->where('esc_activo = '.ESTADO_ACTIVO." and etd.dep_id = ".$deporte->dep_id)
                ->all(),'esc_id','esc_nombre');        

        return $this->render('listar', 
                array(
                        'idDeporte' => ID_ATLETISMO, 
                        'eventos' => $eventos, 
                        'categorias' => $categorias,
                        'deporte' => $deporte,
                        //'deportes' => $deportes,
                        'tipoDeporte' => $tipoDeporte,
                        'genero' => $genero,
                        'pruebas' => $pruebas,
                        'escenarios' => $escenarios,
                        'dptos' => $dptos,
                        'mcipios' => $mcipios,                                                
                    )
            );
    }


    /*
     *  Muestra el listado de municipios relacionados a una departamento
     */
    public function actionListmunicipios(){
        $r = [];
        if(isset($_GET['dpto_id']) && $_GET['dpto_id'] != 0){            
            $municipios = \app\models\Municipios::find()->where(['municipios_dptos_code'=>$_GET['dpto_id']])->all();
        }else{
            $municipios = \app\models\Municipios::find()->all();
        }    
        $num = 0;
        foreach ($municipios as $m) {
            $r['muni'.$num] = $m->attributes;
            $num++;
        }   
        echo json_encode($r);

    }

    /*
     *  Muestra el listado de los deportistas 
     */
    public function actionDatadeportistas(){        
        $columns = array(            
            array('db' => 'ent_dpto', 'dt' => 0,
                'formatter' => function($d, $row){
                    return \app\models\Departamentos::find()->where(['dptos_id'=> $d])->one()->dptos_name;                    
                }
            ),
            array('db' => 'ent_municipio', 'dt' => 1,
                'formatter' => function($d, $row){
                    return \app\models\Municipios::find()->where(['municipios_id'=> $d])->one()->municipios_name;                    
                }
            ),
            array('db' => 'ent_nombre', 'dt' => 2),
            array('db' => 'nombres', 'dt' => 3),
            array('db' => 'usu_num_doc', 'dt' => 4),
            array('db' => 'dep_id', 'dt' => 5,
                'formatter' => function($d, $row){
                	$etd = \app\models\EquipoTieneDeportistas::find()->where(['dep_id'=> $d])->one();
                	if(isset($etd)){
                		$numero = \app\models\DeportistaTieneNumero::find()->where(['etd_id'=>$etd->etd_id])->one();
                		if(isset($numero)){
                			$num = str_pad($numero->dtn_numero, 4, '0', STR_PAD_LEFT); 
                            $option = "readonly";
                		}else{
                            $option = "";
                			$num = "";
                		}                		
                	}else{
                        $option = "disabled";
                		$num = "";
                	}
                    return "<input type='text' class='form-control num-asig' id='num$d' onchange='asignarNumero(".$row['dep_id'].",this.id, event)' onkeypress='return validarNumero(event);' value='$num' maxlength='4' $option>";
                }
            ),
            array('db' => 'dep_id', 'dt' => 6,
                'formatter' => function($d, $row){
                    return "<span id='btn$d' class='btn btn-warning btn-xs' onclick='habilitarCampo(this.id)'><span class='icon-edit'></span></span>&nbsp;<span id='btnd$d' class='btn btn-danger btn-xs' onclick='vaciarCampo(".$row['dep_id'].",this.id)'><span class='icon-squared-cross'></span></span>";
                }
            ),
        );        

        // Índice
        $primaryKey = 'dep_id';

        // Tabla
        $table = 'view_deportistas';


		// Se usa para filtrar los deportistas por algún campo       
        // if(isset($_GET['idDepto'])){
        // 	$_GET['columns'][0]['search']['value'] = $_GET['idDepto'];	
        // }else{
        // 	$_GET['columns'][0]['search']['value'] = 0;
        // }
        

        echo json_encode(
            datatables::simple($_GET, $table, $primaryKey, $columns)
        );
    }

    /*
     * Renderiza la vista listar fases de campeonato
     */
    public function actionListarfases(){
        $idCampeonato = $_GET['idCamp'];
        $campeonato = \app\models\Campeonato::find()->where('camp_id = '.$idCampeonato)->one();
        $promocion = $campeonato->getEve()->one()->getProm()->one();
        
        /**
         * Se calcula la totalidad de equipos participantes. 
         * Si es la primera fase, la totalidad de equipos corresponde a todos los que estan en la promoción (promocion_tiene_equipos)
         * Si es despues de la primera fase, la totalidad de equipos corresponde a los resultados de la fase anterior (campeonato_tiene_resultados)
         */
        $totalFases = \app\models\CampeonatoTieneFases::find()
                ->where('camp_id = '.$idCampeonato)
                ->orderBy('ctf_id desc')
                ->all();
        if(count($totalFases) <= 1){ 
            
            $total_equipos_promocionados = \app\models\PromocionTieneEquipos::find()
                    ->leftJoin('equipo', 'equipo.equi_id = promocion_tiene_equipos.equi_id')
                    ->where('prom_id = '.$promocion->prom_id." and equipo.prueb_id = ".$campeonato->prueb_id)->count();
        } else {
            $total_equipos_promocionados =\app\models\CampeonatoTieneResultados::find()->
                    where('ctf_id = '.$totalFases[1]->ctf_id. " and ftr_clasifica = 1")
                    ->count();
        }
        
        return $this->render('listarfases', 
                array(
                    'campeonato' => $campeonato, 
                    'total_equipos_promocionados' => $total_equipos_promocionados,
                    'promocion' => $promocion,
                )
        );
    }

    /*
     *  Asigna un número a un deportista
     */
    public function actionAsignarnumero(){    	    		    	
    	$equipoTieneDeportista_id = \app\models\EquipoTieneDeportistas::find()->where(['dep_id'=>$_GET['dep_id']])->one();
    	if(isset($equipoTieneDeportista_id) && AtletismoController::numeroEstaAsignado((int)$_GET['num'])==false){    		
    		$dtnum = \app\models\DeportistaTieneNumero::find()->where(['etd_id'=>$equipoTieneDeportista_id->etd_id])->one();
    		if(isset($dtnum)){    			
				$dtnum->dtn_numero = (int)$_GET['num'];
				if($dtnum->update()){
					echo 1; // Registro actualizado correctamente.
				}else{
					echo -1; // Se falló al asignar el número
				}    			
    		}else{
    			$dtnumNuevo = new DeportistaTieneNumero();
    			$dtnumNuevo->etd_id = $equipoTieneDeportista_id->etd_id;
    			$dtnumNuevo->dtn_numero = (int)$_GET['num'];
    			if($dtnumNuevo->insert()){
    				echo 2; // Nuevo registro insertado
    			}else{
    				echo -2; // Fallo al insertar nuevo registro
    			}    			
    		}
    	}else{
    		if(!isset($equipoTieneDeportista_id)){
    			echo 0; // Registro no existe en tabla
    		}else if(AtletismoController::numeroEstaAsignado((int)$_GET['num'])){
    			echo -3; // Número ya asignado
    		}    		
    	}    	    	    	    	
    }

    /*
     *  Quita un número al deportista
     */
    public function actionLimpiarrnumero(){
    	$etd_id = \app\models\EquipoTieneDeportistas::find()->where(['dep_id'=>$_GET['dep_id']])->one();
    	if(isset($etd_id)){
    		$depTienNum = \app\models\DeportistaTieneNumero::find()->where(['etd_id'=>$etd_id->etd_id])->one();
    		if(isset($depTienNum)){
	    		if($depTienNum->delete()){
	    			echo 1; // Dato borrado
	    		}else{
	    			echo 0; // Fallo al borrar
	    		}
	    	}else{
	    		echo -1; // No existia dato
	    	}
    	}    	    	
    }

    /*
     *	Rendereriza la vista de parametrizar (TEMPORAL)
     */
    public function actionParametrizar(){
    	$tipoPrueba = ArrayHelper::map(\app\models\TipoPrueba::find()->where(['tpr_estado'=>ESTADO_ACTIVO])->all(), 'tpr_id', 'tpr_nombre');
        $pruebas = ArrayHelper::map(\app\models\Prueba::find()->where('dep_id IN (3,4)')->all(),'prueb_id','prueb_nombre');
        $categorias = ArrayHelper::map(\app\models\Categoria::find()->where(['cat_estado'=>ESTADO_ACTIVO])->all(), 'cat_id', 'cat_nombre');
        $generos = ArrayHelper::map(\app\models\Genero::find()->where(['gen_estado'=>ESTADO_ACTIVO])->all(),'gen_id','gen_nombre');
        return $this->render('parametrizar',
            array(
            	'tipo_prueba' => $tipoPrueba,
                'pruebas' => $pruebas,
                'categoria' => $categorias,
                'genero' => $generos
            )
        );
    }

    /*
     *	Lista de reglas de parametrización de atletismo
     */
    public function actionDataparametros(){
        $columns = array(
            array('db' => 'param_at_id', 'dt' => 0), 
            array('db' => 'prueb_id', 'dt' => 1,

                'formatter' => function($d, $row){
                    return \app\models\Prueba::find()->where(['prueb_id' => $d])->one()->prueb_nombre;
                }
            ),
            array('db' => 'param_at_parametro1', 'dt' => 2,
                'formatter' => function($d, $row){
                    return \app\models\ParametrosAtletismo::find()->where(['par_at_id' => $d])->one()->par_at_nombre;
                }
            ),
            array('db' => 'param_at_param1_valor', 'dt' => 3),
            array('db' => 'param_at_parametro2', 'dt' => 4,
                'formatter' => function($d, $row){
                    return \app\models\ParametrosAtletismo::find()->where(['par_at_id' => $d])->one()->par_at_nombre;
                }
            ),            
            array('db' => 'param_at_param2_valor', 'dt' => 5),
            array('db' => 'param_at_estado', 'dt' => 6,
            	'formatter' => function($d, $row){
            		$button = "<button class='btn btn-";                		       	
            		if($row['param_at_estado'] == ESTADO_ACTIVO){
            			$estado = Yii::t('app',"ACTIVO");
            			$button .= "success'";
            		}else{
            			$estado = Yii::t('app',"INACTIVO");
            			$button .= "warning'";
            		}
            		$button .= " onclick='cambiarEstado(".$row['param_at_id'].", ".$d.")'>$estado</button>";            		
            		return $button;
            	}
            ),
        );

        $primaryKey = 'param_at_id';
        $table = 'parametrizacion_atletismo';

        echo json_encode(
            datatables::simple($_GET, $table, $primaryKey, $columns)
        );
    }

    /*
     *	Llena los campos del modal de editar regla
     */
    public function actionCargardatosregla(){
        $r = [];
        $parametrizacion = \app\models\ParametrizacionAtletismo::find()->where(['param_at_id'=>$_GET['id']])->one();
        $prueba = \app\models\Prueba::find()->where(['prueb_id' => $parametrizacion->prueb_id])->one();        
        $categoria = \app\models\Categoria::find()->where(['cat_id'=>$prueba->cat_id])->one();
        $genero = \app\models\Genero::find()->where(['gen_id' => $prueba->prueb_genero])->one();
        $p1 = \app\models\ParametrosAtletismo::find()->where(['par_at_id'=>$parametrizacion->param_at_parametro1])->one();
        $p2 = \app\models\ParametrosAtletismo::find()->where(['par_at_id'=>$parametrizacion->param_at_parametro2])->one();
        $r['parametrizacion'] = $parametrizacion->attributes;
        $r['prueba'] = $prueba->attributes;        
        $r['p1'] = $p1->attributes;
        $r['p2'] = $p2->attributes;
        echo json_encode($r);
    }

    /*
     *	Filtra las pruebas de acuerdo a categoría y género
     */
    public function actionFiltrarpruebaparametrizacion(){        
        $genero = $_GET['idGenero'];
        $categoria = $_GET['idCategoria'];        
        
        $arrayData = []; 
       	$arrayData['dep_id'] = [3,4];

        if($genero != ""){
            $arrayData['prueb_genero'] = $genero;
        }
        if($categoria != ""){
            $arrayData['cat_id'] = $categoria;
        }       
        $posts = \app\models\Prueba::find()
                ->where($arrayData)
                ->orderBy('prueb_nombre ASC')
                ->all(); 
        echo "<option>".Yii::t('app', "SELECCIONE")."</option>";                
        if($posts != null){
            foreach($posts as $post){
                echo "<option value='".$post->prueb_id."'>".$post->prueb_nombre."</option>";
            }
        }
    }

    /*
	 *	Activa/inactiva una regla
     */
    public function actionCambiarestadoparam(){
    	$parametrizacion = \app\models\ParametrizacionAtletismo::find()->where(['param_at_id' => $_POST['idPar']])->one();
    	if ($_POST['estado'] == ESTADO_ACTIVO) {
    		$parametrizacion->param_at_estado = ESTADO_INACTIVO;
    	}else{
    		$parametrizacion->param_at_estado = ESTADO_ACTIVO;
    	}
    	if($parametrizacion->update()){
    		echo true;
    	}
    }

    /*
     *	Muestra los parámetros de un tipo prueba
     */
    public function actionParametrosportipoprueba(){
    	$r = [];
    	$parametros = \app\models\ParametrosAtletismo::find()->where(['tpr_id' => $_POST['tpr']])->orderBy('par_at_pos')->all();
    	$num = 1;
    	foreach ($parametros as $para) {
    		$r['par'.$num] = $para->attributes;
    		$num++;
    	}
    	echo json_encode($r);
    }

    /*
     *	Guarda una nueva parametrización
     */
    public function actionAgregarregla(){
    	if($_POST['idRegla'] == ""){
    		if(\app\models\ParametrizacionAtletismo::find()->where(['prueb_id' => $_POST['prueb_id']])->all() != null){
    			echo "2";	
    		}else{
    			$parametrizacion = new \app\models\ParametrizacionAtletismo();
		    	$parametrizacion->param_at_parametro1 = $_POST['parametro-1_id'];
		    	$parametrizacion->param_at_param1_valor = $_POST['valor-p-1'];
		    	$parametrizacion->param_at_parametro2 = $_POST['parametro-2_id'];
		    	$parametrizacion->param_at_param2_valor = $_POST['valor-p-2'];
		    	$parametrizacion->prueb_id = $_POST['prueb_id'];
		    	$parametrizacion->param_at_estado = ESTADO_ACTIVO;
		    	if($parametrizacion->validate()){
		    		if($parametrizacion->insert()){
		    			echo true;
		    		}else{
		    			echo false;
		    		}
		    	}else{
		    		echo false;
		    	}    			
    		}	    	   
    	}else{
            $parametrizacion = \app\models\ParametrizacionAtletismo::find()->where(['param_at_id' => $_POST['idRegla']])->one();
            $parametrizacion->param_at_param1_valor = $_POST['valor-p-1'];
            $parametrizacion->param_at_param2_valor = $_POST['valor-p-2'];
            if($parametrizacion->update()){
                echo "3";
            }else{
                echo false;
            }    		
    	}
    }

    /*
     *	Genera reporte de la asignación de números
     */
    public function actionGenerarreporte(){
    	// Filtros    	    	    	
    	$evento = $_POST['eve_id_num_dep']; // igual
    	$categoria = $_POST['cat_id']; // igual
    	$genero = $_POST['gen_id']; // igual
    	$list ="";
    	
    	if ($_POST['dptos_id2'] != "") {
    		$list .= "ent_dpto = ".$_POST['dptos_id2'];	
    	}
    	if ($_POST['municipios_id2'] != "") { 
    		($list != "") ? $list .= " AND ": $list .= "";     		
    		$list .= "ent_municipio = ".$_POST['municipios_id2'];
    	}
    	if($_POST['inst'] != ""){
    		($list != "") ? $list .= " AND ": $list .= "";
    		$list .= "ent_nombre LIKE '%".$_POST['inst']."%'";
    	}    
    	if($_POST['nom'] != ""){
    		($list != "") ? $list .= " AND ": $list .= "";
    		$list .= "nombres LIKE '%".$_POST['nom']."%'";
    	}
    	if($_POST['doc'] != ""){
    		($list != "") ? $list .= " AND ": $list .= "";
    		$list .= "usu_num_doc LIKE '%".$_POST['doc']."%'";
    	}	    	
    	$deportistas = \app\models\ViewDeportistas::find()->where($list)->orderBy('ent_dpto')->all(); 
        if($_POST['tipRep'] == 1){
            echo AtletismoController::guardarExcel($deportistas);exit;
        }else{
            echo AtletismoController::guardarPDF($deportistas);exit;
        }
    }


    public static function guardarExcel($deportistas){
    	require("../helpers/PHPExcel/PHPExcel.php");
    	$objPHPExcel = new \PHPExcel();
        $encabezado = [
            Yii::t('app', "DEPARTAMENTO"),
            Yii::t('app', "CIUDAD"),
            Yii::t('app', "INSTITUCION/EQUIPO"),
            Yii::t('app', "NOMBRE"),
            Yii::t('app', "DOCUMENTO"),
            Yii::t('app', "NUMERO"),
        ];
        $fila = 1;
        $columna = 0;
        foreach($encabezado as $value) {
            $objPHPExcel->getActiveSheet()
                        ->setCellValueByColumnAndRow($columna, $fila, $value);
            $columna++;
        }
        $ews = $objPHPExcel->getSheet(0);
        $fila = 2;
        foreach ($deportistas as $dep) {
            for($i = 0; $i < sizeof($encabezado); $i++){
                if($i == 0){
                    $valor = \app\models\Departamentos::find()->where(['dptos_id'=>$dep->ent_dpto])->one()->dptos_name;
                }else if($i == 1){
                    $valor = \app\models\Municipios::find()->where(['municipios_id'=>$dep->ent_municipio])->one()->municipios_name;
                }else if($i == 2){
                    $valor = $dep->ent_nombre;
                }else if($i == 3){
                    $valor = $dep->nombres;
                }else if($i == 4){
                    $valor = $dep->usu_num_doc;
                }else if($i == 5){
                    $etd = \app\models\EquipoTieneDeportistas::find()->where(['dep_id'=> $dep->dep_id])->one();
                    if(isset($etd)){                
                        $numero = \app\models\DeportistaTieneNumero::find()->where(['etd_id'=>$etd->etd_id])->one();
                        if(isset($numero)){
                            $valor = str_pad($numero->dtn_numero, 4, '0', STR_PAD_LEFT);
                        }else{
                            $valor = "";
                        }
                    }else{
                        $valor = "";
                    }
                }
                $objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($i, $fila, $valor);
            }
            $fila++;
        }
        for ($col = ord('a'); $col <= ord('h'); $col++){
            $ews->getColumnDimension(chr($col))->setAutoSize(true);
        }
        $name = "asignacion".date('Y-m-d')."_".time();
        $ruta = 'downloads/'.$name.'.csv'; 
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($ruta);
        return $ruta;
    }

    /*
     *  Función para guardar la asignación de números en PDF
     */
    public static function guardarPDF($deportistas){
        require("../helpers/dompdf/dompdf_config.inc.php");
        $dompdf = new \DOMPDF();
        $dompdf->set_paper("A4", "portrait");
        $html = "<h1>".Yii::t('app', 'ASIGNACION_NUMEROS')."</h1><hr>
                <table border='2'>
                    <tr>
                        <th>".Yii::t('app', 'DEPARTAMENTO')."</th>
                        <th>".Yii::t('app', 'CIUDAD')."</th>
                        <th>".Yii::t('app', 'INSTITUCION/EQUIPO')."</th>
                        <th>".Yii::t('app', 'NOMBRE')."</th>
                        <th>".Yii::t('app', 'DOCUMENTO')."</th>
                        <th>".Yii::t('app', 'NUMERO')."</th>
                    </tr>";
        foreach ($deportistas as $dep) {
            $html .= "<tr>
                        <td>".\app\models\Departamentos::find()->where(['dptos_id'=>$dep->ent_dpto])->one()->dptos_name."</td>
                        <td>".\app\models\Municipios::find()->where(['municipios_id'=>$dep->ent_municipio])->one()->municipios_name."</td>
                        <td>".$dep->ent_nombre."</td>
                        <td>".$dep->nombres."</td>
                        <td>".$dep->usu_num_doc."</td>";
            $etd = \app\models\EquipoTieneDeportistas::find()->where(['dep_id'=> $dep->dep_id])->one();
                if(isset($etd)){                
                    $numero = \app\models\DeportistaTieneNumero::find()->where(['etd_id'=>$etd->etd_id])->one();
                    if(isset($numero)){
                        $html.= "<td>".str_pad($numero->dtn_numero, 4, '0', STR_PAD_LEFT)."</td>";
                    }else{
                        $html .= "<td></td>";
                    }
                }else{
                    $html .= "<td></td>";
                }
            $html .="</tr>";
        }
        $html .= "</table>";
        $dompdf->load_html($html);
        $dompdf->render();
        $pdf = $dompdf->output();
        $ruta = 'downloads/asignacion'.date('Y-m-d').'_'.time().'.pdf';
        file_put_contents($ruta, $pdf);
        return $ruta;
    }

    /*
     *	Verifica si un número ya esta asignado a algun deportista
     */
    public static function numeroEstaAsignado($num){
    	$dep = \app\models\DeportistaTieneNumero::find()->where(['dtn_numero' => $num])->one();
    	if(isset($dep)){
    		return true;
    	}else{
    		return false;
    	}
    }
}
?>