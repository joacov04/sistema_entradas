<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/fdp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>FDP</title>
</head>
<body>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 20; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><input type="text" placeholder="Nombre y Apellido" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button">-</a></div>'; //New input field html 
            var x = 1; //Initial field counter is 1
            
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
        </script>

    <div>
        <h1>LA MALDITA FIESTA DEL POLI</h1>
        <form  method="post">                
            <div class="field_wrapper flex">
                <div>
                    <input type="text" placeholder="Nombre y Apellido" name="field_name[]" value="">
                    <a href="javascript:void(0);" class="add_button" title="Add field">+</a>
                </div>
            </div>
            <div class="flex">
                <input type="submit" name="submit" value="GENERAR">
            </div>
        </form>

    </div>
        <?php
            include("submit.php");
        ?>
    
</body>
</html>
