<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\helpers\datatables;
use Yii;


class SedeController extends Controller
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
                        'actions' => ['listar', 'data', 'editar'], // add all actions to take guest to login page
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
     * Renderiza la vista listar
     */
    public function actionListar(){
        return $this->render('listar');
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionData(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'sede_id', 'dt' => 0 ),
            array( 'db' => 'sede_nombre', 'dt' => 1 ),
            array( 'db' => 'dpto_id', 'dt' => 2,
                'formatter' => function( $d, $row ) {
                    return \app\models\Departamentos::find()->where('dptos_id = '.$d)->one()->dptos_name;
                }
            ),
            array( 'db' => 'muni_id', 'dt' => 3,
                'formatter' => function( $d, $row ) {
                    return \app\models\Municipios::find()->where('municipios_id = '.$d)->one()->municipios_name;
                }
            ),
            array(
                'db'        => 'sede_estado',
                'dt'        => 4,
                'formatter' => function( $d, $row ) {
                    if($d == ESTADO_ACTIVO){
                        $r = "<strong><font color='green'>".Yii::t("app", "ACTIVO")."</font></strong>";
                        return $r;
                    } else if($d == ESTADO_INACTIVO){
                        return "<strong><font color='red'>".Yii::t("app", "INACTIVO")."</font></strong>";
                    }
                }
            ),
        );
        
        //Indice
        $primaryKey = "sede_id";
        
        //Tabla
        $table = "sede";
        
        
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
                
                $registro = \app\models\Sede::find()->where('sede_id = '.$_GET['id'])->one();
                $r = json_encode($registro->attributes);
                echo $r;
            } 
            /**
             * Crea un registro
             */
            else if(isset($_GET['sede_nombre'])){
                
                $registro = new \app\models\Sede();
                
                if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                    $registro = \app\models\Sede::find()->where('sede_id = '.$_GET['idRegistro'])->one();
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
