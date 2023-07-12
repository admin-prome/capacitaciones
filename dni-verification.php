<?php

$dni = isset($_POST['dni']) ? $_POST['dni'] : '';

if ($dni != "") {
    $verified = verifyDNI($dni);
    if ($verified == "true") {
        echo "dni verified";
    } else {
        echo "dni not verified";
    }
} else {
    echo "dni empty";
}

function verifyDNI($dni = null)
{
    $url = "https://catalogoprome.azurewebsites.net/Catalogo/$dni";
    $result = file_get_contents($url);
    return $result;
}

?>
