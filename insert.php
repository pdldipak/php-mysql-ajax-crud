<?php 
include("dbConnection.php");

// stripslashes function can be used to clean up data retrieved from a database or from an HTML form.

// php://input is a read-only stream that allows you to read raw data from the request body. 
//It returns the request body as a string, regardless of the content type.

// json_decode()- It takes a JSON string and converts it into a PHP  object or variable, if true is passed, it will be converted into an associative array.

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$id = $mydata['id'];
$name = $mydata['name'];
$email = $mydata['email'];
$password = $mydata['password'];

// // only inserting student
// if (!empty($name) && !empty($email) && !empty($password)) {
//   $sql = "INSERT INTO student (name, email, password) VALUES ('$name', '$email', '$password')";
//   $result = mysqli_query($connection, $sql);
//   // $connection->query($sql) == true;
//   if ($result) {
//     echo "Data inserted successfully";
//   } else {
//     echo "Failed to insert data";
//   }
// } else {
//   echo "All fields are required";
// }

// insert or update student

if (!empty($name) && !empty($email) && !empty($password)) {
 
  if (!empty($id)) {
    $sql = "UPDATE student SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
  } else {
    $sql = "INSERT INTO student (name, email, password) VALUES ('$name', '$email', '$password')";
  }
//  $sql = "INSERT INTO student (id, name, email, password) VALUES ('$id', $name', '$email', '$password') ON DUPLICATE KEY UPDATE name = '$name', email = '$email', password = '$password'";
//  $result = mysqli_query($connection, $sql);
  // $connection->query($sql) == true;
  if ($connection->query($sql) == true) {
    echo "Data inserted successfully";
  } else {
    echo "Failed to insert data";
  }
} else {
  echo "All fields are required";
}

?>