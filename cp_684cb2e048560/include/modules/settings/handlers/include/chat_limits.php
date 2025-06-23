<?php
update("UPDATE uni_settings SET value=? WHERE name=?", [intval($_POST['chat_free_per_day']),'chat_free_per_day']);
update("UPDATE uni_settings SET value=? WHERE name=?", [intval($_POST['chat_bonus_topup']),'chat_bonus_topup']);
?>
