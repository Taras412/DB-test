
<?php
require_once("db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM `work` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "Record not found."]);
        }
    } else {
        echo json_encode(["error" => "Database query failed."]);
    }
} else {
    echo json_encode(["error" => "No ID specified."]);
}
?>
