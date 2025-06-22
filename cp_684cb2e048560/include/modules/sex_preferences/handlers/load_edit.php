<?php

define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once( $config["basePath"] . "/systems/unisite.php" );
require_once( $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php" );

if( !(new Admin())->accessAdmin($_SESSION['cp_control_settings']) ){
   exit;
}

$id = (int)$_POST['id'];
$item = findOne("sex_preferences","id=?",[$id]);
if($item){
?>
   <input type="hidden" name="id" value="<?php echo $item['id']; ?>" >
   <div class="form-group">
       <label>Название</label>
       <input type="text" class="form-control" name="name" value="<?php echo $item['name']; ?>" >
   </div>
<?php
}
?>
