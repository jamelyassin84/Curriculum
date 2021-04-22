  <?php
    $index = 0;
    foreach (json_decode($_POST['data']) as $data) { ?>

      <tr id="tr-curriculum<?php echo $index ?>" onclick="getCurriculumSubjects(
            '<?= $data->CurriculumID ?>',
            '<?= $data->Posted ?>',
      )">
          <td>
              <i class="bi <?= $data->Posted == 1 ? 'bi-lock-fill' : ' bi-unlock-fill' ?> "></i>
          </td>
          <td><?= $data->CurriculumDescription ?></td>
          <td><i style="display:<?= $data->Posted == 1 ? 'none' : 'block' ?>" data-bs-toggle="modal" data-bs-target="#edit-curriculum" onclick="editCurriculum(
              '<?= $data->CurriculumID ?>',
              '<?= $data->CurriculumDescription ?>',
              '<?= $data->EffectiveAY ?>',
              '<?= $data->EffectiveSemester ?>',
          )" class="bi bi-pencil"></i></td>
          <td><i style="display:<?= $data->Posted  == 1 ? 'none' : 'block' ?>" onclick="deleteCurriculum(<?= $data->CurriculumID ?>)" class="bi bi-trash"></i></td>
      </tr>
  <?php $index += 1;
    } ?>

  <script>
      function editCurriculum(CurriculumID, CurriculumDescription, EffectiveAY, EffectiveSemester) {
          $('#modal-footer-edit-curriculum').html(
              `<button onclick="updateCurriculum(${CurriculumID})" type="button" class="btn btn-primary btn-sm">Update Curriculum</button>`
          )
          $('#txt-curriculum-description-update').val(CurriculumDescription)
      }
      $(`#tr-curriculum${tRToHighlight}`).click().addClass("highlight");
      $('#tbody-curriculum tr').on('click', function() {
          $('tr').removeClass('highlight');
          $(this).addClass('highlight');
      });
  </script>