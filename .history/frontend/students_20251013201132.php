
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Students</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">List</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Students</div>
                    <a href="add_student.php" id="add_student" class="btn btn-primaryfw-semibold text-white" style="background-color: #3498db; border: none">Add Student</a>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" class="bg-white p-4 shadow rounded-4 mt-4" style="display: none;">
                    <div class="d-flex justify-content-between mb-3 mt-3 gap-4 align-items-center">
                        <div class="input-group d-flex flex-column align-items-baseline" style="width: 100%">
                            <label for="sem" style="font-size: 13px;" class="text-secondary">Stand</label>
                            <select class="" id="strandFilter" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                <option value="" class="text-secondary" id="clearStrand" selected>All</option>
                                <!-- strand -->
                            </select>                                
                        </div>
                        <div class="input-group d-flex flex-column align-items-baseline" style="width: 100%">
                            <label for="doorwayFilter" style="font-size: 13px;" class="text-secondary">Doorway</label>
                            <select class="" name="doorway" id="doorwayFilter" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                <option value="" class="text-secondary" id="clearDoorway" selected>All</option>  
                                <option value="STEM">STEM</option>
                                <option value="B & E">B & E</option>
                                <option value="ASSH">ASSH</option>
                                <option value="SHW">SHW</option>
                                <option value="(IA) Driving NC II">(IA) Driving NC II</option>
                                <option value="(IA) Automotive Servicing NC I">(IA) Automotive Servicing NC I</option>
                                <option value="(IA) Manual Metal Arc Welding (MMAW) NC II">(IA) Manual Metal Arc Welding (MMAW) NC II</option>
                                <option value="(FCS) Kitchen Operations NC II">(FCS) Kitchen Operations NC II</option>
                                <option value="(FCS) Bakery Operations NC II">(FCS) Bakery Operations NC II</option>
                                <option value="(FCS) Food and Beverage Operation NC II">(FCS) Food and Beverage Operation NC II</option>
                                <option value="(FCS) Garment Artisanry NC II">(FCS) Garment Artisanry NC II</option>
                            </select>
                        </div>
                        <div class="input-group d-flex flex-column align-items-baseline" style="width: 100%;">
                            <label for="sem" style="font-size: 13px;" class="text-secondary">Section</label>
                            <select class="" id="sectionFilter" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                <option value="" class="text-secondary" id="clearSection" selected>All</option>
                                <!-- section -->
                            </select>                                
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <form class="form">
                                <button>
                                    <div class="loader" style="display: none;" id="searchLoader"></div>
                                    <svg id="searchIcon" width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <input class="input" placeholder="Search" required="" type="text" id="search_student">
                            </form>
                            <div class="dropdown d-flex flex-row-reverse no_print" id="noPrint">
                                <div class="" data-bs-toggle="dropdown" aria-expanded="false" >
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#002"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </div>
    
                                <ul class="dropdown-menu">
                                    <li>
                                        <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-import"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" /></svg>                                        
                                            Import Students
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px; overflow: visible !important">
                            <thead class="table-secondary border">
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Signature</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Strand</th>
                                    <th scope="col">LRN</th>
                                    <th scope="col">Emergency Contact</th>
                                    <th scope="col">Emergency No.</th>
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
                    <button class="btn btn-primary d-flex align-items-center gap-2" id="import">
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

    <?php include 'partials/view-info.php' ?>
    <?php include 'partials/config.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://hnvs-id-be.creativedevlabs.com/dist/js/dropify.min.js"></script>

    <?php include 'partials/_logout.php' ?>

    <script>
        const APP_URL = "<?= APP_URL  ?>"
        const FRONTEND_URL = "<? FRONTEND_URL?>"

        // prevent backing
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('token');
            if(!token) {
                location.replace(`${FRONTEND_URL}`);
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
                let strandSelect = document.getElementById('strandFilter');
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
                let sectionSelect = document.getElementById('sectionFilter');
                let sections = data.sections;
                
                sections.forEach(section => {
                    let sectionOption = document.createElement('option');
                    sectionOption.value = section.name;
                    sectionOption.textContent = section.name;
                    sectionSelect.appendChild(sectionOption);
                })
            });
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

        // pupulate table and search
        let currentPage = 1;
        let currentSearch = '';

        document.addEventListener("DOMContentLoaded", () => {
            fetchStudents();
        });

        function fetchStudents(page = 1) {
            currentSearch = '';
            fetch(`${APP_URL}/api/student/list?page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                }
            })
            .then(response => response.json())
            .then(data => {
                const students = data.students.data;
                const meta = data.students;
                renderTable(students, meta);
                renderPagination(meta, false);
            });
        }

        function fetchSearchResults(search, page = 1) {
            const section = document.getElementById('sectionFilter').value;
            const strand = document.getElementById('strandFilter').value;
            const doorway = document.getElementById('doorwayFilter').value;

            const search_params = new URLSearchParams({
                search: search,
                strand: strand,
                section: section,
                doorway: doorway,
                page: page
            });

            fetch(`${APP_URL}/api/search/student?${search_params.toString()}`, {
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

        function renderTable(students, meta) {
            const tableBody = document.getElementById('student_table_body');
            tableBody.innerHTML = '';

            if(students.length  < 1) {
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

            students.forEach((student, index) => {
                let row = document.createElement('tr');
                row.innerHTML = `
                <td>
                    <div class="dropdown d-flex no_print">
                        <div class="" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="#002"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        </div>

                        <ul class="dropdown-menu">
                            <li class="p-1">
                                <div class="" id="view_student" style="color: gray; cursor: pointer; font-size: 14px" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                data-id="${student.id}"
                                data-firstname="${student.firstname}"
                                data-middlename="${student.middlename}"
                                data-lastname="${student.lastname}"
                                data-suffix="${student.suffix}"
                                data-birth="${student.birthdate}"
                                data-age="${student.age}"
                                data-level="${student.year_level}"
                                data-section="${student.section?.name || ''}"
                                data-strand="${student.strand?.cluster || ''}"
                                data-lrn="${student.lrn}"
                                data-specialization="${student.strand?.specialization || ''}"
                                data-image="${student.image}"
                                data-brgy="${student.barangay}"
                                data-municipal="${student.municipality}"
                                data-contact="${student.contact}"
                                data-emergency="${student.emergency_contact}"
                                data-doorway="${student.doorway}"
                                data-qr="${student.qr_path}">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                    View
                                </div>
                            </li>
                            <li class="p-1">
                                <a href="edit-student.php?id=${student.id}" style="text-decoration: none; font-size: 14px">
                                    <svg class="me-2" class="text-primary" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    Edit
                                </a>
                            </li>
                            <li class="p-1">
                                <div id="deleteBtn" class="text-danger" style="cursor: pointer; font-size: 14px" data-id="${student.id}" data-name="${student.firstname}" data-lname="${student.lastname}" data-bs-toggle="modal" data-bs-target="#deleteStudent">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    Delete
                                </div>
                            </li>
                        </ul>
                    </div>
                </td>
                <td style="color: ${student.signature ?? '#F54927'}">${student.signature ? `<img style="height: 30px; width: 30px; border-radius: 30px" src="${student.signature}" />` : 'No Signature' }</td>
                <td style="color: ${student.image ?? '#F54927'}">${student.image ? `<img style="height: 30px; width: 30px; border-radius: 30px" src="${student.image}" />` : 'No Image'}</td>
                <td>${student.lastname + ', ' + student.firstname + ' ' + (student.suffix != null ? student.suffix : '') + ' ' + (student.middlename != null ? student.middlename.charAt(0) : '') + '.'}</td>
                <td>${student.section ? student.section.name : '—'}</td>
                <td style="color: ${student.strand ?? '#F54927'}">
                ${student.strand 
                ? (student.strand.cluster === 'Industrial Arts (IA)' 
                    ? `(IA) ${student.strand.specialization}`
                    : student.strand.cluster === 'Family and Consumer Science (FCS)' 
                    ? `(FCS) ${student.strand.specialization}`
                    : student.strand.cluster)
                : 'No Strand'}
                </td>
                <td>${student.lrn}</td>
                <td>${student.emergency_contact}</td>
                <td>${student.contact ?? '—'}</td>
                `;
                tableBody.appendChild(row);
            })
        }

        function renderPagination(meta, isSearch = false) {
            const paginationInfo = document.getElementById('paginationInfo');
            paginationInfo.textContent = `Showing ${(meta.current_page - 1) * meta.per_page + 1} to ${Math.min(meta.current_page * meta.per_page, meta.total)} of ${meta.total} students`;

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

        // filter by strand, doorway and section
        document.getElementById('strandFilter').addEventListener('change', () => {
            currentSearch = search.value.trim();
            fetchSearchResults(currentSearch, 1);
        });

        document.getElementById('doorwayFilter').addEventListener('change', () => {
            currentSearch = search.value.trim();
            fetchSearchResults(currentSearch, 1);
        });

        document.getElementById('sectionFilter').addEventListener('change', () => {
            currentSearch = search.value.trim();
            fetchSearchResults(currentSearch, 1);
        });

        document.getElementById('clearStrand').addEventListener('click', () => {
            fetchStudents();
            document.getElementById('strandFilter').value = '';
            currentSearch.value = '';
        });

        document.getElementById('clearDoorway').addEventListener('click', () => {
            fetchStudents();
            document.getElementById('doorwayFilter').value = '';
            currentSearch.value = '';
        });

        document.getElementById('clearSection').addEventListener('click', () => {
            fetchStudents();
            document.getElementById('sectionFilter').value = '';
            currentSearch.value = '';
        });

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


        // import student
        $(document).on('click', '#import', function() {
            document.getElementById('importSpinner').style.display = 'block';
            let file = document.getElementById('importFile').files[0];
            let formData = new FormData();
            formData.append('file', file);

            fetch(`${APP_URL}/api/student/import`, {
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
                    })
                    .then(() => {
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
