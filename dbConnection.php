<?php
require 'vendor/autoload.php';
ob_start(); //Turns on output buffering 
session_start();

$timezone = date_default_timezone_set("Europe/Stockholm");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //Notice the Namespace and Class name
$dotenv->load();

$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASS  = $_ENV['DB_PASS'];
$DB_NAME = $_ENV['DB_NAME'];
  
$connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);


// Check connection
if ($connection->connect_error) {
  die('Connection failed: ' . $connection->connect_error);
}

// echo 'Connected successfully';