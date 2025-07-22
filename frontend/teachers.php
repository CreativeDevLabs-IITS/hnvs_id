
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Teachers</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">List</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Teachers</div>
                    <a href="add_teacher.php" id="add_teacher" class="btn btn-primaryfw-semibold text-white" style="background-color: #3498db; border: none">Add Teacher</a>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" class="bg-white p-4 shadow rounded-4 mt-4" style="display: none;">
                    <div class="d-flex justify-content-end">
                            <form class="form">
                            <button>
                                <div class="loader" style="display: none;" id="searchLoader"></div>
                                <svg id="searchIcon" width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <input class="input" placeholder="Search" required="" type="text" id="search_user">
                            <!-- <button class="reset" type="reset">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button> -->
                        </form>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px;">
                            <thead class="table-secondary border">
                                <tr>
                                    <th scope="">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Middlename</th>
                                    <th scope="col">Suffix</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                
                            </tbody>
                        </table>
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
    <div class="modal fade" id="deleteTeacher" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  style="font-size: 14px">
                    Are you sure you want to delete <strong id="teacherName"></strong>
                </div>
                <div class="d-flex flex-row-reverse p-3 gap-3">
                    <form action="" method="post" method="POST">
                        <input type="text" id="teacherId" hidden>
                        <button type="submit" id="deleteTeacherBtn" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                            Delete
                            <div class="spinner-border spinner-border-sm" id="deleteUserSpinner" style="display: none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </form>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

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


        // populate table on page load
        $(document).ready(function() {
            fetch(`${APP_URL}/api/teachers/list`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                }
            })
            .then(response => response.json())
            .then(data => {
                const teachers = data.teachers
                console.log(teachers);
                const tableBody = document.getElementById('table_body');
                tableBody.innerHTML = '';

                if(teachers.length  < 1) {
                    const emptyRow = document.createElement('tr');
                    const emptyCell = document.createElement('td');
                    emptyCell.colSpan = 7;
                    emptyCell.style.textAlign = 'center';
                    emptyCell.classList.add('text-muted');
                    emptyCell.textContent = 'No records found';

                    emptyRow.appendChild(emptyCell);
                    tableBody.appendChild(emptyRow);
                }

                teachers.forEach((teacher, index) => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${teacher.image ? `<img style="height: 30px; width: 30px; border-radius: 30px" src="${APP_URL}/storage/${teacher.image}" />` : 'No Image'}</td>
                    <td>${teacher.lastname}</td>
                    <td>${teacher.firstname}</td>
                    <td>${teacher.middlename}</td>
                    <td>${teacher.suffix != null ? teacher.suffix : '<div class="text-secondary">N/A</div>'}</td>
                    <td>${teacher.contact}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="edit-teacher.php?id=${teacher.id}">
                                <svg class="text-primary" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            </a>
                            <div id="deleteBtn" data-id="${teacher.id}" data-name="${teacher.firstname}" data-lname="${teacher.lastname}" data-bs-toggle="modal" data-bs-target="#deleteTeacher">
                                <svg class="text-danger" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </div>
                        </div>
                    </td>
                    `;

                    tableBody.appendChild(row);
                })
            })
        });


        // pupulate table on search
        const search = document.getElementById('search_user');
        const searchIcon = document.getElementById('searchIcon');
        const searchLoader = document.getElementById('searchLoader')

        search.addEventListener('input', function(e) {
            searchIcon.style.display = 'none';
            searchLoader.style.display = 'block';

            if(search.contains(e.target)) {
                fetch(`${APP_URL}/api/search/teacher?search=${encodeURIComponent(search.value)}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'Application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const teachers = data.teachers
                    const tableBody = document.getElementById('table_body');
                    tableBody.innerHTML = '';

                    if(teachers.length  < 1) {
                        const emptyRow = document.createElement('tr');
                        const emptyCell = document.createElement('td');
                        emptyCell.colSpan = 7;
                        emptyCell.style.textAlign = 'center';
                        emptyCell.classList.add('text-muted');
                        emptyCell.textContent = 'No records found';

                        emptyRow.appendChild(emptyCell);
                        tableBody.appendChild(emptyRow);
                    }

                    teachers.forEach((teacher, index) => {
                        let row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${teacher.image ? `<img style="height: 30px; 30px; border-radius: 30px" src="${APP_URL}/storage/${teacher.image}" />` : 'No Image'}</td>
                        <td>${teacher.lastname}</td>
                        <td>${teacher.firstname}</td>
                        <td>${teacher.middlename}</td>
                        <td>${teacher.suffix != null ? teacher.suffix : '<div class="text-secondary">N/A</div>'}</td>
                        <td>${teacher.contact}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="edit-teacher.php?id=${teacher.id}">
                                    <svg class="text-primary" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                </a>                                
                                <div id="deleteBtn" data-id="${teacher.id}" data-name="${teacher.firstname}">
                                    <svg class="text-danger" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </div>                          
                            </div>
                        </td>
                        `;

                        tableBody.appendChild(row);
                    })
                })
                .finally(() => {
                    searchLoader.style.display = 'none';
                    searchIcon.style.display = 'block';
                })
            }
        })

        // populate delete modal
        $(document).on('click', '#deleteBtn', function(e) {
            e.preventDefault();
            document.getElementById('teacherId').value = $(this).data('id');
            document.getElementById('teacherName').textContent = $(this).data('name') + ' ' + $(this).data('lname');
        })

        // delete
        $(document).on('click', '#deleteTeacherBtn', function(e) {
            e.preventDefault();
            let id = document.getElementById('teacherId').value;
            
            fetch(`${APP_URL}/api/delete/teacher`, {
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


    </script>

<?php include 'partials/_footer.php' ?>
