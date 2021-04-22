   <?php
    include('../../../../../connection.php');
    $query = "SELECT *from  `_tblyearlevel` order  by YearLevelID DESC";
    $statement = $conn->prepare($query);
    $statement->execute();
    echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
