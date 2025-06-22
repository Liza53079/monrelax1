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
 $id = (int)$_POST['id'];
 $item = findOne("uni_gestures","id=?",[$id]);

 if(!$item){ exit; }

 if($_FILES['image']['name']){
    $image = $Main->uploadedImage(["files"=>$_FILES['image'],"path"=>$config['media']['gestures'],"prefix_name"=>'gesture']);
    if($image['error']){ $error = array_merge($error,$image['error']); }
 }else{
    $image['name'] = $item['image'];
 }

 if(count($error) == 0){
    update("UPDATE uni_gestures SET image=?,description=? WHERE id=?", [$image['name'],clear($_POST['description']),$id]);
    $_SESSION["CheckMessage"]["success"] = "Данные сохранены";
    echo true;
 }else{
    $_SESSION["CheckMessage"]["warning"] = implode("<br/>", $error);
 }
}
?>
