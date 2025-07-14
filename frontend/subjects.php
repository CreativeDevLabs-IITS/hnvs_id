
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Subjects</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">List</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Subjects</div>
                    <a href="add-subject.php" class="btn btn-primaryfw-semibold text-white" style="background-color: #3498db; border: none">Add Subject</a>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" class="bg-white p-4 shadow rounded-4 mt-4" style="display: none;">
                    <div class="d-flex justify-content-end align-items-center gap-2">
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
                            <div class="" data-bs-toggle="dropdown" style="cursor: pointer;" aria-expanded="false" >
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="22"  height="22"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-filter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>                            
                            </div>

                            <ul class="dropdown-menu">
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                        Year level
                                    </a>
                                </li>
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                        Section
                                    </a>
                                </li>
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                        School Year
                                    </a>
                                </li>
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                        Semester
                                    </a>
                                </li>
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#importModal" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="print" style="font-size: 13px" id="printTable" href="#">
                                        Teacher
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px;">
                            <thead class="table-secondary border">
                                <tr>
                                    <th scope="">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Year Level</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">School Year</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="subject_table_body">
                                
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center" style="width: 50%;">
                            <div id="paginationInfo" style="font-size: 14px;"></div>
                            <div class="" id="pagination"></div>
                        </div>
                    </div>
                </div>

                <div id="no-internet" class="justify-content-center flex-column align-items-center" style="height: 80%; display: none">
                    <img src="http://hnvs_backend.test/images/no-connection.png" style="width: 10%;" alt="">
                    <div class="text-secondary fs-6 text-danger">No internet connection</div>
                    <div class="text-secondary" style="font-size: 13px;">Please check your network settings and try again. Some features may not work until you're back online.</div>
                </div>

            </div>
        </div>

    </div>

    <!-- delete modal -->
    <div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  style="font-size: 14px">
                    Are you sure you want to delete <strong id="subjectName"></strong> subject?
                </div>
                <div class="d-flex flex-row-reverse p-3 gap-3">
                    <form action="" method="post" method="POST">
                        <input type="text" id="subjectID" hidden>
                        <button type="submit" id="deleteSubjectBtn" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                            Delete
                            <div class="spinner-border spinner-border-sm" id="deleteSubjectSpinner" style="display: none" role="status">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="http://hnvs_backend.test/dist/js/dropify.min.js"></script>

    <?php include 'partials/_logout.php' ?>

    <script>
        // prevent backing
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('token');
            if(!token) {
                location.replace('http://hnvs.system.test/');
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
        });

        // populate on load
        document.addEventListener('DOMContentLoaded', () => {
            fetchStudents();
        })

        let currentPage = 1;
        let currentSearch = '';

        function renderTable(subjects, mete) {
            const tbody = document.getElementById('subject_table_body');
            tbody.innerHTML = '';

            if(subjects.length < 1) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 5;
                emptyCell.style.textAlign = 'center';
                emptyCell.classList.add('text-muted');
                emptyCell.textContent = 'No records found';

                emptyRow.appendChild(emptyCell);
                tbody.appendChild(emptyRow);
            }

            subjects.forEach((subject, index) => {
                let row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${subject.name}</td>
                <td>${subject.section}</td>
                <td>${subject.year_level}</td>
                <td>${subject.semester}</td>
                <td>${subject.teachers.map(teacher => teacher.firstname + ' ' + teacher.lastname).join(', ')}</td>
                <td>${subject.school_year}</td>
                <td>
                    <div class="dropdown d-flex flex-row-reverse no_print" id="noPrint">
                        <div class="" data-bs-toggle="dropdown" style="cursor: pointer;" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="#002"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        </div>
                        

                        <ul class="dropdown-menu">
                            <li class="p-1">
                                <a class="text-dark" href="student-roster.php?id=${subject.id}" style="text-decoration: none; font-size: 14px">
                                    <svg class="text-dark me-2" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>                            
                                    Subject Roster
                                </a>
                            </li>
                            <li class="p-1">
                                <a href="edit-subject.php?id=${subject.id}" style="text-decoration: none; font-size: 14px">
                                    <svg class="text-primary me-2" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                    Edit subject
                                </a>
                            </li>
                            <li class="p-1">
                                <div class="text-danger" id="subjectDeleteBtn" style="font-size: 14px" data-id="${subject.id}" data-name="${subject.name}" data-bs-toggle="modal" data-bs-target="#deleteSubjectModal">
                                    <svg class="text-danger me-2" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    Delete Subject
                                </div>
                            </li>
                        </ul>
                    </div>
                </td>
                `;

                tbody.appendChild(row);
            })

        }

        function renderPagination(meta, isSearcj = false) {
            const paginationInfo = document.getElementById('paginationInfo');
            paginationInfo.textContent = `Showing ${(meta.current_page - 1) * meta.per_page + 1} to ${Math.min(meta.current_page * meta.per_page, meta.total)} of ${meta.total} students`;

            const container = document.getElementById('pagination');
            container.innerHTML = '';

            const totalPages = meta.last_page;
            const current = meta.current_page;
            const maxVisible = 5;
            let start = Math.max(1, currentPage - Math.floor(maxVisible / 2));
            let end = Math.min(totalPages, start + maxVisible - 1);

            if(end - start < maxVisible - 1) {
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

        function fetchStudents(page = 1, ) {
            currentSearch = '';
            fetch(`http://hnvs_backend.test/api/subject/list?page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                const subjects = data.subjects.data;
                const meta = data.subjects;
                renderTable(subjects, meta);
                renderPagination(meta, false);
                console.log(data);
            })
        }

        // function fetchSearchResults(search, page = 1) {
        //     co
        // }



        // $(document).ready(function() {
        //     fetch('http://hnvs_backend.test/api/subject/list', {
        //         method: 'GET',
        //         headers: {
        //             'Accept': 'Application/json',
        //             'Authorization': 'Bearer ' + localStorage.getItem('token')
        //         }
        //     })
        //     .then(res => res.json())
        //     .then(data => {
        //         const subjects = data.subjects;
        //         const tbody = document.getElementById('subject_table_body');

        //         if(subjects.length < 1) {
        //             const emptyRow = document.createElement('tr');
        //             const emptyCell = document.createElement('td');
        //             emptyCell.colSpan = 5;
        //             emptyCell.style.textAlign = 'center';
        //             emptyCell.classList.add('text-muted');
        //             emptyCell.textContent = 'No records found';

        //             emptyRow.appendChild(emptyCell);
        //             tbody.appendChild(emptyRow);
        //         }
                
        //         subjects.forEach((subject, index) => {
        //             let row = document.createElement('tr');
        //             row.innerHTML = `
        //             <td style="border-bottom: none">${index + 1}</td>
        //             <td style="border-bottom: none">${subject.name}</td>
        //             <td style="border-bottom: none">${subject.section}</td>
        //             <td style="border-bottom: none">${subject.school_year}</td>
        //             <td style="border-bottom: none">${subject.year_level}</td>
        //             <td style="border-bottom: none">${subject.semester}</td>
        //             <td style="border-bottom: none">
        //                 <div class="d-flex gap-2">

        //                     <a href="student-roster.php?id=${subject.id}">
        //                         <svg class="text-primary" xmlns="http://www.w3.org/2000/svg"  width="22"  height="22"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>                            
        //                     </a>

        //                     <a href="edit-subject.php?id=${subject.id}">
        //                         <svg class="text-primary" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
        //                     </a>

        //                     <div id="subjectDeleteBtn" data-id="${subject.id}" data-name="${subject.name}" data-bs-toggle="modal" data-bs-target="#deleteSubjectModal">
        //                         <svg class="text-danger" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
        //                     </div>

        //                 </div>
        //             </td>
        //             `;

        //             tbody.appendChild(row);
        //         })
        //     })
        // })

        // populate subject table
        $(document).on('click', '#subjectDeleteBtn', function() {
            document.getElementById('subjectID').value = $(this).data('id');
            document.getElementById('subjectName').textContent = $(this).data('name');
        })

        // deldete subject
        $(document).on('click', '#deleteSubjectBtn', function(e) {
            e.preventDefault();
            document.getElementById('deleteSubjectSpinner').style.display = 'block';
            
            fetch('http://hnvs_backend.test/api/subject/delete', {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    id: document.getElementById('subjectID').value
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
                    })
                    .then (() => {
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
                        timer: 4000,
                    })
                }
            })
            .finally(() => {
                document.getElementById('deleteSubjectSpinner').style.display = 'none';
            })
        })

    </script>