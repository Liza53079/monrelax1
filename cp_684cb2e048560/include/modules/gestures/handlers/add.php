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

 $Main = new Main();
 $error = [];

 if(count($error) == 0){
    $image = $Main->uploadedImage(["files"=>$_FILES['image'],"path"=>$config['media']['gestures'],"prefix_name"=>'gesture']);
    if($image['error']){ $error = array_merge($error,$image['error']); }
 }

 if(count($error) == 0){
    insert("INSERT INTO uni_gestures(image,description)VALUES(?,?)", [$image['name'],clear($_POST['description'])]);
    $_SESSION["CheckMessage"]["success"] = "Действие успешно выполнено!";
    echo true;
 }else{
    $_SESSION["CheckMessage"]["warning"] = implode("<br/>", $error);
 }
}
?>
