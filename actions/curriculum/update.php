 <?php
    include('../../../../../connection.php');
    $statement = $conn->prepare(
        "SELECT  `CurriculumID` from  _tblcurriculum 
        where 
        `CurriculumDescription` = ?   AND `EffectiveAY` = ?  AND `EffectiveSemester` = ?  AND `LocationCode` = ? 
        "
    );

    $statement->execute([
        $_POST['CurriculumDescription'],
        $_POST['EffectiveAY'],   
        $_POST['EffectiveSemester'],
        $_POST['LocationCode'],
    ]);
    if (count($statement->fetchAll(PDO::FETCH_ASSOC)) != 0) {
        echo "This curriculum is already existing";
        return;
    }

    try {
    $conn->beginTransaction();
    $statement = 'UPDATE _tblcurriculum SET
        `CurriculumDescription` = ?,
        `EffectiveAY` = ?,
        `EffectiveSemester` = ?,
        `LocationCode` = ?
        where `CurriculumID` = ?
    ';
    $conn->prepare($statement)->execute([
        $_POST['CurriculumDescription'],
        $_POST['EffectiveAY'],
        $_POST['EffectiveSemester'],
        $_POST['LocationCode'],
        $_POST['CurriculumID'],
    ]);
    $conn->commit();
        echo "success";
    } catch (PDOException $e) {
    $conn->rollback();
        echo "Course Code is already available";
 }