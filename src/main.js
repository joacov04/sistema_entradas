$(document).ready(function(){

    $('.used_action').click(function() {
        let token = $(this).parent().parent()[0].getElementsByTagName('td')[1].innerText;
        $.ajax({
            type: 'POST',
            url: 'api/qr_management.php?token='+token,
            success: function(data) {
                console.log(data);
            },
            error: function(err) {
                console.log(err);
            }

            
        });

    });
    $('#qr_icon').click(function() {
        window.location.href = 'camera.php';
    });

    $('#search_icon').click(function() {
        window.location.href = 'buscar.php';
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
    let input, filter, tr, td, i, text_value;
    input = $('#search_name');
    filter = input.val().toUpperCase();
    tr = $('tr');
    for(i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[id];
        if (td) {
          text_value = td.textContent || td.innerText;

            if (text_value.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
