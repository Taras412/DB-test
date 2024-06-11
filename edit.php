<!-- <?php
// Проверяем, был ли отправлен запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Здесь вы можете получить данные из формы, отправленной методом POST
    // Например, получим данные из поля с именем "editId"
    $editId = $_POST["editId"];

    // Здесь вы можете выполнить необходимые операции для редактирования данных
    // Например, обновить данные в базе данных

    // После выполнения операций возвращаем сообщение об успешном обновлении данных
    header('Content-Type: application/json'); // Установка заголовка для указания на тип содержимого
    echo json_encode(["message" => "Data updated successfully."]);
} else {
    // Если запрос не был отправлен методом POST, возвращаем сообщение об ошибке
    header('Content-Type: application/json'); // Установка заголовка для указания на тип содержимого
    echo json_encode(["error" => "Invalid request method."]);
}
?> -->
