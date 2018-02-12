<?php

header('Content-Type: application/json');

$conn    = mysqli_connect('localhost', 'root', '', 'todo_vue');
$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case 'GET':
        $q = "SELECT * FROM todo";
        $result = mysqli_query($conn, $q);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
            http_response_code(200);
            die();
        } 
        break;

    case 'POST':
        $text = $_POST['text'];
        $done = $_POST['done'];
        $date = $_POST['date'];

        if (!isset($text)) {
            http_response_code(400);
            die();
        } else {
            $q = "INSERT INTO todo (text, done, id_date) VALUES ('$text', '$done', '$date')";
            $result = mysqli_query($conn, $q);
            http_response_code(200);
            die();
        }
        break;

    case 'DELETE':
        $id_date = $_GET['id'];
        $q = "DELETE FROM todo WHERE id_date = '$id_date'";
        // die($q);
        $result = mysqli_query($conn, $q);

        http_response_code(200);
        die();
        break;

    case 'PATCH':
        $id_date = $_GET['id'];
        $done    = $_GET['done'];
        $q = "UPDATE todo SET done = '$done' WHERE id_date = '$id_date'";
        // die($q);
        $result = mysqli_query($conn, $q);

        http_response_code(200);
        die();
        break;
    
    default:
        # code...
        break;
}