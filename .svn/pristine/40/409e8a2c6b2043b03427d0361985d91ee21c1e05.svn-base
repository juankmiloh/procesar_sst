<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\helpers\datatables;
use yii\helpers\ArrayHelper;
use Yii;


class EventoController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['fechasevento', 'logout', 'index', 'conjunto', 
                            'crearevento', 'listar', 'eventos', 'editarevento'], // add all actions to take guest to login page
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    
    
    /*
     * Renderiza la vista listar
     */
    public function actionListar(){
        $sedes = ArrayHelper::map(\app\models\Sede::find()->where('sede_estado = '.ESTADO_ACTIVO)->all(), 'sede_id', 'sede_nombre');
        $promociones = ArrayHelper::map(\app\models\Promocion::find()->where('prom_activo = '.ESTADO_ACTIVO)->orderBy('prom_id desc')->all(), 'prom_id', 'prom_nombre');
        $estados = array(ESTADO_ACTIVO => Yii::t('app', "ACTIVO"), ESTADO_INACTIVO => Yii::t('app', "INACTIVO"));
        //$estados = 
        return $this->render('listar', array('promociones' => $promociones, 'sedes' => $sedes, 'estados' => $estados));
    }
    
    /**
     * Consulta las fecha de inicio y fin de un evento dado su ID
     */
    public function actionFechasevento(){
        $idEvento = $_GET['idEvento'];
        $evento = \app\models\Evento::find()->where('eve_id = '.$idEvento)->select('eve_fecha_ini, eve_fecha_fin')->one();
        echo json_encode($evento->attributes);
    }
    
    /**
     * Retorna lista con los datos de los eventos. 
     */
    public function actionEventos(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'eve_id', 'dt' => 0 ),
            array(
                    'db'        => 'prom_id',
                    'dt'        => 1,
                    'formatter' => function( $d, $row ) {
                            return \app\models\Promocion::find()->where('prom_id = '.$d)->one()->prom_nombre;
                    }
            ),
            array( 'db' => 'eve_nombre', 'dt' => 2 ),
            array(
                    'db'        => 'eve_fecha_ini',
                    'dt'        => 3,
                    'formatter' => function( $d, $row ) {
                            return date( 'jS M y', strtotime($d));
                    }
            ),
            array(
                    'db'        => 'eve_fecha_fin',
                    'dt'        => 4,
                    'formatter' => function( $d, $row ) {
                            return date( 'jS M y', strtotime($d));
                    }
            ),
            array(
                'db'        => 'eve_activo',
                'dt'        => 5,
                'formatter' => function( $d, $row ) {
                    if($d == ESTADO_ACTIVO){
                        return '<button class="btn btn-success" onclick="cambiarEstado('.$row['eve_id'].','.ESTADO_INACTIVO.')">'.Yii::t('app',"ACTIVO").'</button>';
                    }else{
                        return '<button class="btn btn-warning" onclick="cambiarEstado('.$row['eve_id'].','.ESTADO_ACTIVO.')">'.Yii::t('app',"INACTIVO").'</button>';
                    }
                }
            ),
        );
        
        //Indice
        $primaryKey = "eve_id";
        
        //Tabla
        $table = "evento";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );

    }
    
    /*
     * Renderiza la vista index
     */
    public function actionIndex()
    {
            return $this->render('index');
    }
    
    /**
     * Renderiza la vista crear evento
     * @return type
     */
    public function actionConjunto()
    {
            return $this->render('conjunto');
    }
    
    /**
     * Recibe una solicitud con los datos de un evento
     */
    public function actionEditarevento(){
        
            if(isset($_GET['id'])){
                
                $evento = \app\models\Evento::find()->where('eve_id = '.$_GET['id'])->one();
                $sedes = \app\models\EventoTieneSedes::find()->where('eve_id = '.$evento->eve_id)->select('sede_id')->asArray()->all();
                $data = $evento->attributes;
                array_push($data, $sedes);
                $r = json_encode($data);
                echo $r;
                
            } if(isset($_GET['idRegistro'])){ //Cambiar el estado del registro
                
                $evento = \app\models\Evento::find()->where('eve_id = '.$_GET['idRegistro'])->one();
                $evento->eve_activo = $_GET['estado'];
                $evento->save();
                echo true;
                
            } else {
                echo false;
            }
            
    }

    /**
     * Recibe una solicitud de tipo POST para crear un nuevo evento
     */
    public function actionCrearevento(){
        
            if(isset($_GET['eve_fecha_fin'])){
                
                $evento = new \app\models\Evento();
                
                if(isset($_GET['idEvento']) && $_GET['idEvento'] != ""){
                    $evento = \app\models\Evento::find()->where('eve_id = '.$_GET['idEvento'])->one();
                    
                    //Eliminamos los sedes actuales del evento
                    \app\models\EventoTieneSedes::deleteAll(['eve_id' => $_GET['idEvento']]);
                }              

                /**
                 * Asigna las valores a cada atributos
                 */
                foreach ($evento as $attribute => $value) {
                    if(isset($_GET[$attribute])){
                        $evento->$attribute = $_GET[$attribute];
                    }
                }
                
                /**
                 * Guarda el evento
                 */
                if($evento->validate()){
                    $evento->save();
                    
                    /**
                     * Guarda las sedes del evento
                     */
                    $sedes = $_GET['sedes'];
                    for($i = 0; $i < count($sedes); $i++){
                        $ets = new \app\models\EventoTieneSedes();
                        $ets->sede_id = $sedes[$i];
                        $ets->eve_id = $evento->eve_id;
                        if($ets->validate())
                            $ets->save();
                    }
                    
                    echo true;
                } else {
                    echo false;
                } 
            } else {
                echo false;
            }
            
    }
}
