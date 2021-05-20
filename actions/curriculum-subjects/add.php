<?php

include('../../../../../connection.php');

$statement = $conn->prepare(
    "SELECT  `SubjectID` from  _tblcurriculum_subject 
    where `SubjectID` = ?  and CurriculumID = ?");
$statement->execute([ 
    $_POST['SubjectID'],
    $_POST['CurriculumID'],
]);

if (count($statement->fetchAll(PDO::FETCH_ASSOC)) != 0) {
    echo "Error: Subject already exists on this curriculum";
    return;
}

$statement = $conn->prepare(
    "SELECT  `CurriculumID` from  _tblcurriculum 
    where `CurriculumID` = ?  and Posted = ?"
);
$statement->execute([
    $_POST['CurriculumID'],
   1,
]);

if (count($statement->fetchAll(PDO::FETCH_ASSOC)) != 0) {
    echo "Error: This Currirculum is already Locked. Please Contact the IT Department to make changes";
    return;
}

try {
    $conn->beginTransaction();
    $statement = 'INSERT INTO `_tblcurriculum_subject` ( 
            `CurriculumID`,
            `YearLevel`,
            `Semester`,
            `SubjectID`
        ) VALUES (?,?,?,?)';
    $conn->prepare($statement)->execute([
        $_POST['CurriculumID'],
        $_POST['YearLevel'],
        $_POST['Semester'],
        $_POST['SubjectID'],
    ]);
    $conn->commit();
    echo 'success';
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}
