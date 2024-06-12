<?php
require_once("db.php");

$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$przyjazd = $_POST['przyjazd'];
$odjazd = $_POST['odjazd'];
$adres = $_POST['adres'];
$zaklad = $_POST['zaklad'];
$spolka = $_POST['spolka'];
$administrator = $_POST['administrator'];

$sql = "INSERT INTO `work` (imie, nazwisko, przyjazd, adres, zaklad, spolka, administrator) VALUES ('$imie','$nazwisko','$przyjazd','$adres','$zaklad','$spolka','$administrator')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["message" => "Data inserted successfully."]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
?>


