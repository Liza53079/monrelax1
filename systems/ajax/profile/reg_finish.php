<?php

global $Main, $config;

$error = [];

$user_login = clear( $_POST["user_login"] );
$user_code_login = (int)$_POST["user_code_login"];
$user_pass = clear( $_POST["user_pass"] );
$phone = formatPhone($_POST["phone"]);
$description = clear($_POST["description"]);
$social_links = clear($_POST["social_links"]);
$preferences = isset($_POST['preferences']) ? $_POST['preferences'] : [];

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

$validatePhone = validatePhone($phone);
if(!$validatePhone['status']){
  $error['phone'] = $validatePhone['error'];
}

$avatar = $Main->uploadedImage(["files"=>$_FILES['avatar'], "path"=>$config['media']['avatar'], "prefix_name"=>'avatar']);
if($avatar['error']){
  $error['avatar'] = implode("\n", $avatar['error']);
}
$avatar_name = $avatar['name'];

$gesture = $Main->uploadedImage(["files"=>$_FILES['gesture'], "path"=>$config['media']['user_attach'], "prefix_name"=>'gesture']);
if($gesture['error']){
  $error['gesture'] = implode("\n", $gesture['error']);
}
$gesture_name = $gesture['name'];


if( !$error ){

 $result = $Profile->auth_reg(array("method"=>$settings["registration_method"],"email"=>$user_email,"phone"=>$phone,"name"=>$_SESSION['reg_data']['name'], "activation" => 0, "pass" => $user_pass, "avatar"=>$avatar_name));

 if($result['status']){
   update("UPDATE uni_clients SET gender=?, role=?, preferred_gender=?, age=?, city=?, description=?, verify_photo=?, verify_gesture=?, social_links=?, is_email_verified=?, is_phone_verified=?, phone=?, clients_status=0 WHERE clients_id=?", [
     $_SESSION['reg_data']['gender'],
     $_SESSION['reg_data']['role'],
     $_SESSION['reg_data']['looking_for'],
     $_SESSION['reg_data']['age'],
     $_SESSION['reg_data']['city'],
     $description,
     $avatar_name,
     $gesture_name,
     $social_links,
     intval($_SESSION['reg_data']['email_verified']),
     0,
     $phone,
     $result['data']['clients_id']
   ]);

   if($preferences){
     foreach($preferences as $pref){
       insert("INSERT INTO user_sex_preferences(user_id,preference_id) VALUES(?,?)", [$result['data']['clients_id'], intval($pref)]);
     }
   }

   echo json_encode( array( "status"=>true, "reg" => 1, "location" => _link( "user/".$result["data"]["clients_id_hash"] ) ) );

   unset($_SESSION["verify_login"]);
   unset($_SESSION['reg_data']);
 }else{
   echo json_encode(array("status"=>false, "answer" => $result['answer']));
 }

}else{

 echo json_encode(array("status"=>false, "answer" => $error));

}

?>