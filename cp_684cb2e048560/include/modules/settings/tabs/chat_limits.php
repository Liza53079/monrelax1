<div class="tab-pane fade <?php if($tab == "chat_limits"){ echo 'active show'; } ?>" id="tab-chat_limits" role="tabpanel" aria-labelledby="tab-chat_limits">

 <div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-3 form-control-label">Бесплатных чатов в сутки</label>
    <div class="col-lg-2">
        <input type="number" max="30" min="0" class="form-control" name="chat_free_per_day" value="<?php echo $settings["chat_free_per_day"]; ?>">
    </div>
 </div>

 <div class="form-group row d-flex align-items-center mb-5">
    <label class="col-lg-3 form-control-label">Бонус чатов за пополнение</label>
    <div class="col-lg-2">
        <input type="number" class="form-control" name="chat_bonus_topup" value="<?php echo $settings["chat_bonus_topup"]; ?>">
    </div>
 </div>

</div>
