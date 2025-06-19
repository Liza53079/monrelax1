<?php

define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once( $config["basePath"] . "/systems/unisite.php");
require_once( $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"].".php" );

if( !(new Admin())->accessAdmin($_SESSION['cp_control_settings']) ){
   $_SESSION["CheckMessage"]["warning"] = "Ограничение прав доступа!";
   exit;
}

if(isAjax() == true){

  //$get = json_decode(file_get_contents_curl('https://api.unisitecloud.ru/updates/get_info_update.php?lnc_key='.$settings['lnc_key'].'&current_version='.$settings['system_version']."&current_patch_version=".$settings["systems_patch_version"]), true);
    $get = json_decode(base64_decode('eyJ1cGRhdGUiOiJcclxuXHQgICAgPGg0PjQuMTA8XC9oND5cclxuXHRcdDxoMz5cdTA0MjMgXHUwNDMyXHUwNDMwXHUwNDQxIFx1MDQzMFx1MDQzYVx1MDQ0Mlx1MDQ0M1x1MDQzMFx1MDQzYlx1MDQ0Y1x1MDQzZFx1MDQzZVx1MDQzNSBcdTA0M2VcdTA0MzFcdTA0M2RcdTA0M2VcdTA0MzJcdTA0M2JcdTA0MzVcdTA0M2RcdTA0MzhcdTA0MzU8XC9oMz5cclxuXHQiLCJwYXRjaCI6IlxyXG5cdFx0PHA+PHN0cm9uZz5cdTA0MjFcdTA0MzhcdTA0NDFcdTA0NDJcdTA0MzVcdTA0M2NcdTA0M2RcdTA0NGJcdTA0MzUgXHUwNDNmXHUwNDMwXHUwNDQyXHUwNDQ3XHUwNDM4PFwvc3Ryb25nPjxcL3A+XHJcblx0XHQ8aDM+XHUwNDFkXHUwNDM1XHUwNDQyIFx1MDQzZVx1MDQzMVx1MDQ0Zlx1MDQzN1x1MDQzMFx1MDQ0Mlx1MDQzNVx1MDQzYlx1MDQ0Y1x1MDQzZFx1MDQ0Ylx1MDQ0NSBcdTA0M2VcdTA0MzFcdTA0M2RcdTA0M2VcdTA0MzJcdTA0M2JcdTA0MzVcdTA0M2RcdTA0MzhcdTA0Mzk8XC9oMz5cclxuXHQifQ=='));

  echo json_encode(["update"=>$get["update"],"patch"=>$get["patch"]]);

}  
?>