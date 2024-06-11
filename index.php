<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Base test</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <form id="dataForm" class="form" action="data.php" method="POST">
                <input class="form__text" type="text" placeholder="imię" name="imie">
                <input class="form__text" type="text" placeholder="nazwisko" name="nazwisko">
                <div>
                    <input class="form__data" type="date" placeholder="przyjazd" name="przyjazd">
                    <input class="form__data" type="date" placeholder="odjazd" name="odjazd">
                </div>
                <input class="form__text" type="text" placeholder="adres" name="adres">
                <br>
                <input class="form__text" type="text" placeholder="zaklad" name="zaklad">
                <br>
                <select class="form__text" name="spolka"> <!-- Заменили input на select -->
                    <option value="APT">APT</option>
                    <option value="WP">WP</option>
                    <option value="SAS">SAS</option>
                    <option value="WD">WD</option>
                    <option value="DIPICO">DIPICO</option>
                </select>
                <br>
                <input class="form__text" type="text" placeholder="administrator" name="administrator">
                <br>
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
                        <th>Spółка</th>
                        <th>Administrator</th>
                        <th>Action</th>
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
                        <th>Spółка</th>
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
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Дополнительная информация</h2>
                <p><strong>Imię:</strong> <span id="modal-imie"></span></p>
                <p><strong>Nazwisko:</strong> <span id="modal-nazwisko"></span></p>
                <p><strong>Przyjazd:</strong> <span id="modal-przyjazd"></span></p>
                <p><strong>Odjazd:</strong> <span id="modal-odjazd"></span></p>
                <p><strong>Adres:</strong> <span id="modal-adres"></span></p>
                <p><strong>Zakład:</strong> <span id="modal-zaklad"></span></p>
                <p><strong>Spółka:</strong> <span id="modal-spolka"></span></p>
                <p><strong>Administrator:</strong> <span id="modal-administrator"></span></p>
            </div>
        </div>
    </div>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
