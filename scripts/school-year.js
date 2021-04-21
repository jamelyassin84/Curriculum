var schoolyear = {
    component: '/registry/curriculum/curriculum/components/school-year.php',
    url: '/registry/curriculum/curriculum/actions/school-year/',
}


function getCSchoolYear() {
    $.get(`${ schoolyear.url }show.php`, (data) => {
        $.post(`${ schoolyear.component }`, { data: data }, (component) => {
            $('#sel-school-year, #sel-school-year-update').html(component)
        })
    })
}

getCSchoolYear()