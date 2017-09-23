<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use app\helpers\datatables;
use yii\helpers\ArrayHelper;
use Yii;


class BitacoraController extends Controller
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
                        'actions' => ['listar', 'data'], // add all actions to take guest to login page
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
        $usuarios = ArrayHelper::map(\app\models\Usuario::find()
                ->where('usu_estado ='. ESTADO_ACTIVO. " and usu_id not IN (SELECT d.usu_id FROM deportistas d)  AND usu_id NOT IN (SELECT e.usu_id FROM entrenador e)")
                ->orderBy('usu_id desc')->all(),'usu_id','usu_num_doc');
        return $this->render('listar', array('usuarios' => $usuarios));
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionData(){
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'bit_id', 'dt' => 0 ),
            array( 'db' => 'bit_model', 'dt' => 1 ),
            array( 'db' => 'usu_id', 'dt' => 2,
                'formatter' => function( $d, $row ) {
                    return \app\models\Usuario::find()->where('usu_id = '.$d)->one()->usu_num_doc;
                }
            ),
            array( 'db' => 'bit_fecha', 'dt' => 3 ),
            array( 'db' => 'bit_descripcion', 'dt' => 4 ),
        );
        
        //Indice
        $primaryKey = "bit_id";
        
        //Tabla
        $table = "bitacora";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );

    }
    
}
