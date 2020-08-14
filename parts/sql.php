<?php

// This file is used across the entire site to generate an sql connection using the variables provided below - start of PDO

// Sql Variables
$servername = "localhost";
$dbname = "dissertation";
$username = "root";
$password = "";

// Create MySQL Connection
$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Setting Error mode for SQL, to throw exceptions, so we can see what is going wrong with sql queries.
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);