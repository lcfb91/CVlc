<?php

if(!isset($module) or !is_string($module)){
    header("HTTP/1.0 500 Internal Server Error");
    echo '<h1>Variável $include não encontrada!</h1>';
    exit;
}

//expressoes para header menu e footer
$exp = $expressions->getExp(array(0,1,2,3,4), $_SESSION['lg']);
//$exp = array('nothing' => null);
$menu['menu'] = $expressions->getMenu($_SESSION['lg']);

$lg = $_SESSION['lg'];
//adicionando dados de sessao ao array
$twig_data = array_merge(array('module' => $module, 'action' => $action, 'paramatro' => $param, 'url_base' => URL_BASE), $_SESSION, $menu, $exp);

echo $twig->render('Includes/head.html', $twig_data);
//include 'Includes/head.php';
echo $twig->render('Includes/menu.html', $twig_data);
//include 'Includes/menu.hmtl';

//$module_data = (empty($module_data)) ? $exp : $module_data;
if(file_exists('src'.DS.'View'.DS.$module.DS.$action.'.html')){ echo $twig->render($module.DS.$action.'.html', $twig_data); }
//if(file_exists('src'.DS.'View'.DS.$module.DS.$action.'.php')){ include $module.DS.$action . '.php'; }
//else if($adm_conection->getPostBySlug($module)) { include 'Generic'.DS.$action . '.php'; }
else if($module == 'Site') { echo $twig->render($module.DS.$action.'.html', $twig_data); }
else { echo $twig->render('Includes/404.html', $twig_data); }

echo $twig->render('Includes/footer.html', $twig_data);
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
