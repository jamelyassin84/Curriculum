 <?php
    include('../../../../connection.php');
    $index = 0;
    foreach (json_decode($_POST['data']) as $data) {
        $index += 1;
    ?>
     <option class="opt-sy" id="opt-sy<?php echo $index ?>"><?php echo $data->SY ?></option>
     <?php
        if ($data->isActive == 1) { ?>
         <script>
             $("#opt-sy<?php echo $index ?>").attr('selected', true)
         </script>
 <?php }
    }  ?>

 <script>
 </script>