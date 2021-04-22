    <?php
    include('../../../../../connection.php');
    $query = "SELECT `Semester` from  `_tblsemester` order by DESC";
    $statement = $conn->prepare($query);
    $statement->execute();
    echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
