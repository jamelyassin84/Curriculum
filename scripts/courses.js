var courses = {
    component: '/registry/curriculum/curriculum/components/courses.php',
    url: '/registry/curriculum/curriculum/actions/courses/',
}

function getCourses() {
    $.get(`${ courses.url }show.php`, (data) => {
        $.post(`${ courses.component }`, { data: data }, (component) => {
            $('#option-courses').html(component)
            $('#option-courses1').html(component)
        })
    })
}


var CourseCode = ""
$('#option-courses ,   #cbo-locationcode').change(() => {
    reset()
});

$(document).ready(() => {
    reset()
})

$('#option-courses1').change(() => {
    $('#tbody-curriculum-subjects').html("")
    CourseCode = $('#option-courses1').val()
    getMajors()
    getCurriculums()
})

function reset() {
    CourseCode = $('#option-courses').val()
    getMajors()
    $('#tbody-curriculum-subjects').html("")
    $('#sel-majors').html("")
    getCurriculums()
}

$('#sel-majors').change(() => {
    getCurriculums()

})


getCourses()