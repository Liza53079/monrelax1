<?php 

$value = $Ads->getDataAd($value);

$images = $Ads->getImages($value["ads_images"]);
$service = $Ads->adServices($value["ads_id"]);
$getShop = $Shop->getUserShop($value["ads_id_user"]);

?>
<div class="<?php if($settings["home_sidebar_status"]){ echo 'col-lg-3 col-md-3 col-sm-6 col-6'; }else{ echo 'col-lg-2 col-md-3 col-sm-3 col-6'; } ?>" >
  <div class="item-grid" title="<?php echo $value["ads_title"]; ?>" >
     <div class="item-grid-img" >
     <a href="<?php echo $Ads->alias($value); ?>" title="<?php echo $value["ads_title"]; ?>" target="_blank" >

       <div class="item-labels" >
          <?php echo $Ads->outStatus([], $value); ?>
       </div>

       <?php echo $Ads->CatalogOutAdGallery($images, $value); ?>

     </a>
     <?php echo $Ads->adActionFavorite($value, "catalog", "item-grid-favorite"); ?>
     </div>
     <div class="item-grid-info" >

        <div class="item-grid-price" >
         <?php
               echo $Ads->outPrice( [ "data"=>$value,"class_price"=>"item-grid-price-now","class_price_old"=>"item-grid-price-old", "shop"=>$getShop, "abbreviation_million" => true ] );
         ?>        
        </div>
        <a href="<?php echo $Ads->alias($value); ?>" target="_blank" ><?php echo custom_substr($value["ads_title"], 35, "..."); ?></a>

        <span class="item-grid-city" >
         <?php 
             echo $Ads->outAdAddressArea($value);
         ?>
        </span>
        <span class="item-grid-date" ><?php echo datetime_format($value["ads_datetime_add"], false); ?></span>

     </div>
  </div>
</div>