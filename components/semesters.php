<option>All Semester</option>
<?php
include('../../../../connection.php');
$index = 0;
foreach (json_decode($_POST['data']) as $data) {
    $index += 1; ?>
    <option><?php echo $data->Semester ?></option>
<?php
}  ?>

<script>
    $('#sel-semester').find('option').get(0).remove();
    $('#sel-semester-update').find('option').get(0).remove();
</script>