<?php 
include("dbConnection.php");

// stripslashes function can be used to clean up data retrieved from a database or from an HTML form.

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$id = $mydata['sid'];

// deleting student 
if(!empty($id)) {
  $sql = "DELETE FROM student WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  // // $connection->query($sql) == true;
  if($result) {
    echo 1;
  } else {
    echo 0;
  }

}


?>