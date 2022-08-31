$(document).ready(function() {
    ready(being_called=0)
    onCameraUpdate();
});

function ready(being_called=0) {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
        Instascan.Camera.getCameras().then(function (cameras) {
            if(being_called == 0) {
                if (cameras.length > 0) {
                    cameras.forEach(camera => {
                        $('#cameras').append(`<option value="${camera.name}">
                                               ${camera.name}
                                          </option>`);

                    });
                } else {
                  console.error('No cameras found.');
                }
            }
            let selected = $("#cameras").find((":selected")).text();
            cameras.forEach(camera => {
                if(selected.includes(camera.name)){
                    scanner.start(camera);
                }
            });
        }).catch(function (e) {
        console.error(e);
    });
    scanner.addListener('scan', function (content) {
        // seems like it scans twice. check.
        $.ajax({
            type: 'GET',
            url: content.split('/')[4],
        }).done(function(data) {
            $('body').html(data);
        }).error(function(error) {
            console.log(error);
        });
        $('#text').html(content);
    });


}

function onCameraUpdate() {
    $("#cameras").change(function () {
        ready(being_called=1);
    })
}
