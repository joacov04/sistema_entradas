$(document).ready(function() {
    ready(being_called=0)
    onCameraUpdate();

    $('.modal').click(function() {
        $('.modal').css('display', 'none');
    });

    $('body').click(function() {
        $('.modal').css('display', 'none');
    });

});

function ready(being_called=0) {
    $('.modal').css("display", "none");
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false, backgroundScan: false });
        Instascan.Camera.getCameras().then(function (cameras) {
            //if(being_called == 0) {
            //    if (cameras.length > 0) {
            //        cameras.forEach(camera => {
            //            $('#cameras').append(`<option value="${camera.id}">
            //                                   ${camera.name}
            //                              </option>`);

            //        });
            //    } else {
            //      console.error('No cameras found.');
            //    }
            //}
            let selected = $("#cameras").find((":selected")).val();
            //$('#tx').html(selected)
            scanner.start(cameras[cameras.length-1])
            //cameras.forEach(camera => {
            //$('#tx').html("entro al for")
            //    if(selected.includes(camera.id)){
            //        $('#tx').html("entro al if")
            //        scanner.stop().then(function() {
            //            $('#tx').html("en funcion stop")
            //            scanner.start(camera).then(function() {
            //                $('#tx').html("abrio camera")
            //            }).catch(function(e) {

            //                $('#tx').html("error: "+e);
            //            });

            //        }).catch(function (e) {
            //            $('#tx').html("error: "+e);

            //        });
            //    }
            //});
        }).catch(function (e) {
        console.error(e);
    });
    scanner.addListener('scan', function (content) {
        $('.modal').css({"display": "block", "background-color": "orange"});
        $('#modal_name').html("CARGANDO");
        $('#modal_token').html("");
        $('#modal_usada').html("");
        token = content;
        $.ajax({
            type: 'GET',
            url: 'getTokenInfo.php?token=' + token,

            success: function(data) {
                if(data != 2) {
                    token_info = JSON.parse(data);
                    token_info.usada == 1 ? color = "var(--softRed)" : color = "var(--softGreen)";
                    token_info.usada == 1 ? msg = "Entrada ya utilizada." : msg = "OK";
                    $('.modal').css({"display": "block", "background-color": color});
                    $('#modal_name').html(token_info.nombre);
                    $('#modal_token').html(token_info.token);
                    $('#modal_usada').html(msg);
                    $.ajax({
                        type: 'GET',
                        url: 'usada.php?token='+token,
                        success: function(data) {
                            console.log("entrada usada: "+ data);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });

                // token not found
                } else {
                    $('#modal_name').html("ENTRADA INVALIDA");
                    $('#modal_token').html("");
                    $('#modal_usada').html("");
                    $('.modal').css({"display": "block", "background-color": "var(--softRed)"});
                }
            },
            error: function(data) {
                console.log(data);
            },
        });

    });


}

function onCameraUpdate() {
    $("#cameras").change(function () {
        ready(being_called=1);
    })
}
$(document).ajaxStop(function() {
    //$('#xd').css('display', 'none');
    console.log('a');
});
