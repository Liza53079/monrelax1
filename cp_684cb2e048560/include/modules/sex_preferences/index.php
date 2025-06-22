<?php
if( !defined('unisitecms') ) exit;

$LINK = '?route=sex_preferences';
?>

<div class="row">
   <div class="page-header">
      <div class="d-flex align-items-center">
         <h2 class="page-header-title">Сексуальные предпочтения</h2>
      </div>
   </div>
</div>

<div class="form-group">
 <a href="#modal-preference-add" data-toggle="modal" class="btn btn-gradient-04 mr-1 mb-2">Добавить</a>
</div>

<div class="row" >
   <div class="col-lg-12" >
      <div class="widget has-shadow">
         <div class="widget-body">
            <div class="table-responsive">
                 <?php
                    $items = getAll("SELECT * FROM sex_preferences ORDER BY name ASC");
                    if(count($items) > 0){
                 ?>
                     <table class="table mb-0">
                        <thead>
                           <tr>
                            <th>Название</th>
                            <th style="text-align: right;"></th>
                           </tr>
                        </thead>
                        <tbody>
                     <?php
                        foreach($items AS $item){
                     ?>
                         <tr>
                             <td><?php echo $item["name"]; ?></td>
                             <td class="td-actions" style="text-align: right;" >
                              <a class="load-edit-preference" data-id="<?php echo $item['id']; ?>" ><i class="la la-edit edit"></i></a>
                              <a href="#" class="delete-preference" data-id="<?php echo $item['id']; ?>" ><i class="la la-close delete"></i></a>
                             </td>
                         </tr>
                     <?php
                        }
                     ?>
                           </tbody>
                        </table>
                 <?php
                    }else{
                 ?>
                        <div class="plug" >
                           <i class="la la-exclamation-triangle"></i>
                           <p>Записей нет</p>
                        </div>
                 <?php
                    }
                 ?>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="modal-preference-add" class="modal fade">
   <div class="modal-dialog" style="max-width: 650px;" >
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Добавить предпочтение</h4>
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">close</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="form-data-preference-add" >
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control" name="name" >
                </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-shadow" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary action-preference-add">Добавить</button>
         </div>
      </div>
   </div>
</div>

<div id="modal-preference-edit" class="modal fade">
   <div class="modal-dialog" style="max-width: 650px;" >
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Редактирование</h4>
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">close</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="form-data-preference-edit"></form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-shadow" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary action-preference-edit">Сохранить</button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" src="include/modules/sex_preferences/script.js"></script>
