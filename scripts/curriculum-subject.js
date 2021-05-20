var curriculumSubjects = {
    component: '/registry/curriculum/curriculum/components/curriculum-subject.php',
    url: '/registry/curriculum/curriculum/actions/curriculum-subjects/',
}

var CurriculumSubjectsID = ""
var Posted = 0
var CurriculumID = 0

function getCurriculumSubjects(id, posted) {
    $('#tbody-curriculum-subjects').html("")
    let semester = $('#sel-semester-show').val().split(" ")
    CurriculumID = id
    Posted = posted == 1 ? 1 : 0
    $.get(`${ curriculumSubjects.url }show.php`, {
        CurriculumID: id,
        YearLevel: $('#sel-year-level').val(),
        Semester: semester[0],
    }, (data) => {
        getSubjects(CurriculumID, posted)
        $.post(`/registry/curriculum/curriculum/components/helper.php`, {
                data: data,
                isPosted: Posted
            },
            (response) => {
                $.post('/registry/curriculum/curriculum/components/re-render-curriculum-subjects.php', { data: response }, (template) => {
                    $('#lock-curriculum').css('display', posted == 1 ? 'none' : 'block')
                    $('#tbody-curriculum-subjects').append(template)
                    CurriculumID = id
                })
            })
    })
}

function addCurriculumSubject(SubjectID, CourseNumber) {
    if (CurriculumID == 0) {
        modal_alert('Please select curriculum first before adding', "danger", 5000);
        return
    }
    if ($('#sel-semester-show').val() == "All Semester" || $('#sel-year-level').val() == "All Year Level") {
        modal_alert('Please specify year level and semester', "danger", 5000);
        return
    }
    let semester = $('#sel-semester-show').val().split(" ")
    const curricumSubjectData = {
        CurriculumID: CurriculumID,
        YearLevel: $('#sel-year-level').val(),
        Semester: semester[0],
        CourseNumber: CourseNumber,
        SubjectID: SubjectID
    }
    $.get(`${ subjects.url }subject.php?SubjectID=${ SubjectID }`, (data) => {
        $.post(`${ curriculumSubjects.url }add.php`, curricumSubjectData, (message) => {
            if (message.includes('success')) {
                modal_alert('Subject has been successfully posted', "success", 5000)
                getCurriculumSubjects(CurriculumID, Posted)
                return
            }
            modal_alert(message, "danger", 5000);
        })
    })
}


function deleteCurriculumSubject(id) {
    modal_confirm(
        `confirmDeleteCurriculumSubject(${ id })`,
        'btndisabled("false", "btnPost")',
        'Are you sure you want to delete this curriculum?',
        'confirm'
    );
}

function confirmDeleteCurriculumSubject(id) {
    const url = `${ curriculumSubjects.url }delete.php`
    $.post(url, { CurriculumSubjectID: id }, (data) => {
        if (data == `success`) {
            modal_alert('Subject successfully deleted on the curriculum', "success", 5000)
            getCurriculumSubjects(CurriculumID, Posted)
            return
        }
        modal_alert('Remove all data associated with this first', "danger", 2000);
    })
}

function addPreRequisite(CurriculumSubjectID, index, select) {
    $.post('/registry/curriculum/curriculum/actions/pre-requisite/add.php', {
        CurriculumSubjectID: CurriculumSubjectID,
        CourseNumber: $(`#sel-pre-requisites${ index }${ select }`).val(),

    }, (message) => {
        if (message == `success`) {
            modal_alert('Pre requisite added', "success", 5000)
            getCurriculumSubjects(CurriculumID)
            return
        }
        modal_alert(message, "danger", 2000);
    })
}