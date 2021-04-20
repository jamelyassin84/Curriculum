 <tr>
     <td colspan="9" class="text-primary">
         <h6 class="mb-0 mt-2">3rd Year - 2nd Semester </h6>
     </td>
 </tr>
 <?php
    include('../../../../../../connection.php');

    $index = 0;
    foreach (json_decode($_POST['data']) as $data) {
        if ($data->YearLevel == "Third" && $data->Semester  == "Second") {

            $query = "SELECT `CourseNumber` from  `_tblcurriculum_subject_prerequisites` where CurriculumSubjectID = ?";
            $statement = $conn->prepare($query);
            $statement->execute([
                $data->CurriculumSubjectID,
            ]);
            $pre_requisites = $statement->fetchAll(PDO::FETCH_ASSOC);

            // fetch all subjects 
            $query = "SELECT `CourseNumber` from  `_tblsubject` ";
            $statement = $conn->prepare($query);
            $statement->execute();
            $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);

            // fetch subjects 
            $query = "SELECT * from  `_tblsubject` where CourseNumber = ?";
            $statement = $conn->prepare($query);
            $statement->execute([
                $data->CourseNumber,
            ]);
            $subject = $statement->fetch(PDO::FETCH_OBJ); ?>
         <tr>
             <td><?= $subject->CourseNumber ?></td>
             <td><?= $subject->DescriptiveTitle  ?></td>
             <td class="text-center"><?= $subject->LectureUnits ?></td>
             <td class="text-center"><?= $subject->LaboratoryUnits ?></td>
             <td class="text-center"><?= $subject->TotalCreditedUnits ?></td>

             <td id="posted"><?= isset($pre_requisites[0]['CourseNumber']) ? $pre_requisites[0]['CourseNumber'] : 'N/A' ?></td>
             <td id="posted"><?= isset($pre_requisites[0]['CourseNumber']) ? $pre_requisites[1]['CourseNumber'] : 'N/A' ?></td>


             <td class="text-center"><?= $subject->TotalHoursPerSemester ?></td>
             <td></td>
         </tr>
 <?php $index += 1;
        }
    } ?>
 <script>
     function addPreRequisite(CurriculumSubjectID, CourseNumber) {
         $.post('/registry/curriculum/curriculum/actions/pre-requisite/add.php', {
             CurriculumSubjectID: CurriculumSubjectID,
             CourseNumber: $('#sel-pre-requisites').val(),
         }, (message) => {
             if (message == `success`) {
                 modal_alert('Pre requisite added', "success", 5000)
                 getCurriculumSubjects(CurriculumID)
                 return
             }
             modal_alert(message, "danger", 2000);
         })
     }
 </script>