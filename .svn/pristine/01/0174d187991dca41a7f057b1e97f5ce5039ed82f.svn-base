<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use app\helpers\datatables;
use Yii;

class ContenidoController extends Controller {

    /**
     * Control de acceso
     * @return type
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'data', 'deletefoto', 'articulos', 
                            'dataarticulos', 'datalogos','logo', 'editarlogo', 'editar'], // add all actions to take guest to login page
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
     * Recibe una solicitud de tipo GET para crear un nuevo registro
     */
    public function actionEditar(){
        
            /**
             * Consulta un registro
             */
            if(isset($_GET['id'])){ 
                
                $registro = \app\models\Articulo::find()
                        ->where('art_id = '.$_GET['id'])->one();
                $r = json_encode($registro->attributes);
                echo $r;
            } 
            /**
             * Elimina un registro
             */
            else if(isset($_GET['idDel'])){ 
                
                $registro = \app\models\Articulo::find()->where('art_id = '.$_GET['idDel'])->one();
                $uploaddir = Yii::getAlias('@webroot');
                unlink($uploaddir.$registro->art_foto_ruta);
                $registro->delete();
                $r = true;
            }
            /**
             * Cambia el estado de un registro
             */
            else if(isset($_POST['idRegistro']) && $_POST['idRegistro'] != ""){
                $registro = \app\models\Articulo::find()
                        ->where('art_id = '.$_POST['idRegistro'])->one();
                
                /**
                * Guarda los valores de las variables. 
                */
                foreach ($registro as $attribute => $value) {
                    if(isset($_POST[$attribute])){
                        $registro->$attribute = $_POST[$attribute];
                    }
                }
                
                if($registro->validate()){
                    if(isset($_FILES['file']) && $_FILES['file']['name'] != ""){ 
                        $allowed =  array('png', 'jpg', 'jpeg');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        if(!in_array($ext,$allowed) ) {
                            echo 'El archivo debe tener extension png, jpg o jpeg';
                        }
                        elseif ( 0 < $_FILES['file']['error'] ) {
                            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
                        } 
                        else {
                            $path = '/uploads/articulos/';
                            $uploaddir = Yii::getAlias('@webroot') . $path;

                            $uploadfile = $uploaddir. $_FILES['file']['name'];
                            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
                            $registro->art_foto_ruta = $path.$_FILES['file']['name'];
                        }
                    }
                    $registro->save();
                    echo true;
                }
                
                //$registro->camp_estado = $_GET['estado'];
                $registro->save();
            }
            /**
             * Crea un registro
             */
            else if(isset($_POST['eve_id'])){
                
                /**
                 * Valida que el campeonato con esa prueba no exista
                 */
     
                    $registro = new \app\models\Articulo();

                    /**
                     * Guarda los valores de las variables. 
                     */
                    foreach ($registro as $attribute => $value) {
                        if(isset($_POST[$attribute])){
                            $registro->$attribute = $_POST[$attribute];
                        }
                    }

                    $registro->usu_id = Yii::$app->user->identity->usu_id;
                    $registro->art_foto_ruta = "temp";
                    if($registro->validate()){
                        
                        $allowed =  array('png', 'jpg', 'jpeg');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        if(!in_array($ext,$allowed) ) {
                            echo 'El archivo debe tener extension png, jpg o jpeg';
                        }
                        elseif ( 0 < $_FILES['file']['error'] ) {
                            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
                        } 
                        else {
                            $path = '/uploads/articulos/';
                            $uploaddir = Yii::getAlias('@webroot') . $path;

                            $uploadfile = $uploaddir. $_FILES['file']['name'];
                            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
                            $registro->art_foto_ruta = $path.$_FILES['file']['name'];
                            $registro->save();
                            echo true;
                        }
                        
                    } else {
                        echo false;
                    } 
            } else {
                echo false;
            }
            
    }
    
    public function actionEditarlogo(){
        
        /**
             * Consulta un registro
             */
            if(isset($_GET['id'])){ 
                
                $registro = \app\models\Logo::find()
                        ->where('logo_id = '.$_GET['id'])->one();
                $r = json_encode($registro->attributes);
                echo $r;
            } 
            /**
             * Elimina un registro
             */
            else if(isset($_GET['idDel'])){ 
                
                $registro = \app\models\Logo::find()
                        ->where('logo_id = '.$_GET['idDel'])->one();
                $uploaddir = Yii::getAlias('@webroot');
                unlink($uploaddir.$registro->logo_foto_ruta);
                $registro->delete();
                $r = true;
            }
            /**
             * Cambia el estado de un registro
             */
            else if(isset($_POST['idRegistro']) && $_POST['idRegistro'] != ""){
                $registro = \app\models\Logo::find()
                        ->where('logo_id = '.$_POST['idRegistro'])->one();
                
                /**
                * Guarda los valores de las variables. 
                */
                foreach ($registro as $attribute => $value) {
                    if(isset($_POST[$attribute])){
                        $registro->$attribute = $_POST[$attribute];
                    }
                }
                
                if($registro->validate()){
                    if(isset($_FILES['file']) && $_FILES['file']['name'] != ""){ 
                        $allowed =  array('png', 'jpg', 'jpeg');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        if(!in_array($ext,$allowed) ) {
                            echo 'El archivo debe tener extension png, jpg o jpeg';
                        }
                        elseif ( 0 < $_FILES['file']['error'] ) {
                            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
                        } 
                        else {
                            $path = '/uploads/logos/';
                            $uploaddir = Yii::getAlias('@webroot') . $path;

                            $uploadfile = $uploaddir. $_FILES['file']['name'];
                            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
                            $registro->logo_foto_ruta = $path.$_FILES['file']['name'];
                        }
                    }
                    $registro->save();
                    echo true;
                }
                
                //$registro->camp_estado = $_GET['estado'];
                $registro->save();
            }
            /**
             * Crea un registro
             */
            else if(isset($_POST['eve_id'])){
                
                /**
                 * Valida que el campeonato con esa prueba no exista
                 */
     
                    $registro = new \app\models\Logo();

                    /**
                     * Guarda los valores de las variables. 
                     */
                    foreach ($registro as $attribute => $value) {
                        if(isset($_POST[$attribute])){
                            $registro->$attribute = $_POST[$attribute];
                        }
                    }

                    $registro->usu_id = Yii::$app->user->identity->usu_id;
                    $registro->logo_foto_ruta = "temp";
                    if($registro->validate()){
                        
                        $allowed =  array('png', 'jpg', 'jpeg');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                        if(!in_array($ext,$allowed) ) {
                            echo 'El archivo debe tener extension png, jpg o jpeg';
                        }
                        elseif ( 0 < $_FILES['file']['error'] ) {
                            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
                        } 
                        else {
                            $path = '/uploads/logos/';
                            $uploaddir = Yii::getAlias('@webroot') . $path;

                            $uploadfile = $uploaddir. $_FILES['file']['name'];
                            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
                            $registro->logo_foto_ruta = $path.$_FILES['file']['name'];
                            $registro->save();
                            echo true;
                        }
                        
                    } else {
                        echo false;
                    } 
            } else {
                echo false;
            }
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionDatalogos(){
        $uploaddir = Yii::getAlias('@webroot');
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'logo_id', 'dt' => 0),
            array( 'db' => 'logo_foto_ruta', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    $uploaddir = Yii::getAlias('@webroot');
                    $html = "<img src='../web$d' style='width: 100px'>";
                    return $html;
                }
            ),
            array( 'db' => 'logo_fecha', 'dt' => 2),
            array( 'db' => 'usu_id', 'dt' => 3,
                    'formatter' => function( $d, $row ) {
                    $usuario = \app\models\Usuario::find()
                            ->where('usu_id = '.$d)
                            ->one();
                    return $usuario->usu_apellidos." ".$usuario->usu_nombres;
                }
            ),
            array( 'db' => 'eve_id', 'dt' => 4,
                    'formatter' => function( $d, $row ) {
                    $evento = \app\models\Evento::find()
                            ->where('eve_id = '.$d)
                            ->one();
                    return $evento->eve_nombre;
                }
            ),
            array( 'db' => 'logo_id', 'dt' => 5,
                'formatter' => function( $d, $row ) {
                    return '<button class="btn btn-danger" onclick="deleteRow('.$row['logo_id'].')">'.Yii::t('app',"ELIMINAR").'</button>';
                }
            ),
        );
        
        //Indice
        $primaryKey = "logo_id";
        
        //Tabla
        $table = "logo";
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
        
    }
    
    public function actionArticulos(){
   
            $array = \app\models\Evento::find()
                ->where('eve_activo = '.ESTADO_ACTIVO)
                ->orderBy('eve_id desc')
                ->all();
            
            $eventos = \yii\helpers\ArrayHelper::map($array, 'eve_id', 'eve_nombre');
            return $this->render('articulos', array('eventos' => $eventos));
    }
    
    public function actionLogo(){
        $array = \app\models\Evento::find()
                ->where('eve_activo = '.ESTADO_ACTIVO)
                ->orderBy('eve_id desc')
                ->all();
            
            $eventos = \yii\helpers\ArrayHelper::map($array, 'eve_id', 'eve_nombre');
            return $this->render('logo', array('eventos' => $eventos));
    }
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionDataarticulos(){
        $uploaddir = Yii::getAlias('@webroot');
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'art_id', 'dt' => 0),
            array( 'db' => 'art_foto_ruta', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    $uploaddir = Yii::getAlias('@webroot');
                    $html = "<img src='../web$d' style='width: 100px'>";
                    return $html;
                }
            ),
            array( 'db' => 'art_titulo', 'dt' => 2),
            array( 'db' => 'art_fecha', 'dt' => 3),
            array( 'db' => 'usu_id', 'dt' => 4,
                    'formatter' => function( $d, $row ) {
                    $usuario = \app\models\Usuario::find()
                            ->where('usu_id = '.$d)
                            ->one();
                    return $usuario->usu_apellidos." ".$usuario->usu_nombres;
                }
            ),
            array( 'db' => 'eve_id', 'dt' => 5,
                    'formatter' => function( $d, $row ) {
                    $evento = \app\models\Evento::find()
                            ->where('eve_id = '.$d)
                            ->one();
                    return $evento->eve_nombre;
                }
            ),
            array( 'db' => 'art_id', 'dt' => 6,
                'formatter' => function( $d, $row ) {
                    return '<button class="btn btn-danger" onclick="deleteRow('.$row['art_id'].')">'.Yii::t('app',"ELIMINAR").'</button>';
                }
            ),
        );
        
        //Indice
        $primaryKey = "art_id";
        
        //Tabla
        $table = "articulo";
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
        
    }
    
    
    /**
     * Retorna lista con los registros. 
     */
    public function actionData(){
        
        $uploaddir = Yii::getAlias('@webroot');
        
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'foto_id', 'dt' => 0),
            array( 'db' => 'foto_ruta', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    $uploaddir = Yii::getAlias('@webroot');
                    $ruta = explode(".", $d);
                    $html = "<img src='../web$ruta[0]_small.$ruta[1]' style='width: 100px'>";
                    return $html;
                }
            ),
            array( 'db' => 'foto_ruta', 'dt' => 2),
            array( 'db' => 'foto_fecha', 'dt' => 3),
            array( 'db' => 'foto_id', 'dt' => 4,
                'formatter' => function( $d, $row ) {
                    return '<button class="btn btn-danger" onclick="deleteRow('.$row['foto_id'].')">'.Yii::t('app',"ELIMINAR").'</button>';
                }
            ),
        );
        
        //Indice
        $primaryKey = "foto_id";
        
        //Tabla
        $table = "fotos";
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );

    }
    
    /**
     * Elimina una foto
     */
    public function actionDeletefoto(){
        
        $id = $_GET['id'];
        $foto = \app\models\Fotos::find()
                ->where('foto_id = '.$id)
                ->one();
        
        
        $uploaddir = Yii::getAlias('@webroot');
        $filePathToDelete = $uploaddir.$foto->foto_ruta;
        
        //Elimina la foto asociada..
        unlink($filePathToDelete);
        $ruta = explode(".", $foto->foto_ruta);
        unlink($uploaddir.$ruta[0]."_small.".$ruta[1]);
        
        $foto->delete();
        echo true;
    }
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*
     * Renderiza la vista listar
     */
    public function actionIndex() {
        if (!empty($_FILES) && isset($_FILES['file'])) {
            $uploaddir = Yii::getAlias('@webroot') . '/uploads/fotos/';
            $path = '/uploads/fotos/';

            $file_parts = pathinfo(basename($_FILES['file']['name']));

            $resp = array();

            if ($file_parts['extension'] == "jpeg" || $file_parts['extension'] == "jpg" || $file_parts['extension'] == "png") {

                $data = $this->generateRandomString();

                $uploadfile = $uploaddir . $data . "." . $file_parts['extension'];

                if ($_FILES['file']['error'] != 0) {
                    if ($_FILES['file']['error'] == 1) {
                        $resp['error'] = 'El fichero subido excede la directiva upload_max_filesize de php.ini';
                    } else if ($_FILES['file']['error'] == 2) {
                        $resp['error'] = "El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML";
                    } else if ($_FILES['file']['error'] == 3) {
                        $resp['error'] = "El fichero fue sólo parcialmente subido";
                    } else if ($_FILES['file']['error'] == 4) {
                        $resp['error'] = "No se subió ningún fichero.";
                    } else if ($_FILES['file']['error'] == 6) {
                        $resp['error'] = "Falta la carpeta temporal.";
                    } else if ($_FILES['file']['error'] == 7) {
                        $resp['error'] = "No se pudo escribir el fichero en el disco.";
                    } else if ($_FILES['file']['error'] == 8) {
                        $resp['error'] = "Una extensión de PHP detuvo la subida de ficheros.";
                    }
                    if (function_exists('http_response_code'))
                        http_response_code(400);
                }
                else if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

                    $what = getimagesize($uploadfile);
                    list($width, $height) = getimagesize($uploadfile);
                    $r = $width / $height;

                    $w = 200;
                    $h = 200;

                    if ($w / $h > $r) {
                        $newwidth = $h * $r;
                        $newheight = $h;
                    } else {
                        $newheight = $w / $r;
                        $newwidth = $w;
                    }


                    switch (strtolower($what['mime'])) {

                        case 'image/png':
                            $img = imagecreatefrompng($uploadfile);
                            $new = imagecreatetruecolor($newwidth, $newheight);
                            imagecopyresampled($new, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                            header('Content-Type: image/png');
                            imagepng($new, $uploaddir . $data . "_small.png", 9);
                            imagedestroy($new);
                            break;
                        case 'image/jpeg':
                            $img = imagecreatefromjpeg($uploadfile);
                            $new = imagecreatetruecolor($newwidth, $newheight);
                            imagecopyresampled($new, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                            header('Content-Type: image/jpeg');
                            imagejpeg($new, $uploaddir . $data . "_small.jpg");
                            imagedestroy($new);
                            break;

                        default: die();
                    }

                    $foto = new \app\models\Fotos();
                    $foto->foto_ruta = $path . $data . "." . $file_parts['extension'];
                    $foto->eve_id = $_POST['eve_id'];
                    if ($foto->validate()) {
                        $foto->save();
                    }

                    http_response_code(200);
                } else {
                    http_response_code(400);
                }
            } else {
                $resp['error'] = "Formato no soportado";
                http_response_code(400);
            }
            header('Content-Type: application/json');
            echo json_encode($resp);
        } else {
            $array = \app\models\Evento::find()
                ->where('eve_activo = '.ESTADO_ACTIVO)
                ->orderBy('eve_id desc')
                ->all();
            
            $eventos = \yii\helpers\ArrayHelper::map($array, 'eve_id', 'eve_nombre');
            return $this->render('index', array('eventos' => $eventos));
        }
    }

}
