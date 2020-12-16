<?php
/**
 * Created by PhpStorm.
 * User: renan
 * Date: 20/03/16
 * Time: 16:30
 */

class Route {

    public static function dynamicUrl($url, $loop){

        $loop += 2;
        $url = explode('/',$url);

        $url_base = implode('/',array_slice($url, 0, $loop));
        $rota = array_slice($url, $loop, count($url));

        array_push($rota, $url_base);

        return $rota;
        
    }

}