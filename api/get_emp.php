<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Empleado.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $db = new Database();
    $db = $db->connect();

    $student = new Empleado($db);

    $res = $student->fetchAll();
    $resCount = $res->rowCount();

    if($resCount > 0) {

        $students = array();

        foreach ($res as $row) {
            extract($row);
            $students[] = array('id' => $id, 'nombre' => $nombre, 'email' => $email, 'username' => $username);
        }
        
        echo json_encode($students);

    } else {
        echo json_encode(array('message' => "No records found!"));
    }
} else {
    echo json_encode(array('message' => "Error: incorrect Method!"));
}
