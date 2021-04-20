    <?php
    include('../../../../../connection.php');

    if ($_GET['Semester'] == "All Semester" && $_GET['YearLevel'] == "All Year Level" ) {
        $query = "SELECT *from  `_tblcurriculum_subject` where CurriculumID =   ? ";
        $statement = $conn->prepare($query);
        $statement->execute([
            $_GET['CurriculumID'],
        ]);
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
        return;
    }
    
    
    if($_GET['Semester'] == "All Semester"){
        $query = "SELECT *from  `_tblcurriculum_subject` where CurriculumID = 
        ? and YearLevel = ?  ";
        $statement = $conn->prepare($query);
        $statement->execute([
            $_GET['CurriculumID'],
            $_GET['YearLevel'],
        ]);
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
        return;
    }


    if ($_GET['YearLevel'] == "All Year Level") {
        $query = "SELECT *from  `_tblcurriculum_subject` where CurriculumID = 
        ? and YearLevel = ?  ";
        $statement = $conn->prepare($query);
        $statement->execute([
            $_GET['CurriculumID'],
            $_GET['YearLevel'],
        ]);
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
        return;
    }


    $query = "SELECT *from  `_tblcurriculum_subject` where CurriculumID = 
        ? and YearLevel = ? and Semester = ? ";
    $statement = $conn->prepare($query);
    $statement->execute([
        $_GET['CurriculumID'],
        $_GET['YearLevel'],
        $_GET['Semester'],
    ]);
    echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    
    
    

