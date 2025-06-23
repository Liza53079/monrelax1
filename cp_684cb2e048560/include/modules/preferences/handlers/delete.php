<?php
define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once $config["basePath"] . "/systems/unisite.php";
require_once $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php";

if(isAjax() == true){
 $id = (int)$_POST['id'];
 update('DELETE FROM sex_preferences WHERE id=?',[$id]);
 update('DELETE FROM user_sex_preferences WHERE preference_id=?',[$id]);
 $_SESSION['CheckMessage']['success'] = 'Действие успешно выполнено!';
 echo true;
}
?>
