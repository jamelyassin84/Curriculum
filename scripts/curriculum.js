var curriculum = {
    component: '/registry/curriculum/curriculum/components/curriculum.php',
    url: '/registry/curriculum/curriculum/actions/curriculum/',
}

async function getCurriculums() {
    $('#tbody-curriculum').html('')
    $('#tbody-curriculum-subjects').html("")
    const filter = {
        MajorCode: $('#sel-majors').val() == null || $('#sel-majors').val() == "" ? null : $('#sel-majors').val(),
        CourseCode: CourseCode,
        LocationCode: $('#cbo-locationcode').val()
    }
    $.get(`${ curriculum.url }show.php?`, filter, (data) => {
        $.post(`${ curriculum.component }`, { data: data }, (component) => {
            $('#tbody-curriculum-subjects').html("")
            $('#tbody-curriculum').html(component)
        })
    })
}
var tRToHighlight = 0

$('#sel-majors').change(async() => {
    await getCurriculums()

})


function addCurriculum() {
    if ($('#txt-curriculum-description').val() == "") {
        modal_alert('One or more field should not be empty', "danger", 5000);
        return
    }
    if ($('#sel-semester').val() == 'All Semester') {
        modal_alert(`Effectivity Semester cannot 'be All Semester'`, "danger", 5000);
        return
    }
    if ($('#sel-year-level').val() == "All Year Level") {
        modal_alert('Error: School Year is All Year Levels', "danger", 5000);
    }
    const curriculum = {
        CourseCode: $('#option-courses1').val(),
        MajorCode: $('#sel-majors1').val() == "" ? null : $('#sel-majors1').val(),
        CurriculumDescription: $('#txt-curriculum-description').val(),
        EffectiveAY: $('#sel-school-year').val(),
        EffectiveSemester: 'First',
        LocationCode: $('#cbo-locationcode').val(),
        isActive: 1,
        Posted: 0
    }

    $.post(`/registry/curriculum/curriculum/actions/curriculum/add.php`, curriculum, (message) => {
        if (message.includes('success')) {
            modal_alert('New Curricuum added', "success", 5000)
            getCurriculums()
            clearCurriculumModal()
            return
        }
        modal_alert(message, "danger", 5000);
    })
}



function updateCurriculum(CurriculumID) {
    if ($('#sel-year-level').val() == "All Year Level") {
        modal_alert('Error: School Year is All Year Levels', "danger", 5000);
    }
    const curriculum = {
        CurriculumDescription: $('#txt-curriculum-description-update').val(),
        EffectiveAY: $('#sel-school-year-update').val(),
        EffectiveSemester: 'First',
        LocationCode: $('#cbo-locationcode').val(),
        CurriculumID: CurriculumID,
    }
    $.post(`/registry/curriculum/curriculum/actions/curriculum/update.php`, curriculum, (message) => {
        if (message.includes('success')) {
            modal_alert('Curriculum successfully Updated', "success", 5000)
            getCurriculums()
            clearCurriculumModal()
            return
        }
        modal_alert(message, "danger", 5000);
    })
    clearCurriculumModal()
}

function deleteCurriculum(id) {
    modal_confirm(
        `confirmDeleteCurriculum(${ id })`,
        'btndisabled("false", "btnPost")',
        'Are you sure you want to delete this curriculum?',
        'confirm'
    );
}

function confirmDeleteCurriculum(id) {
    const url = `/registry/curriculum/curriculum/actions/curriculum/delete.php`
    $.post(url, { CurriculumID: id }, (message) => {
        if (message.includes('success')) {
            modal_alert('Curriculum successfully deleted', "success", 5000)
            getCurriculums()
            return
        }
        modal_alert('Remove all data associated with this first', "danger", 2000);
    })
}

function clearCurriculumModal() {
    $('#txt-curriculum-description').val("")
    $('#newcurriculum').modal('hide')
    $('#edit-curriculum').modal('hide')
}


function lockCurriculum() {
    if (CurriculumID != 0) {
        modal_confirm(
            `confirmLockCurriculum()`,
            'btndisabled("false", "btnPost")',
            'Locked Curriculum cannot be unlocked for data integrity reasons. Continue?',
            'confirm'
        );
        return
    }
    modal_alert('Please save Curriculum to lock', "danger", 2000);
}

function confirmLockCurriculum() {
    $.post(`${ curriculum.url }lock.php`, { CurriculumID: CurriculumID }, (message) => {
        if (message.includes('success')) {
            modal_alert('Curriculum successfully locked', "success", 5000)
            getCurriculums()
            return
        }
        modal_alert(message, "danger", 2000);
    })

}