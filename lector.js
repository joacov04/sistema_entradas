$(document).ready(function () {
    let valor = $('#valor').text();
    if (valor == 0) {
        console.log("es 0");
    } else {
        $('#body').addClass('usada');
        $('#boton').hide();
    }
    $('#boton').click(function () {
        let token = $('#token').text();
        $.ajax({
            url: "usada.php",
            method: "get",
            data: {
                "token": token
            },
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);

            }
        });
        
    });

    
});
