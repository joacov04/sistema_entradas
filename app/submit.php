<?php
function cleanDir($dir) {
    if($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != ".") {
                system('mv '.$dir.$entry.' qrUsados');
            }
        }
        closedir($handle);
    }
}
if(isset($_POST['submit'])){
    $field_values_array = $_POST['field_name'];

    cleanDir('qr/');
    foreach($field_values_array as &$element) {
        $nombre = str_replace(' ', '_', $element);
        system('python3  app/creador.py '.$nombre);
    }
    if($handle = opendir('qr/')) {
        echo "<div class='downloads'>";
        while (false !== ($entry = readdir($handle))){
             if($entry != '.' && $entry != '..') {
                echo "<a class='qrs' href='app/download.php?file=".$entry."'>".$entry."</a> \n";
             }
        }
        echo "</div>";
    }
}
