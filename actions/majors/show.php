<?php
include('../../../../../connection.php');
$query = "SELECT `MajorCode`,`MajorDescription` from  _tblcourse_major where `CourseCode` =  ? ";
$statement = $conn->prepare($query);
$statement->execute([
    $_GET['CourseCode']
]);
echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
