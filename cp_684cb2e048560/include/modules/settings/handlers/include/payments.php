<?php

$_POST["payment_variant"] = $_POST["payment_variant"] ?: [];

update("UPDATE uni_settings SET value=? WHERE name=?", array(implode(",",$_POST["payment_variant"]),'payment_variant'));

if(isset($_POST["payment_param"])){

   $param = json_encode($_POST["payment_param"]);
   $param = encrypt($param);
   update("UPDATE uni_payments SET param=? WHERE code = ?", array($param,$_POST["payment"]));

}

if(isset($_POST['coin_packages'])){
   $packages = [];
   foreach (explode("\n", $_POST['coin_packages']) as $line){
       $line = trim($line);
       if(!$line) continue;
       list($country,$coins,$price,$bonus) = array_map('trim', explode('|',$line) + [null,null,null,null]);
       if($country !== null){
           $packages[$country][] = ['coins'=>(int)$coins,'price'=>(float)$price,'bonus'=>(int)$bonus];
       }
   }
   update("UPDATE uni_settings SET value=? WHERE name=?", array(json_encode($packages),'coin_packages'));
}

?>