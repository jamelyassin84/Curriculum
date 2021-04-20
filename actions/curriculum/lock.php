

<?php
include('../../../../../connection.php');

try {
    $conn->beginTransaction();
    $statement = 'UPDATE  _tblcurriculum SET  
        `Posted` = ?
        where `CurriculumID` = ?
        ';
    $conn->prepare($statement)->execute([
        1,
        $_POST['CurriculumID'],
    ]);
    $conn->commit();
    echo "success";
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}
