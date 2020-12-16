<?php

class Language {

    public $mysql;

    public function __construct(Config $config){

        $this->mysql = $config->conn();

    }

    public function getLanguages(){

      $select = $this->mysql->prepare("SELECT * FROM `lang` WHERE `slug` LIKE '%lang-%'");

      $select->execute();
      return $select->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getDefaultLanguage(){

      $select = $this->mysql->prepare("SELECT iso FROM `lang` WHERE `principal` = 1");
      $select->execute();
      $result = $select->fetchAll(PDO::FETCH_ASSOC);

      if(empty($result)){
        $results = $this->getLanguages();
        return $results[0];
      } else if(count($result) > 1){
        return $result[0];
      } else {
        return $result[0];
      }

    }

}
