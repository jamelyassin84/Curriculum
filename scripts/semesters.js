 var semesters = {
     component: '/registry/curriculum/curriculum/components/semesters.php',
     url: '/registry/curriculum/curriculum/actions/semesters/',
 }

 function getSemesters() {
     $.get(`${ semesters.url }show.php`, (data) => {
         $.post(`${ semesters.component }`, { data: data }, (component) => {
             $('#sel-semester, #sel-semester-update, #sel-semester-show').html(component)
         })
     })
 }

 getSemesters()