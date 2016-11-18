<?php

//bootstrap.php
use Doctrine\Common\ClassLoader;

require_once("Doctrine/Common/ClassLoader.php");
require_once("Libraries/Twig/Autoloader.php");

$classLoader = new ClassLoader("OWG", "src");
$classLoader->register();
//meer Doctrine-specifieke code

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src\OWG\Weggeefwinkel\Presentation");
$twig = new Twig_Environment($loader);