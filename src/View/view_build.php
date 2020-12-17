<?php

global $param;

if(!isset($module) or !is_string($module)){
    header("HTTP/1.0 500 Internal Server Error");
    echo '<h1>Variável $include não encontrada!</h1>';
    exit;
}


$lg = $_SESSION['lg'];

//$twig_data = array_merge(array('module' => $module, 'action' => $action, 'paramatro' => $param, 'url_base' => URL_BASE), $_SESSION, $menu, $exp);


echo $twig->render('Includes/head.html');
//include 'Includes/head.php';
echo $twig->render('Includes/menu.html');
//include 'Includes/menu.hmtl';

//$module_data = (empty($module_data)) ? $exp : $module_data;
if(file_exists('src'.DS.'View'.DS.$module.DS.$action.'.html')){ echo $twig->render($module.DS.$action.'.html'); }
//if(file_exists('src'.DS.'View'.DS.$module.DS.$action.'.php')){ include $module.DS.$action . '.php'; }
//else if($adm_conection->getPostBySlug($module)) { include 'Generic'.DS.$action . '.php'; }
else if($module == 'Site') { echo $twig->render($module.DS.$action.'.html'); }
else { echo $twig->render('Includes/404.html'); }

echo $twig->render('Includes/footer.html');
//include 'Includes/footer.php';

//setando URL base para o JS
echo "<script>var URL_BASE = '".URL_BASE."';</script>";

//incluindo JS do modulo
$filename = 'js/Controller/'.$module.'.js';

if (file_exists($filename)) {
    echo '<script src="'.URL_BASE.'/'.$filename.'"></script>';
} else {
    //echo $filename;
}

// echo '<pre>';
// print_r($twig_data);
// echo '</pre>';
//
// echo '<pre>';
// print_r($module_data);
// echo '</pre>';

?>
