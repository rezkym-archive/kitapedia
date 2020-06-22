$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#settings').submit(function(e){
        e.preventDefault(); // nonaktifkan default submit
        $('#save-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $('#save-btn').attr('disabled', true);
        var action = $(this).attr('action');

        $.ajax({
            method:"POST",
            url: action, 
            data: $(this).serialize(),
            dataType: 'json',
        }).done((res) => 
        {
            
        
            //console.log(res);
            $('#save-btn').html('Simpan');
            $('#save-btn').removeAttr('disabled');
        
            console.log('Sukses?');
            console.log(res.message);
        
            if(res.status === true)
            {
                /**
                 * Is Logout?
                 */
                if(res.isLogout)
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Yeayy',
                        html: res.result,
                        type: 'success',
                        confirmButtonColor: '#34A853'
                    }).then(() => {
                        location.reload();
                    });
                }

                /**
                 * Success notification
                 */
                iziToast.success({
                    title: 'Yeayy!!',
                    message: res.message,
                    position: 'topRight'
                });

                $('.profileName').text(res.result.name);
                $('.profileName').text(res.result.name);
                $('.profileEmail').text(res.result.email);
                $('.profileNohp').text(res.result.nohp);

            } else if(res.status === false)
            {
                var text = '';
                for(var count = 0; count < res.result.length; count++)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oppss...',
                        html: text += '<li>' + res.result[count] + '</li>',
                        type: 'warning',
                        confirmButtonColor: '#EF3D58'
                    });
                }

            } else
            {
                Swal.fire({
                    title: 'Gagal', // php
                    text: 'Terjadi kesalahan',
                    type: 'warning',
                    confirmButtonColor: '#EF3D58'
                })
            }
        }).fail(() => {
            $('#save-btn').html('Simpan');
            $('#save-btn').removeAttr('disabled');
            Swal.fire({
                icon: 'error',
                title: 'Oppss...',
                text: 'Ada kesalahan nih, refresh dulu yukk...',
                type: 'warning',
                confirmButtonColor: '#EF3D58'

            }).then(() =>{
                location.reload();
            });
        });

    });
    
});  
    
function profileUpdate()
{
    Swal.fire({
        icon: 'error',
        title: 'Oppss...',
        text: 'Kita sedang memperbarui ini, coba lagi nanti yaaa...',
    })
}