<?php

include "sql.php";
include "sql_functions.php";

// Creates the query to grab questions from the database
$statement = $connection->prepare("SELECT * FROM questions");

// Run the prepared statement above, against the mysql database, to grab the most recent questions.
$statement->execute();

// Telling the mysql database that we want an associative array back when requesting for data
// E.g : ['id' => 1, 'question' => 'Question One']
$statement->setFetchMode(PDO::FETCH_ASSOC);

// Tell the mysql database that we want to get all of the results from that query.
$results = $statement->fetchAll();

// Here we are checking if the user has inputted a name before, if so continue.
if (array_key_exists('name', $_POST)) {
    // Grab the name from the form submission
    $name = $_POST['name'];

    
}