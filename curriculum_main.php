<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-12 vh-100 border-end">
            <h4 class="pt-3 w-100">Curriculum Registry
                <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#newcurriculum"><i class="bi bi-plus"></i> New</button>
            </h4>
            <table class="w-100">
                <tr>
                    <td>Filter by Course:</td>
                </tr>
                <tr>
                    <td>
                        <select id="option-courses" class="form-select form-select-sm w-100 mb-2"></select>
                    </td>
                </tr>
                <tr class="hide-major-select">
                    <td>Major</td>
                </tr>
                <tr class="hide-major-select">
                    <td><select id="sel-majors" class="form-select form-select-sm w-100"></select></td>
                </tr>
            </table>
            <table class="table-sm table mt-3 table-hover">
                <col width="5%">
                <col width="40%">
                <col width="45%">
                <col width="10%">
                <thead>
                    <th colspan="2" class="text-start">Curriculum Description</th>
                    <th class="text-start">Effect. Acad. Year</th>
                    <th colspan="2"></th>
                </thead>
                <tbody id="tbody-curriculum"></tbody>
            </table>
        </div>
        <div class="col-lg-6 col-md-6 col-12 bg-white border-end">
                <div class="alert alert-warning p-2 rounded mt-3" id="tag1">
                    <b>Note:</b> To add subject to curriculum subjects click "<" icon on "All Subjects" . To remove click ">" icon on "Curriculum Subjects" . 
                </div>

                <div class="row" id="tag2">
                    <div class="col-auto">
                        <h6 class="mt-2">Curriculum Subjects</h6>
                    </div>
                    <div class="col-auto"><label class="mt-2">Filter by:</label></div>
                    <div class="col-auto">
                        <select id="sel-year-level" class="form-select  form-select-sm"></select>
                    </div>
                    <div class="col-auto">
                        <select id="sel-semester-show" class="form-select  form-select-sm"></select>
                    </div>
                    <div class="col-auto"></div>
                    <div class="col-auto"><button id="lock-curriculum" onclick="lockCurriculum()" class="btn btn-sm btn-primary float-end ms-2">Lock Curriculum</button></div>
                </div>
                <div class="auto-scroll" id="as">
                    <table class="table table-sm table-hover table-sticky">
                        <thead>
                            <tr>
                                <th>Sub Code</th>
                                <th>Subject Description</th>
                                <th class="text-center">Lec</th>
                                <th class="text-center">Lab</th>
                                <th class="text-center">Credit Units</th>
                                <th colspan="3" class="text-center">Pre-Req.</th>
                                <th colspan="3" class="text-start">Hrs/Sem</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-curriculum-subjects"> </tbody>
                    </table>
                    <br><br><br><br>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12 vh-100">
                <h6 class="mt-3">All Subject</h6>
                <input id="search-subjects" class="form-control form-control-sm search-input mb-2">
                <div class="auto-scroll">
                    <table class="table table-sm table-hover">
                        <col width="15%">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-right">Subject Code</th>
                                <th>Subject Description</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-all-subjects"></tbody>
                    </table>
                    <div style="height: 200px !important;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newcurriculum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Curriculum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8 mb-3">
                            <label>Select Course</label>
                            <select id="option-courses1" class="form-select form-select-sm">
                            </select>
                        </div>
                        <div class="col-4 mb-3 hide-major-select">
                            <label>Select Major</label>
                            <select id="sel-majors1" class="form-select form-select-sm hide-major-select">
                            </select>
                        </div>
                        <div class="col-8">
                            <label>Curriculum Description</label>
                            <input id="txt-curriculum-description" class="form-control form-control-sm mb-3">
                        </div>
                        <div class="col-4">
                            <label>Effectivity School Year</label>
                            <select id="sel-school-year" class="form-select form-select-sm">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="addCurriculum()" type="button" class="btn btn-primary btn-sm">Add Curriculum</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-curriculum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Curriculum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label>Curriculum Description</label>
                            <input id="txt-curriculum-description-update" class="form-control form-control-sm mb-3">
                        </div>
                    </div>
                    <div class="col-4">
                        <label>Effectivity School Year</label>
                        <select id="sel-school-year-update" class="form-select form-select-sm">
                        </select>
                    </div>
                </div>
                <div class="modal-footer" id="modal-footer-edit-curriculum">
                </div>
            </div>
        </div>
    </div>
    <script src="/registry/curriculum/curriculum/scripts/subjects.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/curriculum-subject.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/year-level.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/semesters.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/courses.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/school-year.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/curriculum.js"></script>
    <script src="/registry/curriculum/curriculum/scripts/majors.js"></script>

    <script>
        $('#search-subjects').on('keyup', function() {
             var value = $(this).val().toLowerCase();
             $("#tbody-all-subjects tr").filter(function() {
                 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
             })
         })
        $('#tbody-curriculum-subjects').html('')
        $('#sel-year-level, #sel-semester-show').change(() => [
            getCurriculumSubjects(CurriculumID, Posted)
        ])
        adjustscroll(["#tag1", "#tag2","#as"], "#as");
        adjustscroll(["#tag1", "#tag2","#as"], "#as");
    </script>

    