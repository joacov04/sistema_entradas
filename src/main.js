$(document).ready(function(){


    let url = window.location.href.split('/');
    let actual_file = url[url.length-1];

    if(actual_file == "buscar.php") {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'get_main_info.php',
            data: {},
            success: function(data) {
                console.log(data);
                console.log($('#total')[0]);

                $('#total')[0].innerText = data.entradas;
                $('#money')[0].innerText = data.plata;
                $('#margin')[0].innerText = data.margen;
                $('#neto')[0].innerText = data.neto;
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    $('#sync').click(function() {
        location.reload();
    });

    $(document).on("click", ".used_action", function() {
        //confirm prompt here
        let tr = $(this).parent().parent();
        let td = tr[0].getElementsByTagName('td'); 
        let token = td[1].innerText;
        $.ajax({
            type: 'POST',
            url: 'qr_management.php',
            data: {
                'token': token,
                'action': 0,
            },
            success: function(data) {
                console.log(data);
                if(td[2].innerText == 'SI') {
                    td[2].innerText='NO';
                    td[4].getElementsByTagName('a')[0].innerText='Usada';
                } else {
                    td[2].innerText='SI';
                    td[4].getElementsByTagName('a')[0].innerText='NO Usada';
                }
                //tr.remove();
            },
            error: function(err) {
                console.log(err);
            }
        });

    });

    $(document).on("click", ".delete_action", function() {
        //confirm prompt here
        let tr = $(this).parent().parent();
        let td = tr[0].getElementsByTagName('td'); 
        let token = td[1].innerText;
        $.ajax({
            type: 'POST',
            url: 'qr_management.php',
            data: {
                'token': token,
                'action': 1,
            },
            success: function(data) {
                console.log(data);
                tr.remove();
            },
            error: function(err) {
                console.log(err);
            }
        });

    });

    $('#qr_icon').click(function() {
        window.location.href = 'app/camera.php';
    });

    $('#search_icon').click(function() {
        window.location.href = 'app/buscar.php';
    });


    function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
            $temp.remove();
    }
    $('#link-btn').click(function() {
        copyToClipboard('#link')
    });
    


    let maxField = 20; //Input fields increment limitation
    let addButton = $('.add_button'); //Add button selector
    let wrapper = $('.field_wrapper'); //Input field wrapper
    let fieldHTML = '<div><input type="text" placeholder="Nombre y Apellido" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button">-</a></div>'; //New input field html 
    let x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

function nameSearch(id=0) {
    let input, filter, tr, td, i, text_value, displaying = 0, num_elem;
    input = $('#search_name');
    filter = input.val().toUpperCase();
    tr = $('tr');
    for(i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[id];
        if (td) {
          text_value = td.textContent || td.innerText;

            if (text_value.toUpperCase().indexOf(filter) > -1) {

                displaying += 1;
                tr[i].style.display = "";
                num_elem = tr[i].getElementsByClassName('num');

                for (let item of num_elem) {
                    item.style.display = "none";
                }
                tr[i].innerHTML += "<td class='num'>"+displaying+"</td>";

            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
