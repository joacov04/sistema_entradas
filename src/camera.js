function ready() {
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
                console.log(camera.name);
                console.log(selected);
                if(selected.includes(camera.name)){
                    scanner.start(camera);
                }
            });
        } else {
          console.error('No cameras found.');
        }
        }).catch(function (e) {
        console.error(e);
    });

}

$(document).ready(ready)
$("#cameras").change(function () {
    scanner.stop();
    ready();

})
