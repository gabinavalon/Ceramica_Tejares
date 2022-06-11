
    $('.like').click(function () {
        $id = $(this).attr("data-id");
        $.ajax({
            
            url: "like/" + $id,
            dataType: 'json',
            
            success: function (respuesta) {
                
                if (respuesta.resultado == 'ok') {
                    $('#likes_'+ $id).html(respuesta.likes);
                }else{
                    alert('Error, no se ha podido dar like')
                }             
            },
            error: function () {
                alert("Error en la conexión");
            },
            
        });
    });