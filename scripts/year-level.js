var yearLevel = {
    component: '/registry/curriculum/curriculum/components/year-level.php',
    url: '/registry/curriculum/curriculum/actions/year-level/',
}

function getYearLevel() {
    $.get(`${ yearLevel.url }show.php`, (data) => {
        $.post(`${ yearLevel.component }`, { data: data }, (template) => {
            $('#sel-year-level').html(template)
        })
    })
}
getYearLevel()