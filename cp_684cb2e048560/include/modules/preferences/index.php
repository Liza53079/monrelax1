<?php
if( !defined('unisitecms') ) exit;

$prefs = getAll("SELECT * FROM sex_preferences ORDER BY id DESC");
?>
<div class="row">
   <div class="page-header">
      <div class="d-flex align-items-center">
         <h2 class="page-header-title">Сексуальные предпочтения</h2>
      </div>
   </div>
</div>

<div class="form-group">
<a href="#modal-pref-add" data-toggle="modal" class="btn btn-gradient-04 mr-1 mb-2">Добавить</a>
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="widget has-shadow">
         <div class="widget-body">
            <div class="table-responsive">
               <?php if(count($prefs)){ ?>
               <table class="table mb-0">
                 <thead>
                   <tr>
                     <th>Название</th>
                     <th style="text-align: right;"></th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php foreach($prefs as $value){ ?>
                   <tr>
                     <td><?php echo $value['name']; ?></td>
                     <td class="td-actions" style="text-align: right;">
                        <a class="load-edit-pref" data-id="<?php echo $value['id']; ?>"><i class="la la-edit edit"></i></a>
                        <a href="#" class="delete-pref" data-id="<?php echo $value['id']; ?>"><i class="la la-close delete"></i></a>
                     </td>
                   </tr>
                   <?php } ?>
                 </tbody>
               </table>
               <?php }else{ ?>
               <div class="plug">
                  <i class="la la-exclamation-triangle"></i>
                  <p>Предпочтений нет</p>
               </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="modal-pref-add" class="modal fade">
   <div class="modal-dialog" style="max-width: 650px;">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Добавить</h4>
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">close</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="form-data-pref-add" method="post">
               <div class="form-group row d-flex align-items-center mb-5">
                  <label class="col-lg-3 form-control-label">Название</label>
                  <div class="col-lg-9">
                     <input type="text" class="form-control" name="name">
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-shadow" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary action-pref-add">Добавить</button>
         </div>
      </div>
   </div>
</div>

<div id="modal-pref-edit" class="modal fade">
   <div class="modal-dialog" style="max-width: 650px;">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Редактировать</h4>
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
            <span class="sr-only">close</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="form-data-pref-edit" method="post"></form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-shadow" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary action-pref-edit">Сохранить</button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" src="include/modules/preferences/script.js"></script>
<?php
?>
