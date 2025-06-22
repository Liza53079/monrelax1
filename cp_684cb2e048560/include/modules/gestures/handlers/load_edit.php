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
$item = findOne("uni_gestures","id=?",[$id]);
if($item){
?>
<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
<div class="form-group">
    <label>Текущее изображение</label><br>
    <img src="<?php echo $config['urlPath'].'/'.$config['media']['gestures'].'/'.$item['image']; ?>" height="60">
</div>
<div class="form-group">
    <label>Новое изображение</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label>Описание</label>
    <input type="text" class="form-control" name="description" value="<?php echo $item['description']; ?>">
</div>
<?php }
?>
