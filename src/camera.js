function ready(being_called=0) {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
    scanner.addListener('scan', function (content) {
        // seems like it scans twice. check.
        $('#text').text(content);
        alert(content);
    });
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

}

$(document).ready(ready(being_called=0))
$("#cameras").change(function () {
    ready(being_called=1);
})
