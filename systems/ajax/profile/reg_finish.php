<?php

$error = [];

$user_login = clear( $_POST["user_login"] );
$user_age = (int)$_POST["user_age"];
$user_gender = clear($_POST["user_gender"]);
$user_role = clear($_POST["user_role"]);
$user_city = clear($_POST["user_city"]);
$user_email_field = clear($_POST["user_email"]);
$user_photo = clear($_POST["user_photo"]);
$user_description = clear($_POST["user_description"]);
$user_preferences = clear($_POST["user_preferences"]);
$user_phone_unique = clear($_POST["user_phone"]);
$user_social = clear($_POST["user_social"]);
$user_gesture = clear($_POST["user_gesture"]);

$user_name = clear( $_POST["user_name"] );
$user_code_login = (int)$_POST["user_code_login"];
$user_pass = clear( $_POST["user_pass"] );

if($settings["registration_method"] == 1){

$user_phone = formatPhone($_POST["user_login"]);
$validatePhone = validatePhone($user_phone);

if(!$validatePhone['status']){
  exit(json_encode(array("status"=>false, "reload" => true)));
}

}elseif($settings["registration_method"] == 2){

  if(!$user_login){
      exit(json_encode(array("status"=>false, "reload" => true)));
  }else{
      if( strpos($user_login, "@") !== false ){

        if(validateEmail( $user_login ) == false){
            exit(json_encode(array("status"=>false, "reload" => true)));
        }else{
            $user_email = $user_login; 
        }

      }else{

        $user_phone = formatPhone($_POST["user_login"]);
        $validatePhone = validatePhone($user_phone);

        if(!$validatePhone['status']){
            exit(json_encode(array("status"=>false, "reload" => true)));
        }

      }         
  }

}elseif($settings["registration_method"] == 3){

  if(validateEmail( $user_login ) == false){
      exit(json_encode(array("status"=>false, "reload" => true)));
  }else{
      $user_email = $user_login; 
  }

}

if(!$_SESSION["verify_login"][$user_login]["code"] || $_SESSION["verify_login"][$user_login]["code"] != $user_code_login){
  if($user_email){
     exit(json_encode(array("status"=>false, "reload" => true)));
  }else{
     if($settings["confirmation_phone"]){
        exit(json_encode(array("status"=>false, "reload" => true))); 
     }             
  }
}

if( mb_strlen($user_pass, "UTF-8") < 6 || mb_strlen($user_pass, "UTF-8") > 25 ){
 $error['user_pass'] = $ULang->t("Пожалуйста, укажите пароль от 6-ти до 25 символов.");
}

if(!$user_name){
 $error['user_name'] = $ULang->t("Пожалуйста, укажите Ваше имя");
}

if( !$error ){

 $result = $Profile->auth_reg([
    "method"=>$settings["registration_method"],
    "email"=>$user_email,
    "phone"=>$user_phone,
    "name"=>$user_name,
    "activation" => 0,
    "pass" => $user_pass,
    "age"=>$user_age,
    "gender"=>$user_gender,
    "role"=>$user_role,
    "city"=>$user_city,
    "email_field"=>$user_email_field,
    "photo"=>$user_photo,
    "description"=>$user_description,
    "preferences"=>$user_preferences,
    "phone_unique"=>$user_phone_unique,
    "social_links"=>$user_social,
    "gesture"=>$user_gesture
 ]);

 echo json_encode( array( "status"=>$result["status"],"answer" => $result["answer"], "reg" => 1, "location" => _link( "user/".$result["data"]["clients_id_hash"] ) ) );

 unset($_SESSION["verify_login"]);

}else{

 echo json_encode(array("status"=>false, "answer" => $error));

}

?>