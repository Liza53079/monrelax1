<?php
define('unisitecms', true);
session_start();

$config = require "../../../../../config.php";
require_once $config["basePath"] . "/systems/unisite.php";
require_once $config["basePath"] . "/" . $config["folder_admin"] . "/lang/" . $settings["lang_admin_default"] . ".php";

$id = (int)$_POST['id'];
$data = findOne('sex_preferences','id=?',[$id]);
?>
<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
<div class="form-group row d-flex align-items-center mb-5">
  <label class="col-lg-3 form-control-label">Название</label>
  <div class="col-lg-9">
     <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>">
  </div>
</div>
