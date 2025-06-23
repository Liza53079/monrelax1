<?php
define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once $config["basePath"] . "/systems/unisite.php";
require_once $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php";

if(isAjax() == true){
  $id = (int)$_POST['id'];
  $gest = findOne('gestures','id=?',[$id]);
  if($gest){
     if($gest['image']){ @unlink($config['basePath'].'/'.$config['media']['other'].'/'.$gest['image']); }
     update('DELETE FROM gestures WHERE id=?',[$id]);
  }
  $_SESSION['CheckMessage']['success'] = 'Действие успешно выполнено!';
  echo true;
}
?>
