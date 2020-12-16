<?php
/**
 * Created by PhpStorm.
 * User: renan
 * Date: 07/09/15
 * Time: 19:17
 */

class Config {

    public $config = array(
        'host'=>'localhost',
        'dbname'=>'una',
        'user'=>'root',
        'pass'=>''
    );

    public function conn(){

        if($_SERVER['SERVER_NAME'] != 'localhost'){
            $this->config = array(
              'host'=>'hosting81.serverhs.org',
              'dbname'=>'unifypt_unabase',
              'user'=>'unifypt_unabase',
              'pass'=>'nH[Gfxy9@*#o'
            );
        }

        $conn = new PDO(
            'mysql:host='.$this->config['host'].';dbname='.$this->config['dbname'],
            $this->config['user'],
            $this->config['pass'],
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
            )
        );

        return $conn;
    }
}
