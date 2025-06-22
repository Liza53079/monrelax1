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

 $id = (int)$_POST['id'];
 $name = clear($_POST['name']);
 $error = [];

 if(!$name){ $error[] = 'Укажите название'; }

 if(count($error) == 0){
    update("UPDATE sex_preferences SET name=? WHERE id=?", [$name,$id]);
    $_SESSION["CheckMessage"]["success"] = "Данные сохранены";
    echo true;
 }else{
    $_SESSION["CheckMessage"]["warning"] = implode("<br/>", $error);
 }
}
?>
