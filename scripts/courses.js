var courses = {
    component: '/registry/curriculum/curriculum/components/courses.php',
    url: '/registry/curriculum/curriculum/actions/courses/',
}

function getCourses() {
    $.get(`${ courses.url }show.php`, (data) => {
        $.post(`${ courses.component }`, { data: data }, (component) => $('#option-courses').html(component))
    })
}


var CourseCode = ""
$('#option-courses , #cbo-locationcode').change(() => {
    reset()
});

$(document).ready(() => {
    reset()
})

function reset() {
    CourseCode = $('#option-courses').val()
    $('#sel-majors').html("")
    $('#tbody-curriculum-subjects').html('')
    getMajors()
    getCurriculums()
}

getCourses()