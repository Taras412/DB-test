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
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                window.location.reload(); // Перезагружаем страницу после успешной вставки
            } else {
                alert("Error: " + data.error);
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
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Извлекаем текст ответа
            })
            .then(data => {
                alert(data); // Показываем текст ответа (сообщение сервера) в уведомлении
                if (data.includes("Ошибка")) {
                    throw new Error(data); // Если текст ответа содержит "Ошибка", выбрасываем ошибку
                } else {
                    var row = document.getElementById('row-' + id);
                    row.remove(); // Удаляем строку с удаленной записью
                }
            })
            .catch(error => {
                console.error('Ошибка:', error.message); // Выводим сообщение об ошибке
                alert('Ошибка при удалении записи. Пожалуйста, попробуйте еще раз.');
            })
            .finally(() => {
                window.location.reload(); // Перезагружаем страницу в любом случае
            });
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

    // Назначаем обработчики события "click" для кнопок EDIT
    document.querySelectorAll(".edit-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            var id = this.getAttribute("data-id"); // Получаем ID записи для редактирования
    
            // Получаем данные записи по ее ID и заполняем форму редактирования
            fetch('get_data.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
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
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Не удалось получить данные для редактирования.');
            });
        });
    });

    // Назначаем обработчик события "submit" для формы EDIT
    document.getElementById("editDataForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Предотвращаем стандартную отправку формы
        var formData = new FormData(this);
    
        fetch('edit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                window.location.reload(); // Перезагружаем страницу после успешного обновления
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });

    // Обработка отмены редактирования
    document.getElementById("cancelEdit").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("editForm").style.display = "none";
    });
});
