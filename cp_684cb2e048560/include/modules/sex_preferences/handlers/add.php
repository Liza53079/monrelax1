<?php

define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once( $config["basePath"] . "/systems/unisite.php" );
require_once( $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php" );

if( !(new Admin())->accessAdmin($_SESSION['cp_control_settings']) ){
   $_SESSION["CheckMessage"]["warning"] = "Ограничение прав доступа!";
   exit;
}

if(isAjax() == true){

 $name = clear($_POST['name']);
 $error = [];

 if(!$name){ $error[] = 'Укажите название'; }

 if(count($error) == 0){
    insert("INSERT INTO sex_preferences(name)VALUES(?)", [$name]);
    $_SESSION["CheckMessage"]["success"] = "Действие успешно выполнено!";
    echo true;
 }else{
    $_SESSION["CheckMessage"]["warning"] = implode("<br/>", $error);
 }
}
?>
