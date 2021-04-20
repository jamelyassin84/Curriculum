<?php $index = 0;
if (count(json_decode($_POST['data'])) != 0) {
    foreach (json_decode($_POST['data']) as $data) { ?>
        <option><?= $data->MajorCode ?></option>
        <script>
            $('.tr-major-to-hide').css('display', 'block')
        </script>
    <?php $index += 1;
    }
} else { ?>
    <script>
        $('.tr-major-to-hide').css('display', 'none')
    </script>
<?php } ?>