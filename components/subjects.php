<?php
$index = 0;
foreach (json_decode($_POST['data']) as $data) { ?>
    <tr>
        <td><i onclick="addCurriculumSubject('<?= $data->SubjectID ?>','<?= $data->CourseNumber ?>')" class="bi bi-chevron-left float-start"></i></td>
        <td><?= $data->CourseNumber ?></td>
        <td><?= $data->DescriptiveTitle ?></td>
    </tr>
<?php $index += 1;
} ?>

<script>
    $('.bi-chevron-left').css('display', Posted == 1 ? 'none' : 'block')
</script>