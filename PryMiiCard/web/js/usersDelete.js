/**
 * Created by angelo on 29/01/17.
 *
 * Userlist
 */

$(document).ready(function () {
    $(document).on('click','#btndelete',function (e) {
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:Routing.generate('delete_User'),
            data:{id: $(this).attr('value')},
            dataType:'json',
            success: function (data)
            {
                if(data.tymes == "success"){
                    var ms= "<div class= 'flash-success alert alert-"+data.tymes+"'  role='alert'>";
                    ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                    ms+="<span aria-hidden='true'>x</span></button>";
                    ms+=data.mensaje;
                    ms+="</div>";
                    $('#mensaje').html(ms);
                    $('#tablediv').html(data.userlist_html); // presento el mensaje
                    console.log(data.passw);
                }
            },
            error: function (jqXHR,exception)
            {
            }
        });
    });
    $(document).on('click','#btnPass',function (e) {
        e.preventDefault();
        var pass=$('#txtPassw').val();
        if(pass.length>5 || pass.match(/[A-z]/) || pass.match(/\d/) || pass.match(/[A-Z]/) ){

        }else{
            $('#formpass').addClass('has-error has-feedback');
            $('#txtPassw').attr('for','inputError2');
            
        }

    })
});