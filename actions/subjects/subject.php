   <?php
    include('../../../../../connection.php');
    $query = "SELECT *from  `_tblsubject` where SubjectID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([
        $_GET['SubjectID']
    ]);
    echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
