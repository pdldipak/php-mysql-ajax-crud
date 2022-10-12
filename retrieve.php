<?php   
include('dbConnection.php');
$sql = "SELECT * FROM student";
$result = mysqli_query($connection, $sql);
if($result->num_rows > 0) {
    $data = array();
while($row = mysqli_fetch_assoc($result)) {
$data[] = $row;
}
// returning JSON format data as response to Ajax request
echo json_encode($data);
} else {
echo "No data found";
}

?>