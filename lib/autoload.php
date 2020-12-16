<?php

require 'loader.php';

$loader = Loader::get_instance(ROOT, DS);
$loader->get('lib/Request');
$loader->get('lib/twig/autoload');

?>
