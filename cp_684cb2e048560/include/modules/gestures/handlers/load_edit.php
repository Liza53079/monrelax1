<?php
define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once $config["basePath"] . "/systems/unisite.php";
require_once $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php";

$id = (int)$_POST['id'];
$data = findOne("gestures","id=?",[$id]);
?>
<div class="form-group row d-flex align-items-center mb-5">
  <label class="col-lg-3 form-control-label">Изображение</label>
  <div class="col-lg-9">
     <input type="file" name="image">
     <?php if($data['image']){ ?>
     <img src="<?php echo Exists($config['media']['other'],$data['image'],$config['media']['no_image']); ?>" width="50" class="mt10">
     <?php } ?>
     <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
  </div>
</div>
<div class="form-group row d-flex align-items-center mb-5">
  <label class="col-lg-3 form-control-label">Описание</label>
  <div class="col-lg-9">
     <input type="text" class="form-control" name="description" value="<?php echo $data['description']; ?>">
  </div>
</div>
