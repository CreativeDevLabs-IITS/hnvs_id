
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Stands</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">List</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Strands</div>
                    <a href="add-strand.php" id="add_student" class="btn btn-primaryfw-semibold text-white" style="background-color: #3498db; border: none; cursor: pointer">Add Strand</a>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" class="bg-white p-4 shadow rounded-4 mt-4" style="display: none;">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px;">
                            <thead class="table-secondary border">
                                <tr>
                                    <th scope="col" class="fw-semibold" >Cluster/Strand</th>
                                    <th scope="col" class="fw-semibold">Track</th>
                                    <th scope="col" class="fw-semibold">Specialization</th>
                                    <th scope="col" class="fw-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="strand_table_body">
                                
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

    <!-- delete strand -->
    <div class="modal fade" id="deleteStrandModal" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  style="font-size: 14px">
                    Are you sure you want to delete <strong id="clusterName"></strong> strand?
                </div>
                <div class="d-flex flex-row-reverse p-3 gap-3">
                    <form action="" method="post" method="POST">
                        <input type="text" id="strandId" hidden>
                        <button type="submit" id="deleteStrandtBtn" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                            Delete
                            <div class="spinner-border spinner-border-sm" id="deleteStrandSpinner" style="display: none" role="status">
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
    <script src="http://hnvs_backend.test/dist/js/dropify.min.js"></script>
    
    <?php include 'partials/view-info.php' ?>
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
        })

        // populate table
        $(document).ready(() => {
            fetch('http://hnvs_backend.test/api/list/strands', {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                const strands = data.strands;
                console.log(strands.length);
                const tbody = document.getElementById('strand_table_body');

                if(strands.length < 1) {
                    const emptyRow = document.createElement('tr');
                    const emptyCell = document.createElement('td');
                    emptyCell.colSpan = 4;
                    emptyCell.style.textAlign = 'center';
                    emptyCell.classList.add('text-muted');
                    emptyCell.textContent = 'No records found';

                    emptyRow.appendChild(emptyCell);
                    tbody.appendChild(emptyRow);
                }
                
                strands.forEach(strand => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                    <td style="border-bottom: none">${strand.cluster}</td>
                    <td style="border-bottom: none">${strand.track == 0 ? 'Academic' : 'TechPro'}</td>
                    <td style="border-bottom: none">${strand.specialization != null ? strand.specialization : '<div class="text-secondary">--</div>'}</td>
                    <td style="border-bottom: none">
                        <div class="d-flex gap-2">
                            <a href="edit-strand.php?id=${strand.id}">
                                <svg class="text-primary" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            </a>

                            <div id="strandDeleteBtn" data-id="${strand.id}" data-cluster="${strand.cluster}" data-specialization="${strand.specialization}" data-bs-toggle="modal" data-bs-target="#deleteStrandModal">
                                <svg class="text-danger" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </div>

                        </div>
                    </td>
                    `;

                    tbody.appendChild(row);
                })
            })
        })

        // populate edit modal
        $(document).on('click', '#editStrand', function () {
            console.log($(this).data('name'))
            document.getElementById('strand_id').value = $(this).data('id');
            document.getElementById('edit_strand_name').value = $(this).data('name');
            document.getElementById('editStrandDescription').value = $(this).data('description');
            document.getElementById('editTrack').value = $(this).data('track');
        });

        // populate delete modal
        $(document).on('click', '#strandDeleteBtn', function(e) {
            e.preventDefault();
            let name = document.getElementById('clusterName');
            
            if($(this).data('specialization') != null) {
                if($(this).data('cluster') == 'Industrial Arts (IA)') {
                    name.textContent = '(IA) ' +  $(this).data('specialization');
                }else {
                     name.textContent = '(FCS) ' +  $(this).data('specialization');
                }
            }else {
                name.textContent = $(this).data('cluster');
            }

            document.getElementById('strandId').value = $(this).data('id');
        })

        // delete strand
        $(document).on('click', '#deleteStrandtBtn', function(e) {
            e.preventDefault();
            document.getElementById('deleteStrandSpinner').style.display = 'block';

            fetch('http://hnvs_backend.test/api/delete/strand', {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    id: document.getElementById('strandId').value
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
                        timer: 2000,
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
                        timer: 4000,
                    })
                }
            })
            .finally(() => {
                document.getElementById('deleteStrandSpinner').style.display = 'none';
            })
        })

    </script>