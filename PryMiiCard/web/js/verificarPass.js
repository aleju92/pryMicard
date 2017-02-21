/**
 * Created by angelo on 29/01/17.
 *
 * Miiperfil
 */

$(document).ready(function () {
        $('#formV').submit(function (e) {
            e.preventDefault();
            $.ajax({
                method:"POST",
                url:Routing.generate('SaAdmPass'),
                data:{pass:$('#formV_PasswordTemp').val() },
                dataType:'json',
                success: function (data) {
                    if(data.typems == "danger"){
                        var ms= "<div class= 'flash-success alert alert-"+data.typems+"'  role='alert'>";
                        ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                        ms+="<span aria-hidden='true'>x</span></button>";
                        ms+=data.mensaje;
                        ms+="</div>";
                        $('#mensaje').html(ms); // presento el mensaje
                        console.log(data.passw);
                    }else{
                        $('#modal').html(data.Form);
                        $('#modalPassword').modal('show');
                    }
                },
                error: function () {

                }
            });
        });

    $(document).on('click','#form_cambiar',function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: Routing.generate('SaAdmPassEdit'),
            data: $('#Form1').serialize(),
            dataType:'json',
            success: function (data,jqXHR)
            {
                var modal;
                var ico;
                if(data.typems != "danger"){
                    $('#modalPassword').modal('hide');
                    modal="#mensaje";
                    ico="<i class='fa fa-check fa-2x' aria-hidden='true'></i>";
                }else{
                    modal="#MensajeModal";
                    ico="<i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i>";
                    $('#form_PasswordTemp_first').val('');
                    $('#form_PasswordTemp_second').val('');
                }
                var ms= "<div class= 'flash-success alert alert-"+data.typems+"'  role='alert'>";
                ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                ms+="<span aria-hidden='true'>x</span></button>";
                ms+=ico;
                ms+=data.mensaje;
                ms+="</div>";
                $(modal).html(ms);

            },
            error: function(data){}
        });
    });
});