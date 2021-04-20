<div class="container-fluid auto-scroll">
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
                <tr class="tr-major-to-hide">
                    <td>Major</td>
                </tr>
                <tr class="tr-major-to-hide">
                    <td><select id="sel-majors" class="form-select form-select-sm"></select></td>
                </tr>
            </table>
            <table class="table-sm table mt-3 table-hover">
                <col width="5%">
                <col width="40%">
                <col width="45%">
                <col width="10%">
                <thead>
                    <th></th>
                    <th class="text-start">Curriculum Description</th>
                    <th class="text-start">Effec. AY & Sem</th>
                    <th colspan="2"></th>
                </thead>
                <tbody id="tbody-curriculum"></tbody>
            </table>
        </div>
        <div class="col-lg-6 col-md-6 col-12 bg-white border-end">
            <div class="alert alert-warning p-2 rounded mt-3">
                <b>Note:</b> To add subject to curriculum subjects click "<" icon on "All Subjects" . To remove click ">" icon on "Curriculum Subjects" . </div>

                    <div class="row">
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
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                                <th class="text-center">Lec</th>
                                <th class="text-center">Lab</th>
                                <th class="text-center">Credit Units</th>
                                <th class="text-center" colspan="2">Pre-Req.</th>
                                <th class="text-center">Hrs/Sem</th>
                                <th><i class="bi bi-chevron-right float-end"></i></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-curriculum-subjects">
                        <!-- <tbody>
                            <tr>
                                <td colspan="9" class="text-primary">
                                    <h6 class="mb-0 mt-2">1st Year - 1st Semester </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>ICT110</td>
                                <td>Introduction to Computing</td>
                                <td class="text-center">2</td>
                                <td class="text-center">3</td>
                                <td class="text-center">3</td>
                                <td class="text-center"><select class="w-100">
                                        <option>ITT23</option>
                                    </select></td>
                                <td class="text-center"><select class="w-100">
                                        <option>ITT45</option>
                                    </select></td>
                                <td class="text-center">90</td>
                                <td><i class="bi bi-chevron-right float-end"></i></td>
                            </tr>
                            <tr>
                                <td>ICT110</td>
                                <td>Introduction to Computing</td>
                                <td class="text-center">2</td>
                                <td class="text-center">3</td>
                                <td class="text-center">3</td>
                                <td class="text-center" colspan="2">ITT2, IIT3</td>
                                <td class="text-center">90</td>
                                <td><i class="bi bi-chevron-right float-end"></i></td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-primary">
                                    <h6 class="mb-0 mt-2">1st Year - 2nd Semester </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>ICT110</td>
                                <td>Introduction to Computing</td>
                                <td class="text-center">2</td>
                                <td class="text-center">3</td>
                                <td class="text-center">3</td>
                                <td class="text-center"><select class="w-100">
                                        <option>ITT23</option>
                                    </select></td>
                                <td class="text-center"><select class="w-100">
                                        <option>ITT45</option>
                                    </select></td>
                                <td class="text-center">90</td>
                                <td><i class="bi bi-chevron-right float-end"></i></td>
                            </tr>
                            <tr>
                                <td>ICT110</td>
                                <td>Introduction to Computing</td>
                                <td class="text-center">2</td>
                                <td class="text-center">3</td>
                                <td class="text-center">3</td>
                                <td class="text-center" colspan="2">ITT2, IIT3</td>
                                <td class="text-center">90</td>
                                <td><i class="bi bi-chevron-right float-end"></i></td>
                            </tr> -->
                        </tbody>
                    </table>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <h6 class="mt-5" id="tag1">All Subject</h6>
                <div class="auto-scroll" id="as">
                    <table class="table table-sm table-hover">
                        <col width="10%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-all-subjects"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        adjustscroll(["#tag1", "#as"], "#as");
    </script>
    <div class="modal fade" id="newcurriculum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Curriculum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label>Curriculum Description</label>
                            <input id="txt-curriculum-description" class="form-control form-control-sm mb-3">
                        </div>
                        <div class="col-6">
                            <label>Effectivity School Year</label>
                            <select id="sel-school-year" class="form-select form-select-sm">
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Effectivity Semester</label>
                            <select id="sel-semester" class="form-select form-select-sm">
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
                    <h5 class="modal-title" id="exampleModalLabel">New Curriculum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label>Curriculum Description</label>
                            <input id="txt-curriculum-description-update" class="form-control form-control-sm mb-3">
                        </div>
                        <div class="col-6">
                            <label>Effectivity School Year</label>
                            <select id="sel-school-year-update" class="form-select form-select-sm">
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Effectivity Semester</label>
                            <select id="sel-semester-update" class="form-select form-select-sm">
                            </select>
                        </div>
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