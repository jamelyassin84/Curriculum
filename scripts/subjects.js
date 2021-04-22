var subjects = {
    component: '/registry/curriculum/curriculum/components/subjects.php',
    url: '/registry/curriculum/curriculum/actions/subjects/',
}

function getSubjects(CurriculumID, posted) {
    $('#tbody-all-subjects').html('')
    $.get(`${ subjects.url }show.php`, (data) => {
        $.post(`${ subjects.component }`, { data: data, posted: posted }, (component) => {
            $('#tbody-all-subjects').html(component)
        })
    })
}