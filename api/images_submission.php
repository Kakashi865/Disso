<?php

include "../parts/sql.php";
include "../parts/sql_functions.php";

var_dump($_POST);

if (!array_key_exists('speed', $_POST)) {
    // Doesn't Exist
    echo json_encode(['message' => "speed is required"]);
    die;
}

if (!array_key_exists('name', $_POST)) {
    // Doesn't Exist
    echo json_encode(['message' => "name is required"]);
    die;
}

if (!array_key_exists('answers', $_POST)) {
    // Doesn't Exist
    echo json_encode(['message' => "answers is required"]);
    die;
}

$speed = $_POST['speed'];
$name = $_POST['name'];
$answers = $_POST['answers'];

$userId = addUser($connection, $speed . "-" . $name, null, null);

foreach ($answers as $imageId => $answer) {
    addImageAnswer($connection, $userId, $imageId, $answer);
}