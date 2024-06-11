console.log("Script loaded");

document.addEventListener("DOMContentLoaded", function() {
    // Назначаем обработчик событий для селектора таблиц
    document.getElementById("tableSelector").addEventListener("change", function() {
        var selectedTableId = this.value;
        var tables = document.querySelectorAll(".table-container");
        for (var i = 0; i < tables.length; i++) {
            tables[i].style.display = "none";
        }
        document.getElementById(selectedTableId).style.display = "block";
    });

    // Назначаем обработчик события "submit" для формы данных
    document.getElementById("dataForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        var formData = new FormData(this);

        fetch('data.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data.includes("Data inserted successfully.")) {
                window.location.reload(); // Перезагружаем страницу после успешной вставки
            } else {
                alert("Error: " + data);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Назначаем обработчики события "click" для кнопок удаления
    document.querySelectorAll(".delete-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            var id = this.getAttribute("data-id"); // Получаем ID записи для удаления
            fetch('delete.php?id=' + id + '&from=work', {
                method: 'DELETE'
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("успешно")) {
                    var row = document.getElementById('row-' + id);
                    row.remove(); // Удаляем строку с удаленной записью
                } else {
                    alert("Ошибка: " + data);
                }
            })
            .catch(error => console.error('Ошибка:', error));
        });
    });

    // Фильтрация таблицы
    document.querySelectorAll(".filter-input").forEach(function(input) {
        input.addEventListener("keyup", function() {
            var column = this.dataset.column;
            var filter = this.value.toLowerCase();
            var table = this.closest("table");
            var rows = table.querySelectorAll("tbody tr");

            rows.forEach(function(row) {
                var cell = row.querySelectorAll("td")[column];
                if (cell) {
                    var cellText = cell.textContent.toLowerCase();
                    if (cellText.includes(filter)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        });
    });

    // Функция для сбора уникальных значений из столбца
    function getUniqueColumnValues(column) {
        var uniqueValues = [];
        var table = document.querySelector(".table-container table");
        var rows = table.querySelectorAll("tbody tr");

        rows.forEach(function(row) {
            var cell = row.querySelectorAll("td")[column];
            if (cell) {
                var cellText = cell.textContent.trim();
                if (!uniqueValues.includes(cellText)) {
                    uniqueValues.push(cellText);
                }
            }
        });

        return uniqueValues;
    }

    // Создаем выпадающие списки для фильтрации
    var addressSelect = document.getElementById("addressFilter");
    var zakladSelect = document.getElementById("zakladFilter");
    var spolkaSelect = document.getElementById("spolkaFilter");
    var administratorSelect = document.getElementById("administratorFilter");

    // Собираем уникальные значения из соответствующих столбцов
    var addressValues = getUniqueColumnValues(4); // Индекс столбца "Adres"
    var zakladValues = getUniqueColumnValues(5); // Индекс столбца "Zaklad"
    var spolkaValues = getUniqueColumnValues(6); // Индекс столбца "Spolka"
    var administratorValues = getUniqueColumnValues(7); // Индекс столбца "Administrator"

    // Добавляем значения в выпадающие списки
    addressValues.forEach(function(value) {
        var option = document.createElement("option");
        option.text = value;
        addressSelect.add(option);
    });

    zakladValues.forEach(function(value) {
        var option = document.createElement("option");
        option.text = value;
        zakladSelect.add(option);
    });

    spolkaValues.forEach(function(value) {
        var option = document.createElement("option");
        option.text = value;
        spolkaSelect.add(option);
    });

    administratorValues.forEach(function(value) {
        var option = document.createElement("option");
        option.text = value;
        administratorSelect.add(option);
    });

    // Добавляем обработчики событий для фильтрации по выпадающим спискам
    addressSelect.addEventListener("change", function() {
        filterTable(4, this.value);
    });

    zakladSelect.addEventListener("change", function() {
        filterTable(5, this.value);
    });

    spolkaSelect.addEventListener("change", function() {
        filterTable(6, this.value);
    });

    administratorSelect.addEventListener("change", function() {
        filterTable(7, this.value);
    });
});



document.getElementById('exportButton').addEventListener('click', function() {
    var table = document.querySelector('.worker-table'); // Найдите вашу таблицу
    var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet JS" });
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
    
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) {
            view[i] = s.charCodeAt(i) & 0xFF;
        }
        return buf;
    }

    saveAs(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), 'table.xlsx');
});

//MODAL WINDOW
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("modal");
    const span = document.getElementsByClassName("close")[0];

    document.querySelectorAll('.data-row').forEach(row => {
        row.addEventListener('click', function() {
            document.getElementById("modal-imie").innerText = this.dataset.imie;
            document.getElementById("modal-nazwisko").innerText = this.dataset.nazwisko;
            document.getElementById("modal-przyjazd").innerText = this.dataset.przyjazd;
            document.getElementById("modal-odjazd").innerText = this.dataset.odjazd;
            document.getElementById("modal-adres").innerText = this.dataset.adres;
            document.getElementById("modal-zaklad").innerText = this.dataset.zaklad;
            document.getElementById("modal-spolka").innerText = this.dataset.spolka;
            document.getElementById("modal-administrator").innerText = this.dataset.administrator;
            modal.style.display = "block";
        });
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

