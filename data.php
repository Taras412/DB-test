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

$sql = "INSERT INTO `work` (imie, nazwisko, przyjazd, odjazd, adres, zaklad, spolka, administrator) VALUES ('$imie','$nazwisko','$przyjazd','$odjazd','$adres','$zaklad','$spolka','$administrator')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}s
?>


