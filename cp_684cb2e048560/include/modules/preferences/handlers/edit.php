<?php
define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once $config["basePath"] . "/systems/unisite.php";
require_once $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php";

if(isAjax() == true){
 $id = (int)$_POST['id'];
 $name = clear($_POST['name']);
 if($name){
    update("UPDATE sex_preferences SET name=? WHERE id=?",[$name,$id]);
    $_SESSION['CheckMessage']['success'] = 'Действие успешно выполнено!';
    echo true;
 }else{
    $_SESSION['CheckMessage']['warning'] = 'Укажите название';
 }
}
?>
