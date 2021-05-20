<?php
include('../../../../connection.php');
$index = 0;
$response = json_decode($_POST['data']) ?>

<?php foreach ($response as $curriculumSubject) {  ?>
    <tr style="display:<?= $curriculumSubject->header == null ? 'none' : 'block' ?>" class="mt-5">
        <td colspan="9" class="text-primary">
            <h6 class="mb-0 mt-2"><?= $curriculumSubject->header ?></h6>
        </td>
    </tr>
    <?php foreach ($curriculumSubject->subjectRegistered as $subject) { ?>
        <td><?= $subject->CourseNumber ?></td>
        <td><?= $subject->DescriptiveTitle  ?></td>
        <td class="text-center"><?= $subject->LectureUnits ?></td>
        <td class="text-center"><?= $subject->LaboratoryUnits ?></td>
        <td class="text-center"><?= $subject->TotalCreditedUnits ?></td>

        <?php if ($curriculumSubject->posted == false) {
            if (!isset($curriculumSubject->preRequisites[0]->CourseNumber)) { ?>
                <td class="text-center">
                    <select id="sel-pre-requisites<?= $index ?>1" onchange="addPreRequisite('<?= $curriculumSubject->id ?>', '<?= $index ?>','1')" class="w-100">
                        <option selected disabled>Prerequisite 1</option>
                        <?php foreach ($curriculumSubject->subjects as $subject) { ?>
                            <option><?= $subject->CourseNumber ?></option>
                        <?php } ?>
                    </select>
                </td>
            <?php }
            if (isset($curriculumSubject->preRequisites[0]->CourseNumber)) { ?>
                <td class="text-center"><?= $curriculumSubject->preRequisites[0]->CourseNumber  ?> </td>
            <?php }

            echo count($curriculumSubject->preRequisites) == 2 ? '<td>,</td>' : '<td></td>';

            if (!isset($curriculumSubject->preRequisites[1])) { ?>
                <td class="text-center">
                    <select id="sel-pre-requisites<?= $index ?>2" onchange="addPreRequisite('<?= $curriculumSubject->id ?>', '<?= $index ?>','2')" class="w-100">
                        <option selected disabled>Prerequisite 2</option>
                        <?php foreach ($curriculumSubject->subjects as $subject) { ?>
                            <option><?= $subject->CourseNumber ?></option>
                        <?php } ?>
                    </select>
                </td>
            <?php }
            if (isset($curriculumSubject->preRequisites[1]->CourseNumber)) { ?>
                <td class="text-center"><?= $curriculumSubject->preRequisites[1]->CourseNumber  ?> </td>
            <?php }
        }

        if ($curriculumSubject->posted == true) { ?>
            <td>
                <?=
                isset($curriculumSubject->preRequisites[0]->CourseNumber)  ?
                    $curriculumSubject->preRequisites[0]->CourseNumber :
                    'N/A'
                ?>
            </td>
           <?= count($curriculumSubject->preRequisites) == 2 ? '<td>,</td>' : '<td></td>'; ?>
            <td>
                <?=
                isset($curriculumSubject->preRequisites[1]->CourseNumber) ?
                    $curriculumSubject->preRequisites[1]->CourseNumber :
                    'N/A'
                ?>
            </td>
        <?php } ?>

        <td class="text-center"><?= $subject->TotalHoursPerSemester ?></td>
        <td>
            <?php if ($curriculumSubject->posted == true) {  ?>
        <td></td>
    <?php } else { ?>
        <td><i onclick="deleteCurriculumSubject('<?= $curriculumSubject->id ?>')" class="bi bi-chevron-right float-end"></i></td>
    <?php } ?>
    </tr>
<?php $index  += 1;
    }
} ?>