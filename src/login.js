$(document).ready(function(){
    $('#submit').click(function (e) {
        e.preventDefault();
        let user = $('#mail').val();
        let pass = $('#pswd').val();

        $.ajax({
            url: "api/login.php",
            method: 'post',
            data: {
                'mail': user,
                'pass': pass
            },
            success: function(data) {
                let result = JSON.parse(data)
                console.log("success:");
                console.log(result);
                if(result.error) {
                    console.log('error: ' + result.error);
                    alert(result.error);
                } else {
                    document.cookie="token="+result.access_token+";SameSite=None;secure;";
                    window.location.replace('/entradas');
                }
            },
            complete: function(data) {
                //console.log('complete: '+data);
            },
            error: function(data) {
                console.log(data);
            }
    
        });
    });


});
