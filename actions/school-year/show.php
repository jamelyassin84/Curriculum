<?php
include('../../../../../connection.php');
$query =  "SELECT  *  FROM  _tblschoolyear order by SY DESC";
$statement = $conn->prepare($query);
$statement->execute();
echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
