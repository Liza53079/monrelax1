
<div class="auth-block-tabs" >
   <span data-tab="1" class="active" ><?php echo $ULang->t("Войти"); ?></span>
   <span data-tab="2" ><?php echo $ULang->t("Регистрация"); ?></span>
</div>

<div class="auth-block-tab auth-block-tab-auth auth-block-tab-1" >

    <?php if($settings["authorization_method"] == 1){ ?>
    <p class="text-center mb20" ><?php echo $ULang->t("Укажите номер телефона и пароль для входа на сайт"); ?></p>
    <?php }elseif($settings["authorization_method"] == 2){ ?>
    <p class="text-center mb20" ><?php echo $ULang->t("Укажите данные для входа на сайт"); ?></p>
    <?php }elseif($settings["authorization_method"] == 3){ ?>
    <p class="text-center mb20" ><?php echo $ULang->t("Укажите e-mail адрес и пароль для входа на сайт"); ?></p>
    <?php } ?>


    <?php if($settings["authorization_method"] == 1){ ?>
    <div class="input-phone-format" >

      <input type="text"  class="form-control input-style2-custom phone-mask" data-format="<?php echo getFormatPhone(); ?>" placeholder="<?php echo $ULang->t("Номер телефона"); ?>" name="user_login">
      
      <?php echo outBoxChangeFormatPhone(); ?>

    </div>
    <?php }elseif($settings["authorization_method"] == 2){ ?>
    <input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Телефон или электронная почта"); ?>" name="user_login">
    <?php }elseif($settings["authorization_method"] == 3){ ?>
    <input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Электронная почта"); ?>" name="user_login">
    <?php } ?>

    <div class="msg-error mb10" data-name="user_login" ></div>

    <input type="password"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Пароль"); ?>" maxlength="25" name="user_pass">
    <div class="msg-error mb10" data-name="user_pass" ></div>  
    
    <div class="box-save-auth" >
      <label class="checkbox">
        <input type="checkbox" name="save_auth" value="1" >
        <span></span>
        <?php echo $ULang->t("Сохранить пароль"); ?>
      </label>    
    </div>

    <div class="auth-captcha" <?php if($_SESSION["auth_captcha"]["status"]){ echo 'style="display: block;"'; } ?> >
      <div class="row" >
        <div class="col-lg-4 col-12" ><img src="" ></div>
        <div class="col-lg-8 col-12" ><input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Укажите код"); ?>" name="captcha"></div>
      </div>
      <div class="msg-error mb10" data-name="captcha" ></div>
    </div>

    <button class="button-style-custom schema-color-button color-green action-auth-send mt20" ><?php echo $ULang->t("Войти"); ?></button>
    <button class="button-style-custom color-light action-forgot mt10" ><?php echo $ULang->t("Восстановить пароль"); ?></button>

    <?php if($settings["authorization_social"]){ ?>

    <div class="mt20" ></div>

    <p class="text-center" ><?php echo $ULang->t("или через сервисы"); ?></p>

        <div class="auth-list" >

           <?php echo $Profile->socialAuth(); ?> 

        </div>

    <?php } ?>

    <div class="clr" ></div>

</div>

<div class="auth-block-tab auth-block-tab-reg auth-block-tab-2" >

    <?php if($settings["registration_method"] == 1){ ?>
    <p class="text-center mb20" ><?php echo $ULang->t("Укажите номер телефона для регистрации на сайте"); ?></p>
    <?php }elseif($settings["registration_method"] == 2){ ?>
    <p class="text-center mb20" ><?php echo $ULang->t("Укажите данные для регистрации на сайте"); ?></p>
    <?php }elseif($settings["registration_method"] == 3){ ?>
    <p class="text-center mb20" ><?php echo $ULang->t("Укажите e-mail адрес для регистрации на сайте"); ?></p>
    <?php } ?>

    <div class="auth-block-right-box-tab-1-1" >

      <input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Ваше имя"); ?>" name="name">
      <div class="msg-error mb10" data-name="name" ></div>

      <input type="number"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Возраст"); ?>" name="age">
      <div class="msg-error mb10" data-name="age" ></div>

      <select class="form-control input-style2-custom" name="gender">
        <option value="male" ><?php echo $ULang->t("Мужской"); ?></option>
        <option value="female" ><?php echo $ULang->t("Женский"); ?></option>
        <option value="other" ><?php echo $ULang->t("Другой"); ?></option>
      </select>
      <div class="msg-error mb10" data-name="gender" ></div>

      <select class="form-control input-style2-custom" name="role">
        <option value="sponsor" ><?php echo $ULang->t("Спонсор"); ?></option>
        <option value="model" ><?php echo $ULang->t("Модель"); ?></option>
      </select>
      <div class="msg-error mb10" data-name="role" ></div>

      <select class="form-control input-style2-custom" name="looking_for">
        <option value="male" ><?php echo $ULang->t("Ищу мужчину"); ?></option>
        <option value="female" ><?php echo $ULang->t("Ищу женщину"); ?></option>
        <option value="both" ><?php echo $ULang->t("Ищу всех"); ?></option>
      </select>
      <div class="msg-error mb10" data-name="looking_for" ></div>

      <input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Город"); ?>" name="city">
      <div class="msg-error mb10" data-name="city" ></div>

      <input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Электронная почта"); ?>" name="user_login">
      <div class="msg-error mb10" data-name="user_login" ></div>

      <div class="auth-captcha" style="display: block;" >
        <div class="row" >
          <div class="col-lg-4 col-12" ><img src="" ></div>
          <div class="col-lg-8 col-12" ><input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Укажите код"); ?>" name="captcha"></div>
        </div>
        <div class="msg-error mb10" data-name="captcha" ></div>
      </div>

      <button class="button-style-custom schema-color-button color-green action-reg-send mt20" ><?php echo $ULang->t("Продолжить"); ?></button>

    </div>

    <div class="auth-block-right-box-tab-1-2" >
      <p class="auth-block-right-box-tab-1-2-back" > <span><i class="las la-arrow-left"></i> <?php echo $ULang->t("назад"); ?></span> </p>
      <input type="text"  class="form-control input-style2-custom" placeholder="" maxlength="4" name="user_code_login">
      <div class="msg-error mb10" data-name="user_code_login" ></div>

      <div class="auth-captcha" <?php if($_SESSION["auth_captcha"]["status"]){ echo 'style="display: block;"'; } ?> >
        <div class="row" >
          <div class="col-lg-4 col-12" ><img src="" ></div>
          <div class="col-lg-8 col-12" ><input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Укажите код"); ?>" name="captcha"></div>
        </div>
        <div class="msg-error mb10" data-name="captcha" ></div>
      </div>

      <button class="button-style-custom schema-color-button color-green action-reg-verify mt20" ><?php echo $ULang->t("Продолжить"); ?></button>                   
    </div>

    <div class="auth-block-right-box-tab-1-3" >
      <form class="reg-finish-form" enctype="multipart/form-data">

        <input type="file" name="avatar" class="form-control mb10" >
        <div class="msg-error mb10" data-name="avatar" ></div>

        <textarea class="form-control mb10" name="description" placeholder="<?php echo $ULang->t("Описание"); ?>"></textarea>
        <div class="msg-error mb10" data-name="description" ></div>

        <?php $preferences = getAll('select * from sex_preferences'); ?>
        <?php if($preferences){ ?>
          <div class="mb10 preferences-box">
            <?php foreach($preferences as $pref){ ?>
              <label class="checkbox mr10"><input type="checkbox" name="preferences[]" value="<?php echo $pref['id']; ?>"><span></span><?php echo $pref['name']; ?></label>
            <?php } ?>
          </div>
        <?php } ?>

        <input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Телефон"); ?>" name="phone">
        <div class="msg-error mb10" data-name="phone" ></div>

        <input type="password"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Пароль"); ?>" maxlength="25" name="user_pass">
        <div class="msg-error mb10" data-name="user_pass" ></div>

        <input type="text" class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Социальные сети"); ?>" name="social_links">
        <div class="msg-error mb10" data-name="social_links" ></div>

        <input type="file" name="gesture" class="form-control mb10" >
        <div class="msg-error mb10" data-name="gesture" ></div>

        <button class="button-style-custom schema-color-button color-green action-reg-finish mt20" ><?php echo $ULang->t("Завершить регистрацию"); ?></button>

      </form>
    </div>

    <?php if($settings["authorization_social"]){ ?>

    <div class="mt20" ></div>

    <p class="text-center" ><?php echo $ULang->t("или через сервисы"); ?></p>

        <div class="auth-list" >

           <?php echo $Profile->socialAuth(); ?> 

        </div>

    <?php } ?>

    <div class="clr" ></div>

</div>

<div class="auth-block-tab auth-block-tab-forgot" >

    <p class="text-center mb20" ><?php echo $ULang->t("Восстановление пароля"); ?></p>

    <input type="text" class="form-control input-style2-custom auth-forgot-login" placeholder="<?php echo $ULang->t("Телефон или электронная почта"); ?>" >
    <div class="msg-error mb10" data-name="user_recovery_login" ></div>

    <div class="auth-captcha" style="display: block;" >
      <div class="row" >
        <div class="col-lg-4 col-12" ><img src="" ></div>
        <div class="col-lg-8 col-12" ><input type="text"  class="form-control input-style2-custom" placeholder="<?php echo $ULang->t("Укажите код"); ?>" name="captcha"></div>
      </div>
      <div class="msg-error mb10" data-name="captcha" ></div>
    </div>

    <button class="button-style-custom schema-color-button color-green auth-forgot mt20" ><?php echo $ULang->t("Восстановить"); ?></button>

</div>


