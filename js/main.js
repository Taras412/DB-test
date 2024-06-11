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


    // Назначаем обработчики события "click" для кнопок редактирования
/*     document.querySelectorAll(".edit-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            var id = this.getAttribute("data-id"); // Получаем ID записи для редактирования
    
            // Получаем данные записи по ее ID и заполняем форму редактирования
            fetch('data.php?id=' + id)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // Установим значения полей формы на основе данных, полученных с сервера
                document.getElementById("editId").value = id;
                document.getElementById("editImie").value = data.imie || '';
                document.getElementById("editNazwisko").value = data.nazwisko || '';
                document.getElementById("editPrzyjazd").value = data.przyjazd || '';
                document.getElementById("editOdjazd").value = data.odjazd || '';
                document.getElementById("editAdres").value = data.adres || '';
                document.getElementById("editZaklad").value = data.zaklad || '';
                document.getElementById("editSpolka").value = data.spolka || '';
                document.getElementById("editAdministrator").value = data.administrator || '';
    
                // Отображаем форму редактирования
                document.getElementById("editForm").style.display = "block";
            })
            .catch(error => {
                console.error('Ошибка:', error.message);
                if (error.hasOwnProperty('responseText')) {
                    console.error('Текст ответа сервера:', error.responseText);
                } else {
                    console.error('Не удалось получить ответ от сервера.');
                }
            });
        });
    }); */
    
    document.querySelectorAll(".edit-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            var id = this.getAttribute("data-id"); // Получаем ID записи для редактирования
    
            // Получаем данные записи по ее ID и заполняем форму редактирования
            fetch('data.php?id=' + id)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Посмотрим, что приходит с сервера
                // Установим значения полей формы на основе данных, полученных с сервера
                document.getElementById("editId").value = id;
                document.getElementById("editImie").value = data.imie || '';
                document.getElementById("editNazwisko").value = data.nazwisko || '';
                document.getElementById("editPrzyjazd").value = data.przyjazd || '';
                document.getElementById("editOdjazd").value = data.odjazd || '';
                document.getElementById("editAdres").value = data.adres || '';
                document.getElementById("editZaklad").value = data.zaklad || '';
                document.getElementById("editSpolka").value = data.spolka || '';
                document.getElementById("editAdministrator").value = data.administrator || '';
    
                // Отображаем форму редактирования
                document.getElementById("editForm").style.display = "block";
            })
            .catch(error => {
                console.error('Ошибка:', error.message);
                if (error.hasOwnProperty('responseText')) {
                    console.error('Текст ответа сервера:', error.responseText);
                } else {
                    console.error('Не удалось получить ответ от сервера.');
                }
            });
        });
    });

    // Назначаем обработчик события "submit" для формы редактирования
    document.getElementById("editDataForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        var formData = new FormData(this);
    
        fetch('edit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Ожидаем JSON-ответ от сервера
        })
        .then(data => {
            console.log(data);
            if (data.hasOwnProperty("imie")) { // Проверяем наличие поля "imie" в ответе
                // Устанавливаем значения для полей формы
                document.getElementById("editId").value = data.id;
                document.getElementById("editImie").value = data.imie;
                document.getElementById("editNazwisko").value = data.nazwisko;
                document.getElementById("editPrzyjazd").value = data.przyjazd;
                document.getElementById("editOdjazd").value = data.odjazd;
                document.getElementById("editAdres").value = data.adres;
                document.getElementById("editZaklad").value = data.zaklad;
                document.getElementById("editSpolka").value = data.spolka;
                document.getElementById("editAdministrator").value = data.administrator;
        
                // Отображаем форму редактирования
                document.getElementById("editForm").style.display = "block";
            } else if (data.hasOwnProperty("error")) { // Проверяем наличие ошибки в ответе
                alert("Error: " + data.error);
            } else {
                throw new Error('Unexpected server response'); // Если ответ не содержит ни сообщения, ни ошибки, генерируем исключение
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });
            
});
