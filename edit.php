<?php 
include("dbConnection.php");

// stripslashes function can be used to clean up data retrieved from a database or from an HTML form.

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$id = $mydata['sid'];

$sql = "SELECT * FROM student WHERE id = {$id}";

$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

echo json_encode($row);

?>