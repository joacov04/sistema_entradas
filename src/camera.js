$(document).ready(function () {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
    scanner.addListener('scan', function (content) {
        console.log(content);
        $('#text').val(content)
    });
        Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            cameras.forEach(camera => {
                $('#cameras').append(`<option value="${camera.name}">
                                       ${camera.name}
                                  </option>`);
                console.log(camera.id);

            });
            console.log(cameras);
            let selected = $("#cameras").find((":selected")).text();
            cameras.forEach(camera => {
                if(camera.name == selected){
                    scanner.start(camera);
                }
            });
        } else {
          console.error('No cameras found.');
        }
        }).catch(function (e) {
        console.error(e);
    });
});
