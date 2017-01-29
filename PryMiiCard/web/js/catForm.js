/**
 * Created by angelo on 22/01/17.
 * Borrar datos por Ajax
 */
$(document).ready(
    function () {
        $('.deleteCat').on('click',function (e) {
            e.preventDefault();
            console.log($(this).attr('value'));
        })
    }
);