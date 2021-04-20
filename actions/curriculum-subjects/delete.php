<?php
include('../../../../../connection.php');
try {
    $conn->beginTransaction();
    $conn->prepare("DELETE FROM _tblcurriculum_subject_prerequisites WHERE CurriculumSubjectID = ? ")->execute([$_POST['CurriculumSubjectID']]);
    $conn->commit();
    $conn->beginTransaction();
    $conn->prepare("DELETE FROM _tblcurriculum_subject WHERE CurriculumSubjectID = ? ")->execute([$_POST['CurriculumSubjectID']]);
    $conn->commit();
    echo "success";
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}
