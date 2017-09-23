<?php

namespace app\helpers;

class Security
{ 
    //Metodo de encripción
    //Parametros: cadena a encriptar, llave de encipción
    public static function encode($input, $key) 
    {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $input, MCRYPT_MODE_CBC, md5(md5($key))));
        return $output;
    }
 
    //Metodo de desencipción
    //Parametros: cadena a desenciptar, llave de encripción
    public static function decode($input, $key) 
    {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $output;
    }

    //Generar llave de encripción aleatoriamente
    //Parametros: seguridad y longitud de llave
    public static function generateRandomKey($armor = false , $lenght = 60)
    {      
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789-[*~]ABCDEFGHIJKLMNOPQRSTUVWXYZ!#@%/()?';
        $string = '';

        for ($i = 0; $i < $lenght; $i++) 
        {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        //Si se envia con seguridad, se encripta la llave con ella misma
        if($armor)
            $string = self::encode($string, $string);

        return $string;
    }
    
    //Generar token de verificación de usuario temporal
    //Parametros: longitud
    public static function generateTemporalToken($lenght = 20)
    {      
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';

        for ($i = 0; $i < $lenght; $i++) 
        {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }        

        return $string;
    }

    //Metodo para generar contraseñas    
    public static function generateTemporalPassword($length = 10, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%*?-/="';

        $all = '';
        $password = '';

        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);

        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if(!$add_dashes)
            return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';

        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }

        $dash_str .= $password;

        return $dash_str;
    }

    
}