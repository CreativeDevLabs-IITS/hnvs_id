
<?php include 'partials/_head.php' ?>

    <div style="height: auto; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3 breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 14px;">Subject Roster</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">Student List</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Subject Roster</div>
                    <div class="d-flex gap-4">
                        <div class="mt-2 text-secondary fs-6">Total Students: <span class="text-primary fs-5 fw-bold" id="total_student"></span></div>
                        <form class="generate_search shadow">
                            <button>
                                <div class="loader" style="display: none;" id="searchLoader"></div>
                                <svg id="searchIcon" width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <input class="input" placeholder="Search" required="" type="text" id="search_student">
                        </form>
                    </div>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" class="bg-white p-4 shadow rounded-4 mt-4" style="display: none;">
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="d-flex flex-column">
                            <div class="text-secondary" style="font-size: 13px;">Section:</div>
                            <div class="fs-5 fw-semibold" style="margin-top: -5px; max-width: 280px;" id="subject_name"></div>
                        </div>
                        <div class="d-flex gap-4 align-items-end">
                            <div class="fw-semibold" id="AllBtn" style="padding: 2px 8px; color: #fff; border-radius: 5px; border: none; cursor: pointer">
                                All
                                <svg xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-caret-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 9c.852 0 1.297 .986 .783 1.623l-.076 .084l-6 6a1 1 0 0 1 -1.32 .083l-.094 -.083l-6 -6l-.083 -.094l-.054 -.077l-.054 -.096l-.017 -.036l-.027 -.067l-.032 -.108l-.01 -.053l-.01 -.06l-.004 -.057v-.118l.005 -.058l.009 -.06l.01 -.052l.032 -.108l.027 -.067l.07 -.132l.065 -.09l.073 -.081l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01l.057 -.004l12.059 -.002z" /></svg>
                            </div>
                            <div class="input-group d-flex flex-column align-items-baseline" style="width: 270px">
                                <label for="sem" style="font-size: 13px;" class="text-secondary">Stand</label>
                                <select class="" id="strandOpt" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                    <option value="" class="text-secondary" selected disabled>Select strand</option>
                                    <!-- strand -->
                                </select>                                
                            </div>

                            <div class="input-group d-flex flex-column align-items-baseline" style="width: 270px;">
                                <label for="sem" style="font-size: 13px;" class="text-secondary">Section</label>
                                <select class="" id="section" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                    <option value="" class="text-secondary" selected disabled>Select section</option>
                                    <!-- section -->
                                </select>                                
                            </div>

                            <div class="dropdown d-flex flex-row-reverse" id="noPrint" style="cursor: pointer;">
                                <div class="" data-bs-toggle="dropdown" aria-expanded="false" >
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#002"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </div>
    
                                <ul class="dropdown-menu shadow">
                                    <li class="py-1">
                                        <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-import"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" /></svg>                                        
                                            Import Students Roster
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a data-bs-toggle="offcanvas" data-bs-target="#student-roster" aria-controls="offcanvasRight" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="rosrterOffcanvas" style="font-size: 13px" id="" href="#">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                                            Manage Student Roster
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px;">
                            <thead class="table-secondary border">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Strand</th>
                                </tr>
                            </thead>
                            <tbody id="student_table_body">
                                
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center" style="min-width: 50%; max-width: 55%">
                            <div id="paginationInfo" style="font-size: 14px;"></div>
                            <div class="" id="pagination"></div>
                        </div>
                    </div>
                </div>

                <div id="no-internet" class="justify-content-center flex-column align-items-center" style="height: 80%; display: none">
                    <img src="https://hnvs-id-be.creativedevlabs.com/assets/no-connection.png" style="width: 10%;" alt="">
                    <div class="text-secondary fs-6 text-danger">No internet connection</div>
                    <div class="text-secondary" style="font-size: 13px;">Please check your network settings and try again. Some features may not work until you're back online.</div>
                </div>

            </div>
        </div>

    </div>

    <!-- delete modal -->
    <div class="modal fade" id="deleteStudent" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  style="font-size: 14px">
                    Are you sure you want to delete <strong id="studentName"></strong>
                </div>
                <div class="d-flex flex-row-reverse p-3 gap-3">
                    <form action="" method="post" method="POST">
                        <input type="text" id="studentId" hidden>
                        <button type="submit" id="deleteStudentBtn" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                            Delete
                            <div class="spinner-border spinner-border-sm" id="deleteStudentSpinner" style="display: none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </form>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- import modal -->
     <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Import Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  style="font-size: 13px">
                    <label class="text-secondary" for="editProfile" style="font-size: 15px">Drag or drop excel file here.</label>
                    <input type="file" class="dropify"  data-height="100" name="picture" id="importFile"/>
                </div>
                <div class="d-flex flex-row-reverse p-3 gap-3">
                    <button class="btn btn-primary d-flex align-items-center gap-2" id="importRoster">
                        <div class="spinner-border spinner-border-sm" id="importSpinner" style="display: none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Import
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'partials/add-roster.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://hnvs-id-be.creativedevlabs.com/dist/js/dropify.min.js"></script>

    <?php include 'partials/_logout.php' ?>
    <?php include 'partials/config.php' ?>

    <script>
        const APP_URL = "<?= APP_URL ?>"

        // prevent backing
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('token');
            if(!token) {
                location.replace('https://hnvs-id.creativedevlabs.com/');
            }else {
                if (window.history && window.history.pushState) {
                    window.history.pushState(null, null, location.href);
                    window.onpopstate = function () {
                        window.history.pushState(null, null, location.href); // Prevent back
                    };
                }
            }
        });

        window.addEventListener("load", function () {
            setTimeout(() => {
                if(navigator.onLine) {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('content').style.display = 'block';
                }else {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('no-internet').style.display = 'flex'; 
                }
            }, 800)
        })

        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happended.'
                }
            });
        });

        // populate strand dropdown
        $(document).ready(function() {
            fetch(`${APP_URL}/api/list/strands`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                let strandSelect = document.getElementById('strandOpt');
                let strands = data.strands;
                
                strands.forEach(strand => {
                    let exists = Array.from(strandSelect.options).some(
                        option => option.textContent === strand.cluster
                    )
                    
                    if(!exists) {
                        let strandOption = document.createElement('option');
                        strandOption.value = strand.cluster;
                        strandOption.textContent = strand.cluster;

                        strandSelect.appendChild(strandOption);
                    }
                })
            });
        })

        // populate section dropdown
        $(document).ready(function() {
            fetch(`${APP_URL}/api/section/list`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                let sectionSelect = document.getElementById('section');
                let sections = data.sections;
                
                sections.forEach(section => {
                    let sectionOption = document.createElement('option');
                    sectionOption.value = section.name;
                    sectionOption.textContent = section.name;

                    sectionSelect.appendChild(sectionOption);
                })
            });
        })

        // load subject name
        $(document).ready(function() {
            const urlParam = new URLSearchParams(window.location.search);
            const id = urlParam.get('id');
            
            fetch(`${APP_URL}/api/find/subject`, {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data)
                document.getElementById('subject_name').textContent = data.subject.name + ' ' + '(' + data.subject.section + ')';
                document.getElementById('subject_name_offCanvas').textContent = data.subject.name;
            })
        })

        // pupulate table and search
        let currentPage = 1;
        let currentSearch = '';

        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById('AllBtn').style.backgroundColor = '#3498db';
            fetchStudents();
            fetchStudents();
        });

        function fetchStudents(page = 1) {
            const url_param = new URLSearchParams(window.location.search);
            const subject_id = url_param.get('id');
            currentSearch = '';
            fetch(`${APP_URL}/api/student/roster?page=${page}`, {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    id: subject_id
                })
            })
            .then(response => response.json())
            .then(data => {
                const students = data.students.data;
                const meta = data.students;
                renderTable(students, meta);
                renderPagination(meta, false);
                document.getElementById('total_student').textContent = students.length;
            });
        }

        function fetchSearchResults(search, page = 1) {
            const section = document.getElementById('section').value;
            const strand = document.getElementById('strandOpt').value;

            const search_params = new URLSearchParams({
                search: search,
                strand: strand,
                section: section,
                page: page
            });


            fetch(`http://hnvs_backend.test/api/search/student?${search_params.toString()}`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                const students = data.students.data;
                const meta = data.students;
                renderTable(students, meta);
                renderPagination(meta, true);
            })
        }

        let student_countInfo = 0;
        let totalFetchCount = '';

        function renderTable(students, meta) {
            const urlParam = new URLSearchParams(window.location.search);
            const id = urlParam.get('id');

            const tableBody = document.getElementById('student_table_body');
            tableBody.innerHTML = '';

            const filteredStudents = students.filter(student => {
                return student.subjects.some(subject => subject.id == id);
            });

            totalFetchCount = filteredStudents.length;

            if(filteredStudents.length  < 1) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 9;
                emptyCell.style.textAlign = 'center';
                emptyCell.classList.add('text-muted');
                emptyCell.textContent = 'No records found';

                emptyRow.appendChild(emptyCell);
                tableBody.appendChild(emptyRow);
                return;
            }

            filteredStudents.forEach(student => {
                student_countInfo += 1;
                let row = document.createElement('tr');
                row.innerHTML = `
                <td>${student.image ? `<img style="height: 30px; width: 30px; border-radius: 30px" src="${APP_URL}/storage/${student.image}" />` : 'No Image'}</td>
                <td>${student.lastname + ', ' + student.firstname + ' ' + (student.suffix != null ? student.suffix : '') + ' ' + (student.middlename != null ? student.middlename.charAt(0) : '') + '.'}</td>
                <td>${student.section.name}</td>
                <td>${student.strand.cluster == 'Industrial Arts (IA)' ? `(IA) ${student.strand.specialization}` : student.strand.cluster == 'Family and Consumer Science (FCS)' ? `(FCS) ${student.strand.specialization}` : student.strand.cluster }</td>
                `;

                tableBody.appendChild(row);
            })
        }

        function renderPagination(meta, isSearch = false) {
            const paginationInfo = document.getElementById('paginationInfo');
            const infoStart = (meta.current_page - 1) * meta.per_page + 1;
            const infoEnd = infoStart + totalFetchCount - 1;
            paginationInfo.textContent = `Showing ${infoStart} to ${infoEnd} of ${meta.total} students`;


            const container = document.getElementById('pagination');
            container.innerHTML = '';

            const totalPages = meta.last_page;
            const current = meta.current_page;
            const maxVisible = 5;
            let start = Math.max(1, current - Math.floor(maxVisible / 2));
            let end = Math.min(totalPages, start + maxVisible - 1);

            if (end - start < maxVisible - 1) {
                start = Math.max(1, end - maxVisible + 1);
            }

            if (current > 1) {
                const prev = document.createElement('button');
                prev.textContent = '<';
                prev.style.border = 'none';
                prev.style.padding = '1px 5px';
                prev.style.backgroundColor = '#ccd1d1';
                prev.style.marginRight = '8px';
                prev.style.borderRadius = '4px'
                prev.onclick = () => isSearch ? fetchSearchResults(currentSearch, current -1) : fetchStudents(current - 1);
                container.appendChild(prev);
            }

            for (let i = start; i <= end; i++) {
                const btn = document.createElement('button');
                btn.style.padding = '6px 10px';
                btn.style.border = '1px solid #aeb6bf';
                btn.style.backgroundColor = '#d7dbdd';
                if (i === current) {
                    btn.style.padding = '7px 12px';
                    btn.style.border = 'none';
                    btn.style.backgroundColor = '#3498db';
                    btn.style.color = '#fff';
                }
                btn.textContent = i;
                btn.disabled = i === current;
                btn.onclick = () => isSearch ? fetchSearchResults(currentSearch, i) : fetchStudents(i);
                container.appendChild(btn);
            }

            if(current < totalPages) {
                const next = document.createElement('button');
                next.textContent = '>';
                next.style.border = 'none';
                next.style.padding = '1px 5px';
                next.style.backgroundColor = '#ccd1d1';
                next.style.marginLeft = '8px';
                next.style.borderRadius = '4px'
                next.onclick = () => isSearch ? fetchSearchResults(currentSearch, current + 1) : fetchStudents(current + 1);
                container.appendChild(next);
            }
        }

        const search = document.getElementById('search_student');
        const searchIcon = document.getElementById('searchIcon');
        const searchLoader = document.getElementById('searchLoader');

        search.addEventListener('input', () => {
            searchIcon.style.display = 'none',
            searchLoader.style.display = 'block';

            currentSearch = search.value.trim();

            if(currentSearch === '') {
                fetchStudents();
            } else {
                fetchSearchResults(currentSearch, 1);
            }

            setTimeout(() => {
                searchLoader.style.display = 'none';
                searchIcon.style.display = 'block';
            }, 300);

        })

        // filter by strand and section
        document.getElementById('strandOpt').addEventListener('change', () => {
            document.getElementById('AllBtn').style.backgroundColor = 'transparent';
            document.getElementById('AllBtn').style.color = '#000';
            currentSearch = search.value.trim();
            fetchSearchResults(currentSearch, 1);
        });

        document.getElementById('section').addEventListener('change', () => {
            document.getElementById('AllBtn').style.backgroundColor = 'transparent';
            document.getElementById('AllBtn').style.color = '#000';
            currentSearch = search.value.trim();
            fetchSearchResults(currentSearch, 1);
        });

        document.getElementById('AllBtn').addEventListener('click', () => {
            fetchStudents();
            document.getElementById('strandOpt').value = '';
            document.getElementById('section').value = '';
            currentSearch.value = '';
            document.getElementById('AllBtn').style.backgroundColor = '#3498db';
            document.getElementById('AllBtn').style.color = '#fff';
        })

        // populate delete modal
        $(document).on('click', '#deleteBtn', function(e) {
            e.preventDefault();
            document.getElementById('studentId').value = $(this).data('id');
            document.getElementById('studentName').textContent = $(this).data('name') + ' ' + $(this).data('lname');
        })

        // delete
        $(document).on('click', '#deleteStudentBtn', function(e) {
            e.preventDefault();
            let id = document.getElementById('studentId').value;
            
            fetch(`${APP_URL}/api/delete/student`, {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Content-Type': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(res => res.json())
            .then(response => {
                if (response.message) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        color: "#fff",
                        background:  "#28b463",
                        width: 350,
                        toast: true,
                        title: response.message,
                        showConfirmButton: false,
                        timer: 900,
                    }).then (() => {
                        location.reload();
                    });
                }else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        color: "#fff",
                        width: 350,
                        background:  "#cc0202",
                        toast: true,
                        title: response.error,
                        showConfirmButton: false,
                        timer: 3000,
                    })
                }
            })
        })

        // import roster
        $(document).on('click', '#importRoster', function() {
            document.getElementById('importSpinner').style.display = 'block';
            let file = document.getElementById('importFile').files[0];
            let formData = new FormData();
            formData.append('file', file);

            fetch(`${APP_URL}/api/subject/roster/import`, {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token') 
                },
                body: formData,
                proccessData: false,
                contentType: false,
            })
            .then(res => res.json())
            .then(response => {
                if (response.skipped && response.skipped.length > 0) {
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        color: "#000",
                        background:  "#fff",
                        width: 350,
                        toast: true,
                        title: response.skipped,
                        timer: 9000,
                        timerProgressBar: true,
                    })
                    .then(() => {
                        location.reload();
                    })
                }else if(response.message) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        color: "#fff",
                        background:  "#28b463",
                        width: 350,
                        toast: true,
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000,
                    }).then(() => {
                        location.reload();
                    })
                }else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        color: "#fff",
                        width: 350,
                        background:  "#cc0202",
                        toast: true,
                        title: response.error,
                        showConfirmButton: false,
                        timer: 4000,
                    })
                }
            })
            .finally(() => {
                document.getElementById('importSpinner').style.display = 'none';
            })

        })


    </script>
