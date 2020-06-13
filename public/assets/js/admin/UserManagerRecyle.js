/* Set the function is always ready to use */
$(document).ready(function(){
    /* Reload table function */
    $('#reload-table').click(function()
    {
        $('#User-Manager-recyle-Table').DataTable().ajax.reload();
        console.log('Users table reloaded')
        iziToast.success({
            title: 'Berhasil',
            message: 'Tabel pengguna berhasil diperbarui',
            position: 'topRight'
        });

    });

    /* Delete user */

    var user_id;
    var name;

    /* Permanently Delete */
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        name = $(this).attr('user-name');
        $('#confirm').val('permanentDelete')
        $('#action-modal').modal('show');
        $('#modal-title').text('Hapus Pengguna');
        $('#action-message').html('Apakah kamu yakin ingin menghapus selamanya akun <span class="font-weight-bold" id="name-delete-permanent"></span>');
        $('#name-delete-permanent').html(name);

    });

    /* Restore Account */
    $(document).on('click', '.restore', function(){
        user_id = $(this).attr('id');
        name = $(this).attr('user-name');
        $('#confirm').val('restoreAccount')
        $('#action-modal').modal('show');
        $('#modal-title').text('Pulihkan Akun');
        $('#action-message').html('Pulihkan akun <span class="font-weight-bold" id="name-restore"></span>');
        $('#name-restore').html(name);

    });

    /* Restore Account */
    $(document).on('click', '.delete_recyle', function(){
        $('#confirm').val('deleteRecyle')
        $('#action-modal').modal('show');
        $('#modal-title').text('Hapus Pengguna');
        $('#action-message').html('Apakah kamu yakin ingin menghapus semua akun di tong sampah? ');

    });

    $('#confirm').click(function(event){
        event.preventDefault();
        action_url = '';
        
        
        /* jQuery.ajaxSetup({
            headers: {            
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        
            }    
        }); */
        
        /* Check deleting type */
        if($('#confirm').val() == 'permanentDelete')
        {
            action_url    = '/admin/manager/user/'+user_id;
            method      = 'POST';
            _m          = 'DELETE';
            message     = name + ' dihapus selamanya';

        } else if($('#confirm').val() == 'restoreAccount')
        {
            action_url    = '/admin/manager/restore/user/'+user_id;
            method      = 'GET';
            _m          = '';
            message     = name + ' di pulihkan';

        } else if($('#confirm').val() == 'deleteRecyle')
        {
            action_url    = '/admin/manager/recyle/d/user/';
            method      = 'GET';
            _m          = '';
            message     = '';

        } else 
        {
            action_url = 'Undefined';

        }
        
        $.ajax({
            type: method,
            dataType: 'json',
            data: {
                id: user_id,
                _method: _m
            },
            url:action_url,
            beforeSend:function(){
                $('#confirm').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $('#confirm').attr('disabled', true);
            },
            success:function(data)
            {
                if(data.success)
                {
                    console.log(data.success);
                
                    $('#action-modal').modal('hide');
                    $('#User-Manager-recyle-Table').DataTable().ajax.reload();
                    
                    iziToast.success({
                        title: 'Berhasil',
                        message: data.success,
                        position: 'topRight'
                    });

                } else 
                {
                    iziToast.error({
                        title: 'Gagal',
                        message: ' Kesalahan pada sistem #umRecyle.js<<133',
                        position: 'topRight'
                    });
                }

                
            }
        }).done(function(res){
            $('#confirm').text('Yes');
            $('#confirm').attr('disabled', false);
        });
    });
});
