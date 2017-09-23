<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use app\helpers\datatables;
use yii\helpers\ArrayHelper;
use Yii;


class PermisosController extends Controller
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
     * Renderiza la vista torneos
     */
    public function actionListar(){
        $eventos = \app\models\Evento::find()
                ->where('eve_activo = '.ESTADO_ACTIVO)
                ->orderBy('eve_nombre')
                ->all();
        $eventos = ArrayHelper::map($eventos,  'eve_id', 'eve_nombre');
        $usuarios = ArrayHelper::map(\app\models\Usuario::find()
                ->where('usu_estado ='. ESTADO_ACTIVO. " and usu_id not IN (SELECT d.usu_id FROM deportistas d) AND usu_id NOT IN (SELECT e.usu_id FROM entrenador e)")
                ->orderBy('usu_id desc')->all(),'usu_id','usu_num_doc');
        return $this->render('listar', array('eventos' => $eventos, 'usuarios' => $usuarios));
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionData(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'utc_id', 'dt' => 0 ),
            array( 'db' => 'usu_id', 'dt' => 1,'formatter' => function( $d, $row ) {
                            return \app\models\Usuario::find()->where('usu_id = '.$d)->one()->usu_num_doc;
                    }
                ),
            array( 'db' => 'camp_id', 'dt' => 2,
                    'formatter' => function( $d, $row ) {
                            return \app\models\Campeonato::find()->where('camp_id = '.$d)->one()->camp_nombre;
                    }
                ),
        );
        
        //Indice
        $primaryKey = "utc_id";
        
        //Tabla
        $table = "usuario_tiene_campeonatos";
        
        
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
                
                $registro = \app\models\UsuarioTieneCampeonatos::find()->where('utc_id = '.$_GET['id'])->one();
                $utc = \app\models\UsuarioTieneCampeonatos::find()
                        ->leftJoin('campeonato c', 'c.camp_id = usuario_tiene_campeonatos.camp_id')
                        ->where('usu_id = '.$registro->usu_id)
                        ->select('c.camp_id, c.camp_nombre')->asArray()->all();
                $data = $registro->attributes;
                
                $campeonato = \app\models\Campeonato::find()
                    ->where('camp_id = '.$utc[0]['camp_id'])
                    ->one()->attributes;
                
                array_push($data, $campeonato);
                array_push($data, $utc);
                
                $r = json_encode($data);
                echo $r;
            }
            
            /**
             * Crea un registro
             */
            else if(isset($_GET['usu_id'])){
                
                $registro = new \app\models\UsuarioTieneCampeonatos();
                
                if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                    $registro = \app\models\UsuarioTieneCampeonatos::find()->where('utc_id = '.$_GET['idRegistro'])->one();
                    
                    //Eliminamos los campeonatos actuales del usuario
                    \app\models\UsuarioTieneCampeonatos::deleteAll(['usu_id' => $registro->usu_id]);
                }              

                /**
                 * Guarda los campeonatos del usuario
                 */
                $campeonatos = $_GET['campeonatos'];
                for($i = 0; $i < count($campeonatos); $i++){
                    $cte = new \app\models\UsuarioTieneCampeonatos();
                    $cte->usu_id = $_GET['usu_id'];
                    $cte->camp_id = $campeonatos[$i];
                    if($cte->validate())
                        $cte->save();
                }

                echo true;
               
            } else {
                echo false;
            }
            
    }
}
