    <option selected disabled>Select Course....</option>
    <?php
    $index = 0;
    foreach (json_decode($_POST['data']) as $data) { ?>
        <option <?= $index == 0 ? 'selected' : 'aw' ?> value="<?php echo $data->CourseCode ?>"><?php echo $data->CourseName ?></option>
    <?php $index += 1;
    } ?>

    <script>
        $('#option-courses, #option-courses').change().first().attr('selected', true)
    </script>