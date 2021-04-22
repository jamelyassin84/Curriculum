var curriculumSubjects = {
    component: '/registry/curriculum/curriculum/components/curriculum-subject.php',
    url: '/registry/curriculum/curriculum/actions/curriculum-subjects/',
}

var component = "/registry/curriculum/curriculum/components/curriculum-subjects-components/"
var lockComponent = "/registry/curriculum/curriculum/components/curriculum-subjects-locks/"

yearLevelsArray = [
    '1st',
    '2nd',
    '3rd',
    '4th',
]

semestersArray = [
    '1st',
    '2nd',
    '3rd',
    '4th',
]

var CurriculumSubjectsID = ""
var Posted = 0

var CurriculumID = 0

function getCurriculumSubjects(id, posted) {
    $('#tbody-curriculum-subjects').html("")
    let semester = $('#sel-semester-show').val().split(" ")
    CurriculumID = id
    posted == 1 ? Posted = 1 : Posted = 0
    $.get(`${ curriculumSubjects.url }show.php`, {
        CurriculumID: id,
        YearLevel: $('#sel-year-level').val(),
        Semester: semester[0],
    }, async(data) => {
        await setYearLevel($('#sel-year-level').val())
        await setSemester(semester[0])
        getSubjects(CurriculumID, posted)
        if (posted != 1) {
            for (let year in yearLevelsArray) {
                for (let sem in semestersArray) {
                    await $.post(`${component + yearLevelsArray[year]}/${semestersArray[sem]}.php`, { data: data }, (template) => {
                        $('#tbody-curriculum-subjects').append(template)
                        CurriculumID = id

                    })
                }
            }

        } else {

            for (let year in yearLevelsArray) {
                for (let sem in semestersArray) {
                    await $.post(`${lockComponent + yearLevelsArray[year]}/${semestersArray[sem]}.php`, { data: data }, (template) => {
                        $('#tbody-curriculum-subjects').append(template)
                        CurriculumID = id

                    })
                }
            }
        }
    })
}


async function setYearLevel(level) {
    if (level == "First") {
        yearLevelsArray = [
            '1st',
        ]
    }
    if (level == "Second") {
        yearLevelsArray = [
            '2nd',
        ]
    }
    if (level == "Third") {
        yearLevelsArray = [
            '3rd',
        ]
    }
    if (level == "Fourth") {
        yearLevelsArray = [
            '4th',
        ]
    }
    if (level == "All Year Level") {
        yearLevelsArray = [
            '1st',
            '2nd',
            '3rd',
            '4th',
        ]
    }
}

async function setSemester(semester) {
    if (semester == "First") {
        semestersArray = [
            '1st',
        ]
    }
    if (semester == "Second") {
        semestersArray = [
            '2nd',
        ]
    }
    if (semester == "Third") {
        semestersArray = [
            '3rd',
        ]
    }
    if (semester == "Summer") {
        semestersArray = [
            '4th',
        ]
    }
    if (semester == "All") {
        semestersArray = [
            '1st',
            '2nd',
            '3rd',
            '4th',
        ]
    }
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
    const curricumSubjectData = {
        CurriculumID: CurriculumID,
        YearLevel: $('#sel-year-level').val(),
        Semester: $('#sel-semester-show').val(),
        CourseNumber: CourseNumber,
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
            getCurriculumSubjects(CurriculumID, Posted)
            return
        }
        modal_alert('Remove all data associated with this first', "danger", 2000);
    })
}