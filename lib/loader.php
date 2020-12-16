<?php
/**
 * Created by PhpStorm.
 * User: renan
 * Date: 13/08/16
 * Time: 14:16
 */

class Loader
{

    public static function get_instance($BASE_DIR, $DS)
    {

        return new Loader($BASE_DIR, $DS);
    }

    public function __construct($BASE_DIR, $DS)
    {

        $this->ds = $DS;
        $this->base_dir = $BASE_DIR;

    }

    public function get($lib)
    {

        $lib = str_replace('/', $this->ds, $lib);
        $lib_path = $this->base_dir . $this->ds . $lib . '.php';

        include_once $lib_path;
    }

}