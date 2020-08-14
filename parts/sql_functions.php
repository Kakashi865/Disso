<?php

// This function will take in a mysql connection, and a name, which will then insert a user record into the database, which we then will attach to
// the answers for the questions, so we can identify each answer.
function addUser($connection, $name, $gender, $age) {
    $data = array($name, $gender, $age);

    // Creating a query to insert a new user into the database, using the values above.
    $statement = $connection->prepare("INSERT INTO users (name, gender, age) VALUES (?, ?, ?)");

    // Here we are binding the data to the query in a safe non injectable way
    $statement->execute($data);

    // Here we are returning the id of the user we just created.
    return $connection->lastInsertId();
}

// This function will take in a mysql connection, user id, question id, and a answer, which will be inserted into the answers table, which is attached
// to a user and a question.
function addQuestionAnswer($connection, $userId, $questionId, $answer) {
    $data = array($userId, $questionId, $answer);

    // Creating a query to insert a new answer into the database, using the values above.
    $statement = $connection->prepare("INSERT INTO answers (user_id, question_id, answer) VALUES (?, ?, ?)");

    // Here we are binding the data to the query in a safe non injectable way
    $statement->execute($data);
}

// This function will take in a mysql connection, user id, question id, and a answer, which will be inserted into the answers table, which is attached
// to a user and a question.
function addImageAnswer($connection, $userId, $imageId, $answer) {
    $data = array($userId, $imageId, $answer);

    // Creating a query to insert a new iamge answer into the database, using the values above.
    $statement = $connection->prepare("INSERT INTO image_answers (user_id, image_id, answer) VALUES (?, ?, ?)");

    // Here we are binding the data to the query in a safe non injectable way
    $statement->execute($data);
}