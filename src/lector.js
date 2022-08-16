$(document).ready(function () {
    let valor = $('#valor').text();
    if (valor == 0) {
    } else {
        $('#body').addClass('usada');
        $('#boton').hide();
    }
    let invalid = $('#invalid').text();
    if(invalid) {
        $('#body').addClass('usada');
        $('#boton').hide();

    }
    $('#boton').click(function () {
        let token = $('#token').text();
        $.ajax({
            url: "app/usada.php",
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
