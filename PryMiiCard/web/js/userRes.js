/**
 * Created by tatiana on 14/02/17.
 *
 * UserProm
 */
$(document).ready(function () {
    $(document).on('click','#reservas',function (e) {
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:Routing.generate('reserv_us'),
            data:{id: $(this).attr('value')},
            dataType:'json',
            success: function (data)
            {
            	 /*if(data.tymes == "success"){
                     var ms= "<div class= 'flash-success alert alert-"+data.tymes+"'  role='alert'>";
                     ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                     ms+="<span aria-hidden='true'>x</span></button>";
                     ms+=data.mensaje;
                     ms+="</div>";
                     $('#mensaje').html(ms);*/
            	
            		$('#tablediv').html(data.promos_html); // presento el mensaje
                    console.log(data.promos_html);
                 //}
            },
            error: function (jqXHR,exception)
            {
            }
        });
    });
})