var majors = {
    component: '/registry/curriculum/curriculum/components/majors.php',
    url: '/registry/curriculum/curriculum/actions/majors/',
}


function getMajors() {
    if (CourseCode != null) {
        $.get(`${ majors.url }show.php?CourseCode=${ CourseCode }`, (data) => {
            $.post(`${ majors.component }`, { data: data }, (template) => {
                $('#sel-majors').html(template)
                $('#sel-majors1').html(template)
                getCurriculums()
            })
        })
    }
}