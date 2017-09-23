<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\helpers\datatables;
use Yii;


class PromocionController extends Controller
{
    public $escenario;
    
    /**
     * Control de acceso
     * @return type
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['listar', 'data', 'editar', 'promocionadosconjunto', 
                            'datapromocionados', 'consultarequipos', 'guardarequipospromocionados'], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                        $user = "NO AUTH USER";
                        if(Yii::$app->user->identity != null){
                            $user = Yii::$app->user->identity->usu_num_doc;
                        }
                    throw new \Exception('User '. $user .', not allowed to access controller: "'.$action->controller->id.'", action: '.$action->actionMethod);
                }
            ],
        ];
    }
    
    
    /**
     * Guarda los equipos asociados a la promoción
     */
    public function actionGuardarequipospromocionados(){
        
        //Consultan los equipos promocionados
        if(isset($_GET['id'])){
            $pte = \app\models\PromocionTieneEquipos::find()
                    ->leftJoin('equipo', 'equipo.equi_id = promocion_tiene_equipos.equi_id')
                    ->leftJoin('entidad', 'entidad.ent_id = equipo.ent_id')
                    ->leftJoin('prueba', 'prueba.prueb_id = equipo.prueb_id')
                    ->where('prom_id = '.$_GET['id'])->select('equipo.equi_id, ent_nombre, prueba.prueb_nombre')->asArray()->all();
            $r = json_encode($pte);
            echo $r;
        }
        //Guardar los equipos asociados a la promoción
        else if(isset($_POST['idRegistro'])){
                

            //if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                
                //Eliminamos las promociones actuales
            \app\models\PromocionTieneEquipos::deleteAll(['prom_id' => $_POST['idRegistro']]);
            //}              

            /**
            * Guarda los equipos promocionados
            */
           $equipos = $_POST['data'];
           for($i = 0; $i < count($equipos); $i++){
               $ets = new \app\models\PromocionTieneEquipos();
               $ets->equi_id = $equipos[$i];
               $ets->prom_id = intval($_POST['idRegistro']);
               if($ets->validate()){
                   $ets->save();
               }
           }
            echo true;
        } else {
            echo false;
        }
    }
    
    /**
     * Consultar equipos del periodo de inscripción
     */
    public function actionConsultarequipos(){
        
        $pi = $_GET['idPeriodo'];
        
        $sql = "";
        if(isset($_GET['dpto']) && $_GET['dpto'] != ""){
            $sql .=  " and entidad.ent_dpto = ".$_GET['dpto'];
        }
        if(isset($_GET['muni']) && $_GET['muni'] != ""){
            $sql .=  " and entidad.ent_municipio = ".$_GET['muni'];
        }
        
        $equipos = \app\models\Equipo::find()
                ->leftJoin('entidad', 'entidad.ent_id = equipo.ent_id')
                ->where('pi_id = '.$pi.$sql." and tipo_fase_id = ".$_GET['fase'])
                ->orderBy('entidad.ent_nombre ASC')
                ->all();
        
        if($equipos != null){
            $i = 0;
            foreach($equipos as $equipo){
                echo "<option data-toggle='tooltip".$i."' data-container='#tooltip_container2' title='".$equipo->getPrueb()->one()->prueb_nombre."' value='".$equipo->equi_id."'>".$equipo->getEnt()->one()->ent_nombre." - ".$equipo->getPrueb()->one()->prueb_nombre."</option>";
                $i++;
            }
        }
        
    }
    
    /*
     * Renderiza la vista listar
     */
    public function actionListar(){
        $periodos = ArrayHelper::map(\app\models\PeriodoInscripciones::find()->where('pi_estado = '.ESTADO_ACTIVO)->orderBy('pi_id desc')->all(),'pi_id','pi_nombre');
        $tipoFase = ArrayHelper::map(\app\models\TipoFase::find()->where('tp_estado = '.ESTADO_ACTIVO)->orderBy('tp_id desc')->all(),'tp_id','tp_nombre');
        return $this->render('listar', array('periodos' => $periodos, 'tipoFase' => $tipoFase));
    }
    
