<?php

include('../../../../../connection.php');

$statement = $conn->prepare(
    "SELECT  `CourseNumber` from  _tblcurriculum_subject 
    where `CourseNumber` = ?  and CurriculumID = ?");
$statement->execute([ 
    $_POST['CourseNumber'],
    $_POST['CurriculumID'],
]);

if (count($statement->fetchAll(PDO::FETCH_ASSOC)) != 0) {
    echo "Error: Duplicate Subject";
    return;
}

try {
    $conn->beginTransaction();
    $statement = 'INSERT INTO `_tblcurriculum_subject` ( 
            `CurriculumID`,
            `YearLevel`,
            `Semester`,
            `CourseNumber`
        ) VALUES (?,?,?,?)';
    $conn->prepare($statement)->execute([
        $_POST['CurriculumID'],
        $_POST['YearLevel'],
        $_POST['Semester'],
        $_POST['CourseNumber'],
    ]);
    $conn->commit();
    echo 'success';
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}
