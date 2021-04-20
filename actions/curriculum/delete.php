<?php
include('../../../../../connection.php');
try {
    $conn->beginTransaction();
    $conn->prepare("DELETE FROM _tblcurriculum WHERE CurriculumID = ? ")->execute([$_POST['CurriculumID']]);
    $conn->commit();
    echo "success";
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}
