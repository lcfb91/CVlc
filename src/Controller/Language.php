<?php

//global $loader;

//$loader->get('src/Model/Language');
//$languages = new Language(new Config());

if(empty($_SESSION['lg'])){
  //$_SESSION['lg'] = $languages->getDefaultLanguage()['iso'];
  $_SESSION['lg'] = 'lang-pt';
}

//if (Request::isAjax() && $action == 'change'){
//    $_SESSION['lg'] = $param;
//}

// if(!empty($_GET['lang'])){
// $_SESSION['lang'] = $_GET['lang'];
// }

// if(!empty($_GET['lang'])){
// $_SESSION['lang'] = $_GET['lang'];
// }
//
// if(isset($adm_conection)){
//   //idiomas disposniveis
//   $_SESSION['langs'] = array_column($config->getLanguages(), 'id', 'slug');
// }
//
// $_SESSION['lang_url'] = URL_BASE.'/lib/Language.php?lang=';
// $_SESSION['lang'] = empty($_SESSION['lang']) ? 'lang-pt' : $_SESSION['lang'] ;
// $_SESSION['lg'] = substr($_SESSION['lang'], -2);

//$langs = $languages->getLanguages();

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

?>
