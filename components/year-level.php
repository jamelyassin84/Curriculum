<option>All Year Level</option>
<?php
$index = 0;
foreach (json_decode($_POST['data']) as $data) { ?>
<option><?= $data->YearLevel ?></option>
<?php $index += 1; } ?>