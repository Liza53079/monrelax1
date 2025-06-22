$(document).ready(function(){
    $.getScript('files/js/javascript.js');

    $(document).on('click','.action-preference-add', function(e){
        $('.proccess_load').show();
        $.ajax({type:'POST',url:'include/modules/sex_preferences/handlers/add.php',data:$('.form-data-preference-add').serialize(),dataType:'html',cache:false,success:function(data){if(data==true){location.reload();}else{$('.proccess_load').hide();notification();}}});
        e.preventDefault();
    });

    $(document).on('click','.load-edit-preference', function(e){
        $.ajax({type:'POST',url:'include/modules/sex_preferences/handlers/load_edit.php',data:'id='+$(this).attr('data-id'),dataType:'html',cache:false,success:function(data){$('.form-data-preference-edit').html(data);$('#modal-preference-edit').modal('show');}});
        e.preventDefault();
    });

    $(document).on('click','.action-preference-edit', function(e){
        $('.proccess_load').show();
        $.ajax({type:'POST',url:'include/modules/sex_preferences/handlers/edit.php',data:$('.form-data-preference-edit').serialize(),dataType:'html',cache:false,success:function(data){$('.proccess_load').hide();notification();}});
        e.preventDefault();
    });

    $(document).on('click','.delete-preference', function(){
        var id = $(this).data('id');
        swal({title:'Вы действительно хотите выполнить удаление?',type:'warning',showCancelButton:true,confirmButtonColor:'#3085d6',cancelButtonColor:'#d33',confirmButtonText:'Да',cancelButtonText:'Нет'}).then((result)=>{if(result.value){$('.proccess_load').show();$.ajax({type:'POST',url:'include/modules/sex_preferences/handlers/delete.php',data:'id='+id,dataType:'html',cache:false,success:function(data){if(data==true){location.reload();}else{$('.proccess_load').hide();notification();}}});}});
        return false;
    });
});
