<?php
/**
 * Created by PhpStorm.
 * User: renan
 * Date: 13/08/16
 * Time: 14:36
 */

class Request
{

    public function is_post()
    {

        $method = $this->getRequestMethod();

        if ($method === 'POST'){

            return true;

        }else{

            return false;
        }
    }

    public function get_params()
    {

        global $rota;

        $params = $rota;

        if (count($rota) > 2){

            array_shift($params);
            array_shift($params);

            return $params;

        }else{

            return NULL;
        }

    }

    private function getRequestMethod()
    {

        return $_SERVER['REQUEST_METHOD'];

    }

    public static function isAjax(){
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
        return (strtolower($isAjax) === 'xmlhttprequest');
    }
}