<?php $index = 0;
if (count(json_decode($_POST['data'])) != 0) {
    foreach (json_decode($_POST['data']) as $data) { ?>
        <option value="<?= $data->MajorCode ?>" class="<?= $data->MajorCode ?>"><?= $data->MajorDescription ?></option>
    <?php $index += 1;
    } ?>
    <script>
        $('.hide-major-select').css('display', 'block')
    </script>
<?php } else { ?>
    <script>
        $('.hide-major-select').css('display', 'none')
    </script>
<?php } ?>

<script>
    $('#sel-majors').first().attr('selected', true)
</script>