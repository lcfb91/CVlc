<?php
/**
 * Created by Unify.
 * User: Renan Pantoja
 * Date: 05/08/20
 * Time: 15:17
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

header('Content-Type: text/html; charset=utf8');

setlocale(LC_ALL, 'Portuguese_Portugal.1252');
date_default_timezone_set('Europe/Lisbon');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', pathinfo(__FILE__)['dirname']);

include 'lib/autoload.php';

$loader->get('config/Config');
$loader->get('config/Route');
$loader->get('config/Expressions');

if(empty($_SESSION['lg'])){
  $loader->get('src/Controller/Language');
}

$t_loader = new Twig_Loader_Filesystem('src/View');
$twig = new Twig_Environment($t_loader);

$expressions = new Exp(new Config());

//forçar redirecionamento para HTTPS
//if(empty($_SERVER['HTTPS'])){ header('Location: https://'.$_SERVER['HTTP_HOST']); } else { $protocol = 'https'; }
$protocol = 'http';

$rota = Route::dynamicUrl($protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 3);
define("URL_BASE", array_pop($rota));

if(isset($_GET['q'])){
    header('Location: '.URL_BASE.'/pesquisa/index/'.$_GET['q']);
}

$module = (empty($rota[0])) ? 'Site' : ucfirst($rota[0]);
$action = (isset($rota[1]) && (!empty($rota[1]))) ? $rota[1] : 'index';
$param = (isset($rota[2])) ? $rota[2] : null ;

// echo URL_BASE.'<br>';
// echo URL_BASE.'<br>';print_r($rota);
// echo $module.'<br>';
// echo $action.'<br>';
// echo $param.'<br>';

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

//if(file_exists(include 'src'.DS.'Model'.DS.$module . '.php')) include 'src'.DS.'Model'.DS.$module . '.php';
if(file_exists('src'.DS.'Model'.DS.$module . '.php')) include 'src'.DS.'Model'.DS.$module . '.php';
if(file_exists('src'.DS.'Controller'.DS.$module . '.php')) include 'src'.DS.'Controller'.DS.$module . '.php';

if (!Request::isAjax()){
    include_once 'src'.DS.'View'.DS.'view_build.php';
}
