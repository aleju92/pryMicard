/**
 * Created by angelo on 29/01/17.
 *
 * Miiperfil
 */

$(document).ready(function () {
    $(document).on('click','#btnVet',function (e) {
        e.preventDefault();

        console.log($('#txtPass').val());
        $.ajax({
            method:"POST",
            url:Routing.generate('SaAdmPass'),
            data:{idUser:3,passText:$('#txtPass').val()},
            dataType:'json',
            success: function (data)
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

                //$('#table-wrapper').html(data.lista_comentarios_html); // actualizo la tabla
            },
            error: function (jqXHR, exception)
            {
                if (jqXHR.status === 405)
                {
                    console.error("METHOD NOT ALLOWED!");
                }
            }
        });
    });
});