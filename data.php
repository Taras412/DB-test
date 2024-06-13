<?php
require_once("db.php");

// Проверяем, был ли запрос выполнен методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Получаем значения из $_POST с учетом возможности NULL и экранируем их
    $imie = isset($_POST['imie']) ? mysqli_real_escape_string($conn, $_POST['imie']) : NULL;
    $nazwisko = isset($_POST['nazwisko']) ? mysqli_real_escape_string($conn, $_POST['nazwisko']) : NULL;
    $przyjazd = isset($_POST['przyjazd']) ? mysqli_real_escape_string($conn, $_POST['przyjazd']) : NULL;
    $odjazd = isset($_POST['odjazd']) ? mysqli_real_escape_string($conn, $_POST['odjazd']) : NULL;
    $adres = isset($_POST['adres']) ? mysqli_real_escape_string($conn, $_POST['adres']) : NULL;
    $zaklad = isset($_POST['zaklad']) ? mysqli_real_escape_string($conn, $_POST['zaklad']) : NULL;
    $spolka = isset($_POST['spolka']) ? mysqli_real_escape_string($conn, $_POST['spolka']) : NULL;
    $administrator = isset($_POST['administrator']) ? mysqli_real_escape_string($conn, $_POST['administrator']) : NULL;
    $narodowosc = isset($_POST['narodowosc']) ? mysqli_real_escape_string($conn, $_POST['narodowosc']) : NULL;
    $data_urodzenia = isset($_POST['data-urodzenia']) ? mysqli_real_escape_string($conn, $_POST['data-urodzenia']) : NULL;
    $wiek = isset($_POST['wiek']) ? mysqli_real_escape_string($conn, $_POST['wiek']) : NULL;
    $numer_paszportu = isset($_POST['numer-paszportu']) ? mysqli_real_escape_string($conn, $_POST['numer-paszportu']) : NULL;
    $numer_pesel = isset($_POST['numer-pesel']) ? mysqli_real_escape_string($conn, $_POST['numer-pesel']) : NULL;
    $telefon = isset($_POST['telefon']) ? mysqli_real_escape_string($conn, $_POST['telefon']) : NULL;
    $student = isset($_POST['student']) ? mysqli_real_escape_string($conn, $_POST['student']) : NULL;
    $legitymacja = isset($_POST['legitymacja']) ? mysqli_real_escape_string($conn, $_POST['legitymacja']) : NULL;
    $stanowisko = isset($_POST['stanowisko']) ? mysqli_real_escape_string($conn, $_POST['stanowisko']) : NULL;
    $badanie = isset($_POST['badanie']) ? mysqli_real_escape_string($conn, $_POST['badanie']) : NULL;
    $bhp = isset($_POST['bhp']) ? mysqli_real_escape_string($conn, $_POST['bhp']) : NULL;
    $zgloszenie_wyjazdu = isset($_POST['zgloszenie-wyjazdu']) ? mysqli_real_escape_string($conn, $_POST['zgloszenie-wyjazdu']) : NULL;
    $zezwol_oswiad = isset($_POST['zezwol-oswiad']) ? mysqli_real_escape_string($conn, $_POST['zezwol-oswiad']) : NULL;
    $waznosc_zezw = isset($_POST['waznosc-zezw']) ? mysqli_real_escape_string($conn, $_POST['waznosc-zezw']) : NULL;
    $wiza_bio = isset($_POST['wiza-bio']) ? mysqli_real_escape_string($conn, $_POST['wiza-bio']) : NULL;
    $waznosc_wisa = isset($_POST['waznosc-wisa']) ? mysqli_real_escape_string($conn, $_POST['waznosc-wisa']) : NULL;
    $karta_pobytu = isset($_POST['karta-pobytu']) ? mysqli_real_escape_string($conn, $_POST['karta-pobytu']) : NULL;
    $waznosc_karta = isset($_POST['waznosc-karta']) ? mysqli_real_escape_string($conn, $_POST['waznosc-karta']) : NULL;
    $status_karta = isset($_POST['status-karta']) ? mysqli_real_escape_string($conn, $_POST['status-karta']) : NULL;
    $uwagi = isset($_POST['uwagi']) ? mysqli_real_escape_string($conn, $_POST['uwagi']) : NULL;
    $komentarz = isset($_POST['komentarz']) ? mysqli_real_escape_string($conn, $_POST['komentarz']) : NULL;
    $info = isset($_POST['info']) ? mysqli_real_escape_string($conn, $_POST['info']) : NULL;

    // Подготавливаем значения даты для SQL-запроса
    $data_urodzenia_sql = $data_urodzenia ? "'$data_urodzenia'" : "NULL";
    $legitymacja_sql = $legitymacja ? "'$legitymacja'" : "NULL";
    $badanie_sql = $badanie ? "'$badanie'" : "NULL";
    $bhp_sql = $bhp ? "'$bhp'" : "NULL";
    $zgloszenie_wyjazdu_sql = $zgloszenie_wyjazdu ? "'$zgloszenie_wyjazdu'" : "NULL";
    $waznosc_zezw_sql = $waznosc_zezw ? "'$waznosc_zezw'" : "NULL";
    $wiza_bio_sql = $wiza_bio ? "'$wiza_bio'" : "NULL";
    $waznosc_wisa_sql = $waznosc_wisa ? "'$waznosc_wisa'" : "NULL";
    $waznosc_karta_sql = $waznosc_karta ? "'$waznosc_karta'" : "NULL";
    $odjazd_sql = $odjazd ? "'$odjazd'" : "NULL";
    

    // Создаем SQL-запрос для вставки данных
    $sql = "INSERT INTO `work` (imie, nazwisko, przyjazd, odjazd, adres, zaklad, spolka, administrator, narodowosc, `data-urodzenia`, wiek, `numer-paszportu`, `numer-pesel`, telefon, student, legitymacja, stanowisko, badanie, bhp, `zgloszenie-wyjazdu`, `zezwol-oswiad`, `waznosc-zezw`, `wiza-bio`, `waznosc-wisa`, `karta-pobytu`, `waznosc-karta`, `status-karta`, uwagi, komentarz, info) 
            VALUES ('$imie', '$nazwisko', '$przyjazd', $odjazd_sql, '$adres', '$zaklad', '$spolka', '$administrator', '$narodowosc', $data_urodzenia_sql, '$wiek', '$numer_paszportu', '$numer_pesel', '$telefon', '$student', $legitymacja_sql, '$stanowisko', $badanie_sql, $bhp_sql, $zgloszenie_wyjazdu_sql, '$zezwol_oswiad', $waznosc_zezw_sql, $wiza_bio_sql, $waznosc_wisa_sql, '$karta_pobytu', $waznosc_karta_sql, '$status_karta', '$uwagi', '$komentarz', '$info')";

    // Выполняем SQL-запрос
    $result = mysqli_query($conn, $sql);

    // Проверяем результат выполнения запроса
    if ($result) {
        echo json_encode(["message" => "Data inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
    }
} else {
    // В случае, если запрос был не методом POST
    echo json_encode(["error" => "Only POST requests are allowed."]);
}
?>
