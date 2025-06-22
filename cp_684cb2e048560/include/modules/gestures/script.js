$(document).ready(function(){
    $.getScript('files/js/javascript.js');

    $(document).on('click','.action-gesture-add', function(e){
        var form = $('.form-data-gesture-add')[0];
        var data = new FormData(form);
        $('.proccess_load').show();
        $.ajax({type:'POST',url:'include/modules/gestures/handlers/add.php',data:data,contentType:false,processData:false,dataType:'html',cache:false,success:function(data){if(data==true){location.reload();}else{$('.proccess_load').hide();notification();}}});
        e.preventDefault();
    });

    $(document).on('click','.load-edit-gesture', function(e){
        $.ajax({type:'POST',url:'include/modules/gestures/handlers/load_edit.php',data:'id='+$(this).data('id'),dataType:'html',cache:false,success:function(data){$('.form-data-gesture-edit').html(data);$('#modal-gesture-edit').modal('show');}});
        e.preventDefault();
    });

    $(document).on('click','.action-gesture-edit', function(e){
        var form = $('.form-data-gesture-edit')[0];
        var data = new FormData(form);
        $('.proccess_load').show();
        $.ajax({type:'POST',url:'include/modules/gestures/handlers/edit.php',data:data,contentType:false,processData:false,dataType:'html',cache:false,success:function(data){$('.proccess_load').hide();notification();}});
        e.preventDefault();
    });

    $(document).on('click','.delete-gesture', function(){
        var id = $(this).data('id');
        swal({title:'Вы действительно хотите выполнить удаление?',type:'warning',showCancelButton:true,confirmButtonColor:'#3085d6',cancelButtonColor:'#d33',confirmButtonText:'Да',cancelButtonText:'Нет'}).then((result)=>{if(result.value){$('.proccess_load').show();$.ajax({type:'POST',url:'include/modules/gestures/handlers/delete.php',data:'id='+id,dataType:'html',cache:false,success:function(data){if(data==true){location.reload();}else{$('.proccess_load').hide();notification();}}});}});
        return false;
    });
});
