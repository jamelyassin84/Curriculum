<option>All Semester</option>
<?php
include('../../../../connection.php');
$index = 0;
foreach (json_decode($_POST['data']) as $data) {
    $index += 1; ?>
    <option><?php echo $data->Semester ?> Semester</option>
<?php
}  ?>

<script>
    $('#sel-semester, #sel-semester-update').find('option').get(0).remove();
</script>