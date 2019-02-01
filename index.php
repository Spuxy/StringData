<?php

mb_internal_encoding("UTF-8");

function autoLoading($class)
{
    if (preg_match('/Presenter$/', $class))
        require("Presenters/" . $class . ".php");
    else
        require("Models/" . $class . ".php");
}

spl_autoload_register("autoLoading");

Db::connect("localhost", "root", "", "");

$router = new RouterPresenter();
$router->process(array($_SERVER['REQUEST_URI']));


$router->renderView();
