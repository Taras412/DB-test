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

    // Сохранение таблицы в Excel
    document.getElementById("exportButton").addEventListener("click", function() {
        var table = document.querySelector("#" + document.getElementById("tableSelector").value + " .worker-table");
        var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
        var wbout = XLSX.write(wb, {bookType: 'xlsx', type: 'binary'});

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        saveAs(new Blob([s2ab(wbout)], {type: "application/octet-stream"}), "table.xlsx");
    });
});
