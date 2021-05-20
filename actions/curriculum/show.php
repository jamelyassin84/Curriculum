
    <?php
    include('../../../../../connection.php');
    
    if($_GET['MajorCode'] == ""){
        $query = "SELECT 
        `CurriculumID`,
        `EffectiveAY`,
        `CurriculumDescription`,
        `EffectiveSemester`,
        `Posted`
        from  `_tblcurriculum`
        where CourseCode = ? AND MajorCode = ? AND LocationCode = ? 
        ";
        $statement = $conn->prepare($query);
        $statement->execute([
            $_GET['CourseCode'],
            $_GET['MajorCode'],
            $_GET['LocationCode'],
        ]);
        echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
        return;
    }
    
    $query = "SELECT 
    `CurriculumID`,
    `EffectiveAY`,
    `CurriculumDescription`,
    `EffectiveSemester`,
    `Posted`
     from  `_tblcurriculum`
     where CourseCode = ? AND  LocationCode = ? AND MajorCode = ?
     ";
    $statement = $conn->prepare($query);
    $statement->execute([
        $_GET['CourseCode'],
        $_GET['LocationCode'],
        $_GET['MajorCode'] ,
    ]);
    echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));

 