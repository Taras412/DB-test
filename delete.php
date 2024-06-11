<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET["id"]) && isset($_GET["from"])) {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_GET['id'];
    $from = $_GET['from'];

    if ($from == 'work') {
        // Получаем данные записи, которую необходимо переместить
        $sql_select = "SELECT * FROM `work` WHERE id=$id";
        $result_select = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_assoc($result_select);

        // Вставляем данные в таблицу "dissmiss"
        $sql_insert = "INSERT INTO `dissmiss` (imie, nazwisko, przyjazd, odjazd, adres, zaklad, spolka, administrator) VALUES ('".$row['imie']."', '".$row['nazwisko']."', '".$row['przyjazd']."', '".$row['odjazd']."', '".$row['adres']."', '".$row['zaklad']."', '".$row['spolka']."', '".$row['administrator']."')";
        $result_insert = mysqli_query($conn, $sql_insert);

        // Удаляем запись из таблицы "work"
        $sql_delete = "DELETE FROM `work` WHERE id=$id";
        $result_delete = mysqli_query($conn, $sql_delete);

        if ($result_insert && $result_delete) {
            echo "Данные успешно перемещены.";
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
    } elseif ($from == 'dissmiss') {
        // Удаляем запись из таблицы "dissmiss"
        $sql_delete = "DELETE FROM `dissmiss` WHERE id=$id";
        $result_delete = mysqli_query($conn, $sql_delete);

        if ($result_delete) {
            echo "Данные успешно удалены.";
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
    } else {
        echo "Неверный параметр 'from'.";
    }
} else {
    echo "Неверный запрос.";
}
?>
