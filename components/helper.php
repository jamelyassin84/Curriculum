<?php
include('../../../../connection.php');
$query = "SELECT `CourseNumber` from  `_tblsubject` ";
$statement = $GLOBALS['conn']->prepare($query);
$statement->execute();
$subjects =  $statement->fetchAll(PDO::FETCH_ASSOC);

class CurriculumSubject
{
    public $header;
    public $subjectRegistered = [];
    public $preRequisites = [];
    public $subjects = [];
    public $id = "";
    public $posted = "" ;
}

$curriculumSubjects = [];
foreach (json_decode($_POST['data']) as $data)
 {
    $CurriculumSubject = new CurriculumSubject();
    $yearandSem = $data->YearLevel . " Year - " . $data->Semester. " Semester";
    $CurriculumSubject->id = $data->CurriculumSubjectID;
    $CurriculumSubject->posted = json_decode($_POST['isPosted']) == 0 ? false : true;
    
    if($lastYearAndSem != $yearandSem)
    {
        $CurriculumSubject->header =  $yearandSem;
    }
    
    foreach(getRequisites($data->CurriculumSubjectID ) as $preRequisite)
    {
       array_push($CurriculumSubject->preRequisites, $preRequisite);
    }
    
    foreach (getSubjects($data->SubjectID) as $subject) 
    {
        array_push($CurriculumSubject->subjectRegistered, $subject);
    }
    
    foreach($GLOBALS['subjects'] as $subject)
    {
        array_push($CurriculumSubject->subjects, $subject);
    }
    
    array_push($curriculumSubjects, $CurriculumSubject);
    $lastYearAndSem = $yearandSem;
}

function getSubjects( $SubjectID )
{
    $query = "SELECT * from  `_tblsubject` where SubjectID =?";
    
    $statement = $GLOBALS['conn']->prepare($query);
    
    $statement->execute([
        $SubjectID
    ]);
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getRequisites($CurriculumSubjectID )
{
    $query = "SELECT `SubjectID` from  `_tblcurriculum_subject_prerequisites` where CurriculumSubjectID = ?";
    
    $statement = $GLOBALS['conn']->prepare($query);
    
    $statement->execute([
        $CurriculumSubjectID,
    ]);
    
    return  $statement->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($curriculumSubjects);

