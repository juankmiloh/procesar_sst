<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use app\helpers\datatables;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;


class ParamdeporteController extends Controller
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
                        'actions' => ['listar', 'data', 'editar', 'reglas', 'datareglas', 'editarregla'], // add all actions to take guest to login page
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
    
    /*
     * Renderiza la vista Reglas
     */
    public function actionReglas(){
        $param = $_GET['id'];
        $parametrizacion = \app\models\ParametrizacionDeportes::find()->where('param_id = '.$param)->one();
        $tipos = ArrayHelper::map(\app\models\TipoSuceso::find()->all(), 'ts_id', 'ts_nombre');
        return $this->render('reglas', array('parametrizacion' => $parametrizacion, 'tipos' => $tipos));
    }
    
    /*
     * Renderiza la vista listar
     */
    public function actionListar(){
        $deportes = ArrayHelper::map(\app\models\Deporte::find()->all(), 'dep_id', 'dep_nombre');
        return $this->render('listar', array('deportes' => $deportes));
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionDatareglas(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'pts_id', 'dt' => 0 ),
            array( 'db' => 'param_id', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    return \app\models\ParametrizacionDeportes::find()->where('param_id = '.$d)->one()->getDep()->one()->dep_nombre;
                }
            ),
            array( 'db' => 'pts_suceso', 'dt' => 2 ),
            array( 'db' => 'pts_suceso_valor', 'dt' => 3 ),
            array( 'db' => 'ts_id', 'dt' => 4,
                'formatter' => function( $d, $row ) {
                    return \app\models\TipoSuceso::find()->where('ts_id = '.$d)->one()->ts_nombre;
                }
            ),
            array( 'db' => 'pts_rol', 'dt' => 5,
                'formatter' => function( $d, $row ) {
                    $data = unserialize(ROLES_PARTICIPANTE);
                    return $data[$d];
                }
            ),
            array( 'db' => 'pts_id', 'dt' => 6,
                'formatter' => function( $d, $row ) {
                    return '<button class="btn btn-danger" onclick="deleteRow('.$d.')">'.Yii::t('app',"ELIMINAR").'</button>';
                }
            ),
        );
        
       if(isset($_GET['idDeporte'])){
            //Filtramos para que solo traiga las fases del campeonato indicado
            $_GET['columns'][5]['search']['value'] = $_GET['idDeporte'];
        }     
            
        //Indice
        $primaryKey = "pts_id";
        
        //Tabla
        $table = "parametrizacion_tiene_sucesos";
        
        if(isset($_GET['idParam'])){
            //Filtramos para que solo traiga las fases del campeonato indicado
            $_GET['columns'][1]['search']['value'] = $_GET['idParam'];
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
            array( 'db' => 'param_id', 'dt' => 0 ),
            array( 'db' => 'dep_id', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    return \app\models\Deporte::find()->where('dep_id = '.$d)->one()->dep_nombre;
                }
            ),
            array( 'db' => 'param_juego_ganado', 'dt' => 2 ),
            array( 'db' => 'param_juego_empatado', 'dt' => 3 ),
            array( 'db' => 'param_juego_perdido', 'dt' => 4 ),
            array(
                'db'        => 'param_id',
                'dt'        => 5,
                'formatter' => function( $d, $row ) {
                    $url = Url::toRoute(['paramdeporte/reglas', 'id' => $row['param_id']]);
                    return '<button class="btn btn-success" onclick="window.location.href =\''.$url.'\'">'.Yii::t('app',"PARAMETROS").'</button>';
                }
            ),
        );
        
        //Indice
        $primaryKey = "param_id";
        
        //Tabla
        $table = "parametrizacion_deportes";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );

    }
    
    /**
     * Recibe una solicitud de tipo GET para crear una nueva regla
     */
    public function actionEditarregla(){
        /**
             * Consulta un registro
             */
            if(isset($_GET['id'])){ 
                
                $registro = \app\models\ParametrizacionTieneSucesos::find()->where('pts_id = '.$_GET['id'])->one();
                $r = json_encode($registro->attributes);
                echo $r;
            } 
            
            /**
             * elimina un registro
             */
            else if(isset($_GET['idDelete'])){ 
                
                $registro = \app\models\ParametrizacionTieneSucesos::find()->where('pts_id = '.$_GET['idDelete'])->one();
                try{
                    $registro->delete();
                    echo true;
                } catch (\yii\db\Exception $e){
                    echo "La regla no puede ser eliminada";
                }
            } 
            /**
             * Crea un registro
             */
            else if(isset($_GET['idParam'])){
                
                $registro = new \app\models\ParametrizacionTieneSucesos();
                
                if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                    $registro = \app\models\ParametrizacionTieneSucesos::find()->where('pts_id = '.$_GET['idRegistro'])->one();
                }     
                
                $registro->param_id = $_GET['idParam'];

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
    
    /**
     * Recibe una solicitud de tipo GET para crear un nuevo registro
     */
    public function actionEditar(){
        
            /**
             * Consulta un registro
             */
            if(isset($_GET['id'])){ 
                
                $registro = \app\models\ParametrizacionDeportes::find()->where('param_id = '.$_GET['id'])->one();
                $r = json_encode($registro->attributes);
                echo $r;
            } 
            /**
             * Crea un registro
             */
            else if(isset($_GET['dep_id'])){
                
                $registro = new \app\models\ParametrizacionDeportes();
                
                if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                    $registro = \app\models\ParametrizacionDeportes::find()->where('param_id = '.$_GET['idRegistro'])->one();
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
