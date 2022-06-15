<?php
if(isset($_POST['submit'])){
    $field_values_array = $_POST['field_name'];

    print '<pre>';
    print_r($field_values_array);
    print '</pre>';
    foreach($field_values_array as &$element) {
        $nombre = str_replace(' ', '_', $element);
        echo $nombre;
        echo '<br/>';
        system('python3 creador.py '.$nombre);
    }
}
