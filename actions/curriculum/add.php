<?php
    include('../../../../../connection.php');
if(  $_POST['CourseCode'] == ""){
    echo "Course Code Could not be blank.";
    return;
}
$statement = $conn->prepare(
    "SELECT  `CurriculumID` from  _tblcurriculum 
    where 
        `CourseCode` = ? AND `CurriculumDescription` = ?   AND `EffectiveAY` = ?  AND `EffectiveSemester` = ?  AND `LocationCode` = ? 
    "
);
$statement->execute([
    $_POST['CourseCode'],
    $_POST['CurriculumDescription'],
    $_POST['EffectiveAY'],
    $_POST['EffectiveSemester'],
    $_POST['LocationCode'],
]);

if (count($statement->fetchAll(PDO::FETCH_ASSOC)) != 0) {
    echo "Error: Please enter a unique currirculum";
    return;
}

try {
    $conn->beginTransaction();
    $statement = 'INSERT INTO `_tblcurriculum` ( 
            `CourseCode`,
            `CurriculumDescription`,
            `EffectiveAY`,
            `MajorCode`,
            `EffectiveSemester`,
            `LocationCode`,
            `Posted`,
            `isActive`
        ) VALUES (?,?,?,?,?,?,?,?)';
    $conn->prepare($statement)->execute([
        $_POST['CourseCode'],
        $_POST['CurriculumDescription'],
        $_POST['EffectiveAY'],
        $_POST['MajorCode'] == "" ? null :$_POST['MajorCode'],
        $_POST['EffectiveSemester'],
        $_POST['LocationCode'],
        $_POST['Posted'],
        $_POST['isActive'],
    ]);
    $conn->commit();
    echo 'success';
} catch (PDOException $e) {
    $conn->rollback();
    echo "Error. Please try again. " . $e;
}

