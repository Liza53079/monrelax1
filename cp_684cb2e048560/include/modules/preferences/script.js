$(document).ready(function(){
    $.getScript('files/js/javascript.js');

    $(document).on('click','.action-pref-add', function(e){
        $('.proccess_load').show();
        $.ajax({type:'POST',url:'include/modules/preferences/handlers/add.php',data:$('.form-data-pref-add').serialize(),dataType:'html',cache:false,success:function(data){
            if(data==true){ location.reload(); }else{ $('.proccess_load').hide(); notification(); }
        }});
        e.preventDefault();
    });

    $(document).on('click','.load-edit-pref', function(e){
        var id = $(this).data('id');
        $.ajax({type:'POST',url:'include/modules/preferences/handlers/load_edit.php',data:'id='+id,dataType:'html',cache:false,success:function(data){
            $('.form-data-pref-edit').html(data); $('#modal-pref-edit').modal('show');
        }});
        e.preventDefault();
    });

    $(document).on('click','.action-pref-edit', function(e){
        $('.proccess_load').show();
        $.ajax({type:'POST',url:'include/modules/preferences/handlers/edit.php',data:$('.form-data-pref-edit').serialize(),dataType:'html',cache:false,success:function(data){
            if(data==true){ location.reload(); }else{ $('.proccess_load').hide(); notification(); }
        }});
        e.preventDefault();
    });

    $(document).on('click','.delete-pref', function(e){
        var id = $(this).data('id');
        swal({title:'Вы действительно хотите выполнить удаление?',type:'warning',showCancelButton:true,confirmButtonColor:'#3085d6',cancelButtonColor:'#d33',confirmButtonText:'Да',cancelButtonText:'Нет'}).then((result)=>{
            if(result.value){
                $('.proccess_load').show();
                $.ajax({type:'POST',url:'include/modules/preferences/handlers/delete.php',data:'id='+id,dataType:'html',cache:false,success:function(data){ if(data==true){ location.reload(); }else{ $('.proccess_load').hide(); notification(); } }});
            }
        });
        e.preventDefault();
    });
});
