<?php
define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once $config["basePath"] . "/systems/unisite.php";
require_once $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php";

if(isAjax() == true){
  $Main = new Main();
  $id = (int)$_POST['id'];
  $description = clear($_POST['description']);
  $error = [];
  if(!$description){ $error[] = 'Укажите описание'; }

  if(count($error) == 0){
     $image = $Main->uploadedImage(["files"=>$_FILES['image'], "path"=>$config['media']['other'], "prefix_name"=>'gesture']);
     if($image['error']){ $error = array_merge($error,$image['error']); }
  }

  if(count($error) == 0){
     if($image['name']){ $image_sql = ",image='{$image['name']}'"; }
     update("UPDATE gestures SET description=? $image_sql WHERE id=?", [$description,$id]);
     $_SESSION['CheckMessage']['success'] = 'Действие успешно выполнено!';
     echo true;
  }else{
     $_SESSION['CheckMessage']['warning'] = implode("<br>",$error);
  }
}
?>
