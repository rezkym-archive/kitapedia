/* Set the function is always ready to use */
$(document).ready(function(){

    /* Reload table function */
    $('#reload-table').click(function()
    {
        $('#User-Manager-Table').DataTable().ajax.reload();
        console.log('Users table reloaded')
        iziToast.success({
            title: 'Berhasil',
            message: 'Tabel pengguna berhasil diperbarui',
            position: 'topRight'
        });

    });
    
    /**
     * Show modal user input
     */
    $('#create_record').click(function(){

        $('#action').val('Add');
        $('#form_result').html('');
        $('#user-input-modal').modal('show');

    });

    /**
     * Process modal user input
     */
    $('#add_form').on('submit', function(event){
    event.preventDefault();
    var action_url = '';

    if($('#action').val() == 'Add')
    {
        action_url = "{{ route('admin.user.store') }}";
    }

    /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); */

    $.ajax({
        url: action_url,
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#action_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $('#action_button').attr('disabled', true);
        },
        success:function(data)
        {
            var html = '';
            if(data.errors)
            {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                    html += '<p>' + data.errors[count] + '</p>';
                }
                html += '</div>';
            }
            if(data.success)
            {
                $('#formModal').modal('hide');

                iziToast.success({
                    title: 'Berhasil',
                    message: data.userData + ' Berhasil ditambahkan',
                    position: 'topRight'
                });
                console.log(data.userData);

                $('#add_form')[0].reset();
                $('#User-Manager-Table').DataTable().ajax.reload();
                /* console.log('sukses'); */
            } else 
            {
                console.log('Error')
            }
            $('#form_result').html(html);

        }
    }).done(function(res){
        $('#action_button').text('Yes');
        $('#action_button').attr('disabled', false);
    });
});


/* Delete user */

var user_id;
var name;

/* Permanently Delete */
$(document).on('click', '.delete', function(){
    user_id = $(this).attr('id');
    name = $(this).attr('user-name');
    $('#ok_button').val('permanentDelete')
    $('#confirmModal').modal('show');
    $('#delete-message').html('Apakah kamu yakin ingin menghapus selamanya akun <span class="font-weight-bold" id="name_want_to_delete"></span>');
    $('#name_want_to_delete').html(name);
    

});

/* Soft Delete */
$(document).on('click', '.softDelete', function(){
    user_id = $(this).attr('id');
    name = $(this).attr('user-name');
    $('#ok_button').val('softDelete')
    $('#confirmModal').modal('show');
    $('#delete-message').html('Apakah kamu yakin ingin menghapus sementara akun <span class="font-weight-bold" id="name_want_to_delete"></span>');
    $('#name_want_to_delete').html(name);
    
});

$('#ok_button').click(function(){
    
    jQuery.ajaxSetup({
        headers: {            
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        
        }    
    });
    
    /* Check deleting type */
    if($('#ok_button').val() == 'permanentDelete')
    {
        url_ajax = 'user/'+user_id;
        method      = 'POST';
        _m          = 'DELETE';
        message     = name + ' dihapus selamanya';

    } else if($('#ok_button').val() == 'softDelete')
    {
        url_ajax    = 'user/softDelete/'+user_id;
        method      = 'GET';
        _m          = '';
        message     = name + ' dihapus sementara';

    } else 
    {
        url_ajax = 'Undefined';

    }
    
    $.ajax({
        type: method,
        dataType: 'json',
        data: {
            id: user_id,
            _method: _m
        },
        url:url_ajax,
        beforeSend:function(){
            $('#ok_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $('#ok_button').attr('disabled', true);
        },
        success:function(data)
        {
            if(data.success)
            {
                console.log(data.success);
            }
            $('#confirmModal').modal('hide');
            $('#User-Manager-Table').DataTable().ajax.reload();
            
            iziToast.success({
                title: 'Berhasil',
                message: message,
                position: 'topRight'
            });

            
        }
    }).done(function(res){
        $('#ok_button').text('Yes');
        $('#ok_button').attr('disabled', false);
    });
});
});


/* Set IDR Currency */
/* var cleaveC = new Cleave('.currency', {
numeral: true,
numeralThousandsGroupStyle: 'thousand'
}); */