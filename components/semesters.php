<option>All Semester</option>
<?php
include('../../../../connection.php');
$index = 0;
foreach (json_decode($_POST['data']) as $data) {
$index += 1; ?>
<option><?php echo $data->Semester ?> Semester</option>
<?php
}  ?>