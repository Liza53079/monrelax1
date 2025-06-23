<?php

$error = [];

$getUser = findOne("uni_clients", "clients_id=?", [$_SESSION['profile']['id']]);

$amount = 0;
$coins = 0;
$bonus = 0;

if(isset($_POST['package_index'])){
   $packages = $settings['coin_packages'] ? json_decode($settings['coin_packages'], true) : [];
   $country = $_SESSION['geo']['data']['country_alias'] ?? $settings['country_default'];
   if(isset($packages[$country][$_POST['package_index']])){
       $p = $packages[$country][$_POST['package_index']];
       $amount = $p['price'];
       $coins = $p['coins'];
       $bonus = $p['bonus'];
   }
}

if(!$amount){
   if($_POST["amount"]){
      $amount = round($_POST["amount"],2);
   }elseif($_POST["change_amount"]){
      $amount = round($_POST["change_amount"],2);
   }
}

if(!$_POST["payment"]){
   $error[] = $ULang->t("Пожалуйста, выберите способ оплаты");
}

if(!$amount){
   $error[] = $ULang->t("Пожалуйста, укажите сумму пополнения");
}else{

    if( $amount < round($settings["min_deposit_balance"], 2) ){
       $error[] = $ULang->t("Минимальная сумма пополнения") . " " . $Main->price($settings["min_deposit_balance"]);
    }elseif( $amount > round($settings["max_deposit_balance"], 2) ){
       $error[] = $ULang->t("Максимальная сумма пополнения") . " " . $Main->price($settings["max_deposit_balance"]);
    }

}

if(!$error){

 $answer = $Profile->payMethod( $_POST["payment"], array( "amount" => $amount, "name" => $getUser["clients_name"], "email" => $getUser["clients_email"], "phone" => $getUser["clients_phone"], "id_order" => generateOrderId(), "id_user" => $_SESSION['profile']['id'], "action" => "balance", "title" => $static_msg["19"] . " - " . $settings["site_name"], "coins"=>$coins, "bonus"=>$bonus ) );

  echo json_encode( array( "status" => true, "redirect" => $answer, "coins"=>$coins, "bonus_chats"=>$bonus ) );

}else{

  echo json_encode( array( "status" => false, "answer" => implode("\n", $error) ) );

}

?>