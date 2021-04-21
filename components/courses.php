    <option selected disabled>Select Course....</option>
    <?php
    $index = 0;
    foreach (json_decode($_POST['data']) as $data) { ?>
        <option value="<?php echo $data->CourseCode ?>"><?php echo $data->CourseName ?></option>
    <?php $index += 1;
    } ?>