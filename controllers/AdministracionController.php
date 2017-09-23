<?php
namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\helpers\datatables;
use app\helpers\Security;
use yii\helpers\Url;
use app\controllers\HelperController;
use Yii;


class AdministracionController extends Controller{

    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['usuarios', 'getusuarios', 'updatepassword',
                            'roles', 'getroles', 'crearrol', 'datosrol', 
                            'menu', 'getmenu', 'crearmenu', 'datosmenu', 
                            'enlace', 'getenlace', 'crearenlace', 'datosenlace',
                            'menuporroles', 'getmenuporroles', 'crearmenuporroles', 'datosmenuporroles', 
                            'opcionesxmenu', 'getopcionesxmenu', 'crearopcionesxmenu', 'datosopcionesxmenu'], 
                        'allow' => true,
                        'roles' => ['@'],// add all actions to take guest to login page when user not authenticate
                    ],
                    [
                        'actions' => ['recuperarcontrasena', 'changepassword', 'restablecer', 'actualizarcontrasena'], 
                        'allow' => true,
                        'roles' => ['?'],// add all actions to take guest to login page when user not authenticate
                    ],
                    [
                        'actions' => ['crearusuario', 'datosusuario'], //action allowed to admin only
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                             return $this->validateRol(array(ROL_ADMINISTRADOR));
                        }
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
                'actions' => ['logout' => ['post'], 'recuperarcontrasena'],
            ],
        ];
    }
    
    /**
     * Permite a los usuarios autenticados modificar su cotnraseña
     */
    public function actionUpdatepassword(){
        
        $actual = $_GET['actual'];
        $nuevo = $_GET['nuevo'];
        
        $usuario = \app\models\Usuario::find()->where('usu_id = '.Yii::$app->user->identity->usu_id)->one();

        $actual = Security::encode($actual, $usuario->usu_hash_key);
        if($actual != $usuario->usu_contrasena){
            echo json_encode(Yii::t('app', "CONTRASENA_INCORRECTA"));
        } else {
            
            //Bitácora
            HelperController::writetolog("Sesión", "Modificar Contraseña", $usuario->usu_id);
            
            $usuario->usu_contrasena = Security::encode($nuevo, $usuario->usu_hash_key); 
            $usuario->update();
            echo json_encode(true);
        }
        
    }
    
    /**
     * Mecanismo de recuperación de contraseña
     * Invocado por usuarios no autenticados. 
     */
    public function actionActualizarcontrasena(){
        $token = $_GET['token'];
        $pass = $_GET['key'];
        
        $utk = \app\models\UsuarioTieneTokens::find()->where('token = "'.$token.'" and activo = '.ESTADO_ACTIVO)->one();
        
        if($utk != null){
            $usuario = \app\models\Usuario::find()->where('usu_id = '.$utk->id_user)->one();

            $key = Security::generateRandomKey();
            $usuario->usu_hash_key = $key;
            $usuario->usu_contrasena = Security::encode($pass, $key); 
            $usuario->update();
            
            //Bitácora
            HelperController::writetolog("Sesión", "Recuperar contraseña por correo", $usuario->usu_id);
            
            $utk->activo = ESTADO_INACTIVO;
            $utk->update();
            
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    
    /**
     * Interfaz para solicitar recuperación de contraseña
     * @return type
     */
    public function actionChangepassword(){
        $this->layout='empty';
        return $this->render('changepassword');
    }
    
    /**
     * Interfaz para cambiar contraseña usando token
     * @return type
     */
    public function actionRestablecer(){
        $token = $_GET['token'];
        $utk = \app\models\UsuarioTieneTokens::find()->where('token = "'.$token.'" and activo = '.ESTADO_ACTIVO)->one();
        if($utk != null){
            $this->layout='empty';
            return $this->render('restablecer');
        } else {
            return $this->redirect(['site/login']);
        }
    }
    
    /**
     * Generación de token y envio de correo para restauración de contraseña
     */
    public function actionRecuperarcontrasena(){
        
        $correo = "none@gmail.com";
        if(isset($_GET['mail'])){
            $correo = $_GET['mail'];
        } 
        $user = \app\models\Usuario::find()->where('usu_correo = "'. $correo .'" and usu_estado = '. ESTADO_ACTIVO)->one();
        if($user == null){
            echo json_encode(false);
        } else {
            
            //Bitácora
            HelperController::writetolog("Sesión", "Solicitud de recuperar contraseña", $user->usu_id);
            
            $token = Security::generateRandomKey();
            
            $utk = new \app\models\UsuarioTieneTokens();
            $utk->activo = ESTADO_ACTIVO;
            $utk->id_user = $user->usu_id;
            $utk->token = $token;
            
            $utk->save();
            
            $url = "http://" . $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
            $url .= Yii::$app->urlManager->createUrl(['administracion/restablecer','token' => $token]);  
            
            
            $msn = '<html>Hola "'.$user->usu_apellidos.' '.$user->usu_nombres.'",  hemos recibido una solicitud de reinicio de contraseña. Si no ha sido usted por favor ignore este mensaje. <br> <br>

                Por favor de clic en el siguiente enlace para recuperar su contraseña: <br> <br> <br>

                                        <a class="restablecer" href="'.$url.'">Restablecer Contraseña.</a> <br> <br> <br>


                  Cordialmente, <br>
                  Superate.</html>';
            
            $to = $correo;
            $asunto = "Superate - Recuperación de contraseña";
            HelperController::sendMail($msn, $to, $asunto);
            echo json_encode(true);
        }
    }
    
    /**
     * Consulta los datos de un usuario dado su ID
     */
    public function actionDatosusuario(){
        if(isset($_GET['id'])){
                
                $usuario = \app\models\Usuario::find()->where('usu_id = '.$_GET['id'])->one();
                $roles = $usuario->getUsuarioTieneRols()->select('rol_id')->asArray()->all();
                $data = $usuario->attributes;
                array_push($data, $roles);
                $r = json_encode($data);
                
                echo $r;
            } else {
                echo false;
            }
    }

    /**
     * Renderiza la vista de administración de usuarios
     * @return type
     */
    public function actionUsuarios(){
        return $this->render('usuarios');
    }
    
    /**
     * Pobla el datatable de usuarios
     */
    public function actionGetusuarios(){
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'usu_id', 'dt' => 0 ),
            array( 'db' => 'usu_nombres', 'dt' => 1 ),
            array( 'db' => 'usu_apellidos', 'dt' => 2 ),
            array( 'db' => 'usu_num_doc', 'dt' => 3 ),
            array( 'db' => 'usu_fecha_creacion', 'dt' => 4 ),
            array(
                'db'        => 'usu_estado',
                'dt'        => 5,
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
        $primaryKey = "usu_id";
        
        //Tabla
        $table = "usuario";
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
    }
    
    /**
     * Crea o edita usuarios en el sistema
     */
    public function actionCrearusuario(){
        if(isset($_GET['idRegistro'])){
                
            $usuario = new \app\models\Usuario();

            if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                $usuario = \app\models\Usuario::find()->where('usu_id = '.$_GET['idRegistro'])->one();
                
                //Eliminamos los roles actuales del usuario
                \app\models\UsuarioTieneRol::deleteAll(['usu_id' => $_GET['idRegistro']]);
            }  else {
                $key = Security::generateRandomKey();
                $usuario->usu_hash_key = $key;
                $usuario->usu_contrasena = Security::encode($_GET['pass1_usuario'], $key); 
            }            

            $usuario->usu_nombres = $_GET['nombre_usuario']; 
            $usuario->usu_apellidos = $_GET['apellido_usuario']; 
            $usuario->usu_tipo_doc = $_GET['tipo_doc']; 
            $usuario->usu_num_doc = $_GET['documento_usuario']; 
            $usuario->usu_correo = $_GET['correo']; 
            $usuario->usu_estado = $_GET['estado']; 
            
            
            if($usuario->validate()){
                $usuario->save();
                
                //Se registran los roles del usuario
                $roles = $_GET['roles'];
                for($i = 0; $i < count($roles); $i++){
                    $usurol = new \app\models\UsuarioTieneRol();
                    $usurol->rol_id = $roles[$i];
                    $usurol->usu_id = $usuario->usu_id;
                    if($usurol->validate())
                        $usurol->save();
                }
                
                echo true;
            } else {
                foreach ($usuario->errors as $key => $mns){
                    echo $mns[0];
                    break;
                }
            } 
        } else {
            echo false;
        }
    }
    
    
    /**
     * Renderiza la vista de roles
     * @return type
     */
    public function actionRoles(){
        return $this->render('roles');
    }
    
    /**
     * Consulta los roles en el sistema
     */
    public function actionGetroles(){
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'rol_id', 'dt' => 0 ),
            array( 'db' => 'rol_nombre', 'dt' => 1 ),
            array(
                'db'        => 'rol_estado',
                'dt'        => 2,
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
        $primaryKey = "rol_id";
        
        //Tabla
        $table = "rol";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
    }
    
    /**
     * Crea o edita roles en el sistema
     */
    public function actionCrearrol(){
        if(isset($_GET['idRegistro'])){
                
            $rol = new \app\models\Rol();

            if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                $rol = \app\models\Rol::find()->where('rol_id = '.$_GET['idRegistro'])->one();
            }            

            $rol->rol_nombre = $_GET['nombre_rol']; 
            $rol->rol_descripcion = $_GET['detalle_rol']; 
            $rol->rol_estado = $_GET['estado']; 
            
            if($rol->validate()){
                $rol->save();
                echo true;
            } else {
                foreach ($rol->errors as $key => $mns){
                    echo $mns[0];
                    break;
                }
            } 
        } else {
            echo false;
        }
    }
    
    /**
     * Consulta los datos de un rol dado su ID
     */
    public function actionDatosrol(){
        if(isset($_GET['id'])){
                
                $rol = \app\models\Rol::find()->where('rol_id = '.$_GET['id'])->one();
                $data = $rol->attributes;
                $r = json_encode($data);
                
                echo $r;
            } else {
                echo false;
            }
    }
    
    
    /**
     * Renderiza la vista de roles
     * @return type
     */
    public function actionEnlace(){
        return $this->render('enlace');
    }
    
    /**
     * Consulta los roles en el sistema
     */
    public function actionGetenlace(){
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'enl_id', 'dt' => 0 ),
            array( 'db' => 'enl_nombre', 'dt' => 1 ),
            array(
                'db'        => 'enl_estado',
                'dt'        => 2,
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
        $primaryKey = "enl_id";
        
        //Tabla
        $table = "enlace";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
    }
    
    /**
     * Crea o edita roles en el sistema
     */
    public function actionCrearenlace(){
        if(isset($_GET['idRegistro'])){
                
            $enlace = new \app\models\Enlace();

            if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                $enlace = \app\models\Enlace::find()->where('enl_id = '.$_GET['idRegistro'])->one();
            }            

            $enlace->enl_nombre = $_GET['nombre_enlace']; 
            $enlace->enl_descripcion = $_GET['detalle_enlace']; 
            $enlace->enl_estado = $_GET['estado']; 
            $enlace->enl_url = $_GET['url_enlace']; 
            $enlace->enl_orden = $_GET['orden_enlace']; 
            
            if($enlace->validate()){
                $enlace->save();
                echo true;
            } else {
                foreach ($enlace->errors as $key => $mns){
                    echo $mns[0];
                    break;
                }
            } 
        } else {
            echo false;
        }
    }
    
    /**
     * Consulta los datos de un rol dado su ID
     */
    public function actionDatosenlace(){
        if(isset($_GET['id'])){
                
                $enlace = \app\models\Enlace::find()->where('enl_id = '.$_GET['id'])->one();
                $data = $enlace->attributes;
                $r = json_encode($data);
                
                echo $r;
            } else {
                echo false;
            }
    }
    
    /**
     * Renderiza la vista de roles
     * @return type
     */
    public function actionMenu(){
        return $this->render('menu');
    }
    
    /**
     * Consulta los roles en el sistema
     */
    public function actionGetmenu(){
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'menu_id', 'dt' => 0 ),
            array( 'db' => 'menu_nombre', 'dt' => 1 ),
            array(
                'db'        => 'menu_estado',
                'dt'        => 2,
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
        $primaryKey = "menu_id";
        
        //Tabla
        $table = "menu";
        
        
        echo json_encode(
                datatables::simple( $_GET,$table, $primaryKey, $columns )
        );
    }
    
    /**
     * Crea o edita roles en el sistema
     */
    public function actionCrearmenu(){
        if(isset($_GET['idRegistro'])){
                
            $menu = new \app\models\Menu();

            if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                $menu = \app\models\Menu::find()->where('menu_id = '.$_GET['idRegistro'])->one();
            }            

            $menu->menu_nombre = $_GET['nombre_menu']; 
            $menu->menu_descripcion = $_GET['detalle_menu']; 
            $menu->menu_estado = $_GET['estado']; 
            if($menu->validate()){
                $menu->save();
                echo true;
            } else {
                foreach ($menu->errors as $key => $mns){
                    echo $mns[0];
                    break;
                }
            } 
        } else {
            echo false;
        }
    }
    
    /**
     * Consulta los datos de un rol dado su ID
     */
    public function actionDatosmenu(){
        if(isset($_GET['id'])){
                
                $menu = \app\models\Menu::find()->where('menu_id = '.$_GET['id'])->one();
                $data = $menu->attributes;
                $r = json_encode($data);
                
                echo $r;
            } else {
                echo false;
            }
    }
    
    
    
    /**
     * Renderiza la vista de roles
     * @return type
     */
    public function actionMenuporroles(){
        return $this->render('menuporroles');
    }
    
    /**
     * Consulta los roles en el sistema
     */
    public function actionGetmenuporroles(){
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'rtm_id', 'dt' => 0 ),
            array(
                'db'        => 'rol_id',
                'dt'        => 1,
                'formatter' => function( $d, $row ) {
                    return \app\models\Rol::find()->where('rol_id = '.$d)->one()->rol_nombre;
                }
            ),
            array(
                'db'        => 'menu_id',
                'dt'        => 2,
                'formatter' => function( $d, $row ) {
                    return \app\models\Menu::find()->where('menu_id = '.$d)->one()->menu_nombre;
                }
            ),
        );
        
        //Indice
        $primaryKey = "rtm_id";
        
        //Tabla
        $table = "role_tiene_menu";
        
        
        echo json_encode(
                datatables::simple( $_GET, $table, $primaryKey, $columns )
        );
    }
    
    /**
     * Crea o edita roles en el sistema
     */
    public function actionCrearmenuporroles(){
        if(isset($_GET['idRegistro'])){
                

            if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                //Eliminamos los registros actuales
                $rtm = \app\models\RoleTieneMenu::find()->where('rtm_id = '.$_GET['idRegistro'])->one();
                \app\models\RoleTieneMenu::deleteAll(['rol_id' => $rtm->rol_id]);
            }            

            $menus = $_GET['menus'];
            for($i = 0; $i < count($menus); $i++){
                $rtm = new \app\models\RoleTieneMenu();
                $rtm->rol_id = $_GET['rol']; 
                $rtm->menu_id = $menus[$i];
                
                if($rtm->validate())
                    $rtm->save();
            }
   
            echo true;

        } else {
            echo false;
        }
    }
    
    /**
     * Consulta los datos de un rol dado su ID
     */
    public function actionDatosmenuporroles(){
        if(isset($_GET['id'])){
                
                $item = \app\models\RoleTieneMenu::find()->where('rtm_id = '.$_GET['id'])->one();
                $items = \app\models\RoleTieneMenu::find()->where('rol_id = '.$item->rol_id)->asArray()->all();
                $r = json_encode($items);
                
                echo $r;
            } else {
                echo false;
            }
    }
    
    
    
    
    /**
     * Renderiza la vista de roles
     * @return type
     */
    public function actionOpcionesxmenu(){
        return $this->render('opcionesxmenu');
    }
    
    /**
     * Consulta los roles en el sistema
     */
    public function actionGetopcionesxmenu(){
        //Columnas a consultar
        $columns = array(
            array( 'db' => 'mto_id', 'dt' => 0 ),
            array(
                'db'        => 'menu_id',
                'dt'        => 1,
                'formatter' => function( $d, $row ) {
                    return \app\models\Menu::find()->where('menu_id = '.$d)->one()->menu_nombre;
                }
            ),
            array(
                'db'        => 'enl_id',
                'dt'        => 2,
                'formatter' => function( $d, $row ) {
                    return \app\models\Enlace::find()->where('enl_id = '.$d)->one()->enl_nombre;
                }
            ),
        );
        
        //Indice
        $primaryKey = "mto_id";
        
        //Tabla
        $table = "menu_tiene_opciones";
        
        
        echo json_encode(
                datatables::simple( $_GET, $table, $primaryKey, $columns )
        );
    }
    
    /**
     * Crea o edita roles en el sistema
     */
    public function actionCrearopcionesxmenu(){
        if(isset($_GET['idRegistro'])){
                

            if(isset($_GET['idRegistro']) && $_GET['idRegistro'] != ""){
                //Eliminamos los registros actuales
                $mto = \app\models\MenuTieneOpciones::find()->where('mto_id = '.$_GET['idRegistro'])->one();
                \app\models\MenuTieneOpciones::deleteAll(['menu_id' => $mto->menu_id]);
            }            

            $enlaces = $_GET['enlaces'];
            for($i = 0; $i < count($enlaces); $i++){
                $mto = new \app\models\MenuTieneOpciones();
                $mto->menu_id = $_GET['menu']; 
                $mto->enl_id = $enlaces[$i];
                
                if($mto->validate())
                    $mto->save();
            }
   
            echo true;

        } else {
            echo false;
        }
    }
    
    /**
     * Consulta los datos de un rol dado su ID
     */
    public function actionDatosopcionesxmenu(){
        if(isset($_GET['id'])){
                
                $item = \app\models\MenuTieneOpciones::find()->where('mto_id = '.$_GET['id'])->one();
                $items = \app\models\MenuTieneOpciones::find()->where('menu_id = '.$item->menu_id)->asArray()->all();
                $r = json_encode($items);
                
                echo $r;
            } else {
                echo false;
            }
    }
    
    
}