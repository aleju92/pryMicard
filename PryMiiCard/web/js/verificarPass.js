/**
 * Created by angelo on 29/01/17.
 *
 * Miiperfil
 */

$(document).ready(function () {
    $(document).on('click','#btnVet',function (e) {
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:Routing.generate('SaAdmPass'),
            data:{idUser:3,passText:$('#txtPass').val()},
            dataType:'json',
            success: function (data,jqXHR)
            {
                if(data.typems == "danger"){
                    var ms= "<div class= 'flash-success alert alert-"+data.typems+"'  role='alert'>";
                    ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                    ms+="<span aria-hidden='true'>x</span></button>";
                    ms+=data.mensaje;
                    ms+="</div>";
                    $('#mensaje').html(ms); // presento el mensaje
                }else{
                            $('#modal').html(data.Form);
                             $('#modalPassword').modal('show');

                }
            },
            error: function (jqXHR,textStatus, errorThrown, exception)
            {
                var ms= "<div class= 'flash-success alert alert-danger'  role='alert'>";
                ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                ms+="<span aria-hidden='true'>x</span></button>";
                ms+="No se puedo hacer conectar al servidor ";
                ms+="</div>";
                $('#mensaje').html(ms); // presento el mensaje
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
                console.log(data.message);
                console.log(data.pass);
                console.log(data.id);
            },
            error: function(data){}
        });
    });
});