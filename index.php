<?php

// Nastavení zóny
mb_internal_encoding("UTF-8");
date_default_timezone_set("Europe/Prague");

// Simple autoloader
function autoload($class)
{
    if (preg_match('/Controller$/', $class)) {
        //print_r("$class <br>");
        //print_r(file_exists("Controllers/$class.php"));
        require("Controllers/$class.php");
    } else {
        require("Models/" . $class . ".php");
    }
}

spl_autoload_register("autoload");

// Připojení do DB
Db::connect("185.229.119.199", "hu", "pe#9de6o#h77zD", "HU");

// nastavení routeru
$router = new RouterController();
$router->process(array($_SERVER["REQUEST_URI"]));
$router->renderView();
