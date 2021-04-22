 <tr>
     <td colspan="9" class="text-primary">
         <h6 class="mb-0 mt-2">3rd Year - 1st Semester </h6>
     </td>
 </tr>
 <?php
    include('../../../../../../connection.php');

    $index = 0;
    foreach (json_decode($_POST['data']) as $data) {
        if ($data->YearLevel == "Third" && $data->Semester  == "First") {

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

             <?php if (isset($pre_requisites[0]['CourseNumber'])) { ?>
                 <td id="not-posted" class="text-center"><?= $pre_requisites[0]['CourseNumber'] ?></td>

             <?php }
                if (!isset($pre_requisites[0]['CourseNumber'])) { ?>
                 <td id="not-posted" class="text-center">
                     <select id="sel-pre-requisites<?= $index ?>" onchange="addPreRequisite('<?= $data->CurriculumSubjectID ?>','<?= $index ?>')" class="w-100">
                         <option selected disabled>Prerequisite 1</option>
                         <!-- <option> </option> -->
                         <?php foreach ($subjects as $requisite) { ?>
                             <option><?= $requisite['CourseNumber'] ?></option>
                         <?php } ?>
                     </select>
                 </td>

             <?php }
                if (isset($pre_requisites[1]['CourseNumber'])) { ?>
                 <td id="not-posted" class="text-center"><?= $pre_requisites[1]['CourseNumber'] ?> </td>


             <?php }
                if (!isset($pre_requisites[1]['CourseNumber'])) { ?>
                 <td id="not-posted" class="text-center">
                     <select id="sel-pre-requisites<?= $index ?>" onchange="addPreRequisite('<?= $data->CurriculumSubjectID ?>','<?= $index ?>')" class="w-100">
                         <option selected disabled>Prerequisite 2</option>
                         <!-- <option> </option> -->
                         <?php foreach ($subjects as $requisite) { ?>
                             <option><?= $requisite['CourseNumber'] ?></option>
                         <?php } ?>
                     </select>
                 </td>
             <?php } ?>


             <td class="text-center"><?= $subject->TotalHoursPerSemester ?></td>
             <td><i onclick="deleteCurriculumSubject('<?= $data->CurriculumSubjectID ?>')" class="bi bi-chevron-right float-end"></i></td>
         </tr>
 <?php $index += 1;
        }
    } ?>
 <script>
     function addPreRequisite(CurriculumSubjectID, index) {
         $.post('/registry/curriculum/curriculum/actions/pre-requisite/add.php', {
             CurriculumSubjectID: CurriculumSubjectID,
             CourseNumber: $(`#sel-pre-requisites${index}`).val(),

         }, (message) => {
             if (message == `success`) {
                 modal_alert('Pre requisite added', "success", 5000)
                 getCurriculumSubjects(CurriculumID)
                 return
             }
             modal_alert(message, "danger", 2000);
         })
     }
     $('#lock-curriculum').css('display', 'block')
     $('.bi bi-pencil, .bi bi-trash').css('display', 'block')
 </script>