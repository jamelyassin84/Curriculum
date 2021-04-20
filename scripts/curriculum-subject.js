var curriculumSubjects = {
    component: '/registry/curriculum/curriculum/components/curriculum-subject.php',
    url: '/registry/curriculum/curriculum/actions/curriculum-subjects/',
}

var CurriculumSubjectsID = ""
var CurriculumID = 0

var Posted = 0

function getCurriculumSubjects(id, Posted) {
    Posted == 1 ? Posted = 1 : Posted = 0
    $('#tbody-curriculum-subjects').html('')
    CurriculumID = id
    $.get(`${ curriculumSubjects.url }show.php`, {
        CurriculumID: id,
        YearLevel: $('#sel-year-level').val(),
        Semester: $('#sel-semester-show').val(),
    }, (data) => {
        $.post(`${ curriculumSubjects.component }`, { data: data }, (template) => {
            $('#tbody-curriculum-subjects').append(template)
            getSubjects()
        })
    })
}

function addCurriculumSubject(SubjectID, CourseNumber) {
    if (CurriculumID == 0) {
        modal_alert('Please select curriculum first before adding', "danger", 5000);
        return
    }
    const curricumSubjectData = {
        CurriculumID: CurriculumID,
        YearLevel: $('#sel-year-level').val(),
        Semester: $('#sel-semester').val(),
        CourseNumber: CourseNumber,
    }
    $.get(`${ subjects.url }subject.php?SubjectID=${ SubjectID }`, (data) => {
        $.post(`${ curriculumSubjects.url }add.php`, curricumSubjectData, (message) => {
            if (message.includes('success')) {
                modal_alert('Subject has been successfully posted', "success", 5000)
                getCurriculumSubjects(CurriculumID)
                return
            }
            modal_alert(message, "danger", 5000);
        })
    })
}


function deleteCurriculumSubject(id) {
    modal_confirm(
        `confirmDeleteCurriculumSubject(${id})`,
        'btndisabled("false", "btnPost")',
        'Are you sure you want to delete this curriculum?',
        'confirm'
    );
}


function confirmDeleteCurriculumSubject(id) {
    const url = `${curriculumSubjects.url}delete.php`
    $.post(url, { CurriculumSubjectID: id }, (data) => {
        if (data == `success`) {
            modal_alert('Subject successfully deleted on the curriculum', "success", 5000)
            getCurriculumSubjects(CurriculumID)
            return
        }
        modal_alert('Remove all data associated with this first', "danger", 2000);
    })
}


function toggleLock() {
    if (Posted == 1) {
        alert('ari')
        $('#posted').css('display', 'block')
        $('#not-posted').css('display', 'none')
        $('#lock-curriculum').css('display', 'none')
        $('.bi-chevron-right').css('display', 'none')
    } else {
        $('#posted').css('display', 'none')
        $('#not-posted').css('display', 'block')
        $('#lock-curriculum').css('display', 'block')
        $('.bi-chevron-right').css('display', 'block')
    }
}