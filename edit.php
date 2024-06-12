<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $imie = isset($_POST['imie']) ? $_POST['imie'] : '';
    $nazwisko = isset($_POST['nazwisko']) ? $_POST['nazwisko'] : '';
    $przyjazd = isset($_POST['przyjazd']) ? $_POST['przyjazd'] : '';
    $odjazd = isset($_POST['odjazd']) ? $_POST['odjazd'] : null;
    $adres = isset($_POST['adres']) ? $_POST['adres'] : '';
    $zaklad = isset($_POST['zaklad']) ? $_POST['zaklad'] : '';
    $spolka = isset($_POST['spolka']) ? $_POST['spolka'] : '';
    $administrator = isset($_POST['administrator']) ? $_POST['administrator'] : '';

    $sql = "UPDATE `work` SET 
                imie = '$imie', 
                nazwisko = '$nazwisko', 
                przyjazd = '$przyjazd', 
                odjazd = " . ($odjazd ? "'$odjazd'" : "NULL") . ",
                adres = '$adres', 
                zaklad = '$zaklad', 
                spolka = '$spolka', 
                administrator = '$administrator' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Data updated successfully."]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["error" => "Invalid request method."]);
}
?>
