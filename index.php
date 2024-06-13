<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Base test</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container wrapper-main">
        <div class="wrapper">
            <form id="dataForm" class="form" action="data.php" method="POST">
                <input class="form__text" type="text" placeholder="imię" name="imie">
                <input class="form__text" type="text" placeholder="nazwisko" name="nazwisko">
                <input class="form__data" type="date" placeholder="przyjazd" name="przyjazd" required>
                <input class="form__data" type="date" placeholder="odjazd" name="odjazd">
                <input class="form__text" type="text" placeholder="adres" name="adres">
                <input class="form__text" type="text" placeholder="zaklad" name="zaklad">
                <select class="form__select" placeholder="Spolka" name="spolka">
                    <option value="" disabled selected hidden>spolka</option>
                    <option value="APT">APT</option>
                    <option value="WP">WP</option>
                    <option value="SAS">SAS</option>
                    <option value="WD">WD</option>
                    <option value="DIPICO">DIPICO</option>
                </select>
                <input class="form__text" type="text" placeholder="Administrator" name="administrator">
                <input class="form__text" type="text" placeholder="Narodowosc:" name="narodowosc">
                <input class="form__data" type="date" placeholder="Data urodzenia" name="data-urodzenia">
                <input class="form__text" type="text" placeholder="Wiek" name="wiek">
                <input class="form__text" type="text" placeholder="Numer Paszportu" name="numer-paszportu">
                <input class="form__text" type="text" placeholder="Numer PESEL" name="numer-pesel">
                <input class="form__text" type="tel" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" placeholder="XXX XXX XXX" name="telefon">
                <select class="form__select" placeholder="Student" name="student">
                    <option value="" disabled selected hidden>Student</option>
                    <option value="APT">TAK</option>
                    <option value="WP">NIE</option>
                </select>
                <input class="form__data" type="date" placeholder="Legitymacja do:" name="legitymacja">
                <input class="form__text" type="text" placeholder="Stanowisko" name="stanowisko">
                <input class="form__data" type="date" placeholder="Badanie lekarskie" name="badanie">
                <input class="form__data" type="date" placeholder="BHP" name="bhp">
                <input class="form__data" type="date" placeholder="Data zgloszenie wyjazdu" name="zgloszenie-wyjazdu">
                <select class="form__select" placeholder="Zezwolenie/Oswiadczenie" name="zezwol-oswiad">
                    <option value="" disabled selected hidden>Zezwol/Oswiad</option>
                    <option value="APT">ZEZWOLENIE</option>
                    <option value="WP">OSWIADCZENIE</option>
                </select>
                <input class="form__data" type="date" placeholder="Ważność dokumentu (zezw, osw)" name="waznosc-zezw">
                <select class="form__select" placeholder="Wisa/Bio" name="wiza-bio">
                    <option value="" disabled selected hidden>Wiza/Bio</option>
                    <option value="APT">WIZA</option>
                    <option value="WP">BIO</option>
                </select>
                <input class="form__data" type="date" placeholder="Ważność dokumentu (wiza, bio)" name="waznosc-wisa">
                <select class="form__select" placeholder="Karta Pobytu" name="karta-pobytu">
                    <option value="" disabled selected hidden>Karta Pobytu</option>
                    <option value="APT">TAK</option>
                    <option value="WP">NIE</option>
                </select>
                <input class="form__data" type="date" placeholder="Ważność dokumentu (Karta Pobytu)" name="waznosc-karta">
                <input class="form__text" type="text" placeholder="Status Karty Pobytu" name="status-karta">
                <input class="form__text" type="text" placeholder="Uwagi" name="uwagi">
                <input class="form__text" type="text" placeholder="Komentarz" name="komentarz">
                <input class="form__text" type="text" placeholder="Dodatkowa Informacja" name="info">
                <div>
                    <button type="submit">ZAPISZ</button>
                </div>
            </form>
        </div>
    </div>
        
    <div class="container">
        <select id="tableSelector">
            <option value="table1">List of Workers</option>
            <option value="table2">List of Dissmissed</option>
        </select>
    </div>
    
    <div class="container">
        <div id="table1" class="table-container">
            <table class="worker-table">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Przyjazd</th>
                        <th>Odjazd</th>
                        <th>Adres</th>
                        <th>Zakład</th>
                        <th>Spółka</th>
                        <th>Administrator</th>
                        <th class="table__action">Action</th>
                        <th class="table__action">Action</th>
                    </tr>
                    <tr>
                        <th><input type="text" class="filter-input" data-column="0"></th>
                        <th><input type="text" class="filter-input" data-column="1"></th>
                        <th><input type="text" class="filter-input" data-column="2"></th>
                        <th><input type="text" class="filter-input" data-column="3"></th>
                        <th><input type="text" class="filter-input" data-column="4"></th>
                        <th><input type="text" class="filter-input" data-column="5"></th>
                        <th><input type="text" class="filter-input" data-column="6"></th>
                        <th><input type="text" class="filter-input" data-column="7"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("db.php");

                    $sql = "SELECT * FROM `work`";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr id='row-".$row['id']."'>";
                                echo "<td>".$row['imie']."</td>";
                                echo "<td>".$row['nazwisko']."</td>";
                                echo "<td>".$row['przyjazd']."</td>";
                                echo "<td>".$row['odjazd']."</td>";
                                echo "<td>".$row['adres']."</td>";
                                echo "<td>".$row['zaklad']."</td>";
                                echo "<td>".$row['spolka']."</td>";
                                echo "<td>".$row['administrator']."</td>";
                                echo "<td><button class='delete-btn' data-id='".$row['id']."'>DELETE</button></td>";
                                echo "<td><button class='edit-btn' data-id='".$row['id']."'>EDIT</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>0 results</td></tr>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>  
    </div>
    <div class="container">
        <div id="table2" class="table-container">
            <table class="worker-table">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Przyjazd</th>
                        <th>Odjazd</th>
                        <th>Adres</th>
                        <th>Zakład</th>
                        <th>Spółka</th>
                        <th>Administrator</th>
                    </tr>
                    <tr>
                        <th><input type="text" class="filter-input" data-column="0"></th>
                        <th><input type="text" class="filter-input" data-column="1"></th>
                        <th><input type="text" class="filter-input" data-column="2"></th>
                        <th><input type="text" class="filter-input" data-column="3"></th>
                        <th><input type="text" class="filter-input" data-column="4"></th>
                        <th><input type="text" class="filter-input" data-column="5"></th>
                        <th><input type="text" class="filter-input" data-column="6"></th>
                        <th><input type="text" class="filter-input" data-column="7"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("db.php");

                    $sql = "SELECT * FROM `dissmiss`";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$row['imie']."</td>";
                                echo "<td>".$row['nazwisko']."</td>";
                                echo "<td>".$row['przyjazd']."</td>";
                                echo "<td>".$row['odjazd']."</td>";
                                echo "<td>".$row['adres']."</td>";
                                echo "<td>".$row['zaklad']."</td>";
                                echo "<td>".$row['spolka']."</td>";
                                echo "<td>".$row['administrator']."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>0 results</td></tr>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>  
    </div>


    <div class="container">
        <button id="exportButton">SAVE TO EXCEL</button>
    </div>


    <div class="container">
        <div id="modal" class="modal">
            <span class="close">&times;</span>
            <h2>Дополнительная информация</h2>
                <div class="modal-content">
                    <div class="modal__flex" >
                        <p><strong>Imię:</strong> <span id="modal-imie"></span></p>
                        <p><strong>Nazwisko:</strong> <span id="modal-nazwisko"></span></p>
                        <p><strong>Narodowość:</strong> <span id="modal-narodowosc"></span></p>
                        <p><strong>Data urodzenia:</strong> <span id="modal-urodzenie"></span></p>
                        <p><strong>Wiek:</strong> <span id="modal-wiek"></span></p>
                        <p><strong>Numer Paszportu:</strong> <span id="modal-adres"></span></p>
                        <p><strong>Numer PESEL:</strong> <span id="modal-zaklad"></span></p>
                        <p><strong>Tel:</strong> <span id="modal-spolka"></span></p>
                        <p><strong>Student:</strong> <span id="modal-administrator"></span></p>
                        <p><strong>Legitymacja do:</strong> <span id="modal-administrator"></span></p>
                        <p><strong>Stanowisko:</strong> <span id="modal-administrator"></span></p>
                        <p><strong>Badanie lekarske (data):</strong> <span id="modal-administrator"></span></p>
                        <p><strong>BHP (data):</strong> <span id="modal-administrator"></span></p>
                        <p><strong>Data zgloshenia wyjazdu:</strong> <span id="modal-administrator"></span></p>
                    </div>
                    <div class="modal__flex" >
                        <p><strong>Typ dokumentu (zezw., osw.):</strong> <span id="modal_zezwol"></span></p>
                        <p><strong>Ważność dokumentu (zew., osw):</strong> <span id="modal_waznosc-zezw"></span></p>
                        <p><strong>Typ dokumentu (wiza,bio):</strong> <span id="modal_wiza"></span></p>
                        <p><strong>Ważność dokumentu (wiza, bio):</strong> <span id="modal_waznosc-wiza"></span></p>
                        <p><strong>Karta bobytu:</strong> <span id="modal_karta"></span></p>
                        <p><strong>Wazność karty pobytu:</strong> <span id="modal_waznosc-karta"></span></p>
                        <p><strong>Status karty pobytu:</strong> <span id="modal_status"></span></p>
                        <p><strong>Uwagi:</strong> <span id="modal_uwagi"></span></p>
                        <p><strong>Komentarz:</strong> <span id="modal_komentarz"></span></p>
                        <p><strong>Dod. Informacja:</strong> <span id="modal_komentarz"></span></p>
  
                    </div>
                </div>
            <button>SKANY</button>
        </div>
    </div>

        <!-- Форма редактирования -->
    <div class="container">
        <div id="editForm" class="edit-form" style="display: none;">
            <h2>Редактировать запись</h2>
            <form id="editDataForm" class="form" action="edit.php" method="POST">
                <input type="hidden" id="editId" name="id">
                <input class="form__text" type="text" placeholder="imię" name="imie" id="editImie">
                <input class="form__text" type="text" placeholder="nazwisko" name="nazwisko" id="editNazwisko">
                <div>
                    <input class="form__data" type="date" placeholder="przyjazd" name="przyjazd" id="editPrzyjazd">
                    <input class="form__data" type="date" placeholder="odjazd" name="odjazd" id="editOdjazd">
                </div>
                <input class="form__text" type="text" placeholder="adres" name="adres" id="editAdres">
                <br>
                <input class="form__text" type="text" placeholder="zaklad" name="zaklad" id="editZaklad">
                <br>
                <select class="form__text" name="spolka" id="editSpolka">
                    <option value="APT">APT</option>
                    <option value="WP">WP</option>
                    <option value="SAS">SAS</option>
                    <option value="WD">WD</option>
                    <option value="DIPICO">DIPICO</option>
                </select>
                <br>
                <input class="form__text" type="text" placeholder="administrator" name="administrator" id="editAdministrator">
                <br>
                <div>
                    <button type="submit">Сохранить</button>
                    <button id="cancelEdit">Отмена</button>
                </div>
            </form>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