    /**
     * Ver equipos promocionados 
     */
    public function actionPromocionadosconjunto(){
        
        $idPromocion = $_GET['idPromocion'];
        $promocion = \app\models\Promocion::find()->where('prom_id = '.$idPromocion)->one();
        $departamentos = ArrayHelper::map(\app\models\Departamentos::find()->all(), 'dptos_id', 'dptos_name');
        $tipoFase = ArrayHelper::map(\app\models\TipoFase::find()->all(), 'tp_id', 'tp_nombre');
        
        return $this->render('promocionadosconjunto', 
                array('promocion' => $promocion, 'departamentos' => $departamentos, 'tipoFase' => $tipoFase));
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionDatapromocionados(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'pte_id', 'dt' => 0 ),
            array( 'db' => 'prom_id', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    return \app\models\Promocion::find()->where('prom_id = '.$d)->one()->prom_nombre;
                }
            ),
            array( 'db' => 'equi_id', 'dt' => 2,
                'formatter' => function( $d, $row ) {
                    return \app\models\Equipo::find()->where('equi_id = '.$d)->one()->getEnt()->one()->getEntDpto()->one()->dptos_name;
                }
            ),
            array( 'db' => 'equi_id', 'dt' => 3,
                'formatter' => function( $d, $row ) {
                    return \app\models\Equipo::find()->where('equi_id = '.$d)->one()->getEnt()->one()->getEntMunicipio()->one()->municipios_name;
                }
            ),
            array( 'db' => 'equi_id', 'dt' => 4,
                'formatter' => function( $d, $row ) {
                    return \app\models\Equipo::find()->where('equi_id = '.$d)->one()->getEnt()->one()->ent_nombre;
                }
            ),
            array( 'db' => 'equi_id', 'dt' => 5,
                'formatter' => function( $d, $row ) {
                    return \app\models\Equipo::find()->where('equi_id = '.$d)->one()->getPrueb()->one()->prueb_nombre;
                }
            ),
            
        );
        
        //Indice
        $primaryKey = "pte_id";
        
        //Tabla
        $table = "promocion_tiene_equipos";
        
        
        
        if(isset($_GET['idPromocion'])){
            //Filtramos para que solo traiga las fases del campeonato indicado
            $_GET['columns'][1]['search']['value'] = $_GET['idPromocion'];
        }
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );

    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionData(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'prom_id', 'dt' => 0 ),
            array( 'db' => 'pi_id', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    return \app\models\PeriodoInscripciones::find()->where('pi_id = '.$d)->one()->pi_nombre;
                }
            ),
            array( 'db' => 'prom_nombre', 'dt' => 2),
            array( 'db' => 'tipo_fase_id', 'dt' => 3,
                'formatter' => function( $d, $row ) {
                    return \app\models\TipoFase::find()->where('tp_id = '.$d)->one()->tp_nombre;
                }
            ),
            array( 'db' => 'prom_fase_anterior', 'dt' => 4,
                'formatter' => function( $d, $row ) {
                    if($d != null){
                        $promAnterior = \app\models\Promocion::find()->where('prom_id = '.$d)->one();
                        return $promAnterior->prom_nombre;
                    } else {
                        return "";
                    }
                }
            ),
            array( 'db' => 'prom_id', 'dt' => 5,
                'formatter' => function( $d, $row ) {
                        return \app\models\PromocionTieneEquipos::find()->where('prom_id = '.$d)->count();
                }
            ),                

                    
            array( 'db' => 'prom_id', 'dt' => 6,
                'formatter' => function( $d, $row ) {
                        if($row['prom_activo'] == ESTADO_ACTIVO){
                            return '<button class="btn btn-danger" onclick="verpromocionados('.$row['prom_id'].')">'.Yii::t('app',"EQUIPOS_PROMOCIONADOS").'</button>';
                        } else {
                            return "";
                        }
                }
            ),
            array( 'db' => 'prom_activo', 'dt' => 7,
                'formatter' => function( $d, $row ) {
                    if($d == ESTADO_ACTIVO){
                        return '<button class="btn btn-success" onclick="cambiarEstado('.$row['prom_id'].','.ESTADO_INACTIVO.')">'.Yii::t('app',"ACTIVO").'</button>';
                    }else{
                        return '<button class="btn btn-warning" onclick="cambiarEstado('.$row['prom_id'].','.ESTADO_ACTIVO.')">'.Yii::t('app',"INACTIVO").'</button>';
                    }
                }
            ),
        );
        
        //Indice
        $primaryKey = "prom_id";
        
        //Tabla
        $table = "promocion";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );

    }
    
    /**
     * Recibe una solicitud de tipo GET para crear un nuevo registro
     */
    public function actionEditar(){
        
            /**
             * Consulta un registro
             */
            if(isset($_GET['id'])){ 
                
                $registro = \app\models\Promocion::find()->where('prom_id = '.$_GET['id'])->one();
                $r = json_encode($registro->attributes);
                echo $r;
            } 
            
            /**
             * Cambia el estado de un registro
             */
            else if(isset($_GET['idPromocion'])){
                $registro = \app\models\Promocion::find()->where('prom_id = '.$_GET['idPromocion'])->one();
                $registro->prom_activo = $_GET['estado'];
                $registro->save();
            }
            
            /**
             * Crea un registro
             */
            else if(isset($_GET['prom_nombre'])){
                
                $registro = new \app\models\Promocion();
                
                if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                    $registro = \app\models\Promocion::find()->where('prom_id = '.$_GET['idRegistro'])->one();
                }              

                /**
                 * Guarda los valores de las variables. 
                 */
                foreach ($registro as $attribute => $value) {
                    if(isset($_GET[$attribute])){
                        $registro->$attribute = $_GET[$attribute];
                    }
                }

                if($registro->validate()){
                    $registro->save();
                    echo true;
                } else {
                    echo false;
                } 
            } else {
                echo false;
            }
            
    }
}
