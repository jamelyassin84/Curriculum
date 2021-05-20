<?php

include('../../../../../connection.php');

$statement = $conn->prepare(
    "SELECT  `RecordID` from  _tblcurriculum_subject_prerequisites 
    where `CurriculumSubjectID` = ?  and SubjectID = ?"
);
$statement->execute([
    $_POST['CurriculumSubjectID'],
    $_POST['SubjectID'],
]);

if (count($statement->fetchAll(PDO::FETCH_ASSOC)) != 0) {
    echo "Error: Duplicate Pre Requisite";
    return;
}

try {
    $conn->beginTransaction();
    $statement = 'INSERT INTO `_tblcurriculum_subject_prerequisites` ( 
            `CurriculumSubjectID`,
            `SubjectID`
        ) VALUES (?,?)';
    $conn->prepare($statement)->execute([
        $_POST['CurriculumSubjectID'],
        $_POST['SubjectID'],
    ]);
    $conn->commit();
    echo 'success';
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}