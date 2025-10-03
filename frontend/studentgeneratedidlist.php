<style>
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }
    .pagination {
        display: flex;
        gap: 6px;
        justify-content: center;
        flex: 1;
    }
    .pagination .page-btn {
        padding: 6px 12px;
        border: 1px solid #ccc;
        background: #f9f9f9;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }
    .pagination .page-btn:hover {
        background: #e2e6ea;
    }
    .pagination .page-btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
    .pagination-info {
        font-size: 13px;
        color: #555;
        flex-shrink: 0;
        text-align: left;
    }

    .table-container {
    position: relative;
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    .dropdown-menu {
        z-index: 2000 !important;  
    }
    
    .table-container,
    #taskTable,
    .table-header {
        overflow: visible !important;
    }
    .table-header {
    margin-bottom: 12px;
    display: flex;
    justify-content: flex-end;
    }
    .search-box {
    position: relative;
    width: 250px;
    }
    .search-box input {
    width: 100%;
    padding: 8px 32px 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 20px;
    font-size: 14px;
    transition: all 0.2s ease;
    }
    .search-box input:focus {
    border-color: #3b82f6; 
    outline: none;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
    }
    .search-box .search-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af; /* gray-400 */
    font-size: 14px;
    pointer-events: none;
    }
    #taskTable {
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 12px;
    font-size: 13px; 
    padding:5px 10px;
    }
    #taskTable thead th {
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    padding: 10px 12px;  
    font-size: 12px;  
    background-color: #e9ecef;  
    }
    #taskTable tbody td {
    padding: 8px 12px; 
    vertical-align: middle;
    font-size: 13px; 
    }
    #taskTable tbody tr:hover {
    background-color: #f5f8fa;
    transition: background-color 0.2s ease;
    }
    #taskTable tbody tr:not(:last-child) {
    border-bottom: 1px solid #e2e8f0;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Student</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">List</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center" style="position:relative;">
                    <div class="fs-4 mt-2">Generated ID</div>
                    </div>
                    <div class="table-container mt-2">
                        <!-- Search box -->
                        <div class="table-header">
                            <div class="search-box">
                                <input type="text" id="searchInput" placeholder="Search student...">
                                <span class="search-icon">🔍</span>
                            </div>
                        </div>
                        <table id="taskTable" class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th> <!-- Action sa kaliwa -->
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">LRN</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody id="studentTableBody"></tbody>
                        </table>
                        <!-- Pagination wrapper -->
                        <div class="pagination-wrapper">
                            <div id="paginationInfo" class="pagination-info"></div>
                            <div id="paginationControls" class="pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <?php include 'partials/_logout.php' ?>
    <?php include 'partials/config.php' ?>
    <script>
            const APP_URL = "<?= APP_URL ?>";
    const FRONTEND_URL = "<?= FRONTEND_URL ?>"
    document.addEventListener('DOMContentLoaded', () => {
        const token = localStorage.getItem('token');
        if(!token) {
            location.replace(`${FRONTEND_URL}`);
        }else {
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, location.href);
                window.onpopstate = function () {
                    window.history.pushState(null, null, location.href); 
                };
            }
        }
    });
    </script>

<script>
    const rowsPerPage = 5; 
    let currentPage = 1;
    let students = [];
    let filteredStudents = []; 

    function renderTablePage(page = 1) {
        const tbody = document.getElementById("studentTableBody");
        tbody.innerHTML = "";

        const dataToRender = filteredStudents.length > 0 || document.getElementById("searchInput").value
            ? filteredStudents
            : students;

        if (!Array.isArray(dataToRender) || dataToRender.length === 0) {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td colspan="7" class="text-center text-muted py-4">
                    No students found.
                </td>
            `;
            tbody.appendChild(tr);
            document.getElementById("paginationControls").innerHTML = "";
            document.getElementById("paginationInfo").textContent = "";
            return;
        }

        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedStudents = dataToRender.slice(start, end);

        paginatedStudents.forEach(student => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ⋮
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item text-primary btn-view" href="vieweditgenerateid.php?id=${student.id}">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-warning btn-edit" href="viewupdategenerateid.php?id=${student.id}">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger btn-delete" data-id="${student.id}" href="#">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td>${student.lastname}, ${student.firstname} ${student.middlename ?? ""}</td>
                <td>${student.barangay}, ${student.municipality}</td>
                <td>${student.age ?? "-"}</td>
                <td>${student.lrn ?? "-"}</td>
                <td>${student.emergency_contact ?? "-"}</td>
                <td>
                    ${student.image 
                        ? `<img src="${student.image}" alt="Student Photo" width="50" height="50" style="object-fit:cover; border-radius:50%;">`
                        : "-"
                    }
                </td>
            `;
            tbody.appendChild(tr);
        });

        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                const id = btn.getAttribute("data-id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "This record will be permanently deleted!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`https://hnvs-id-be.creativedevlabs.com/api/deletegenerate/${id}`, {
                            method: "DELETE",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": "Bearer " + localStorage.getItem("token")
                            }
                        })
                        .then(res => res.json())
                        .then(resp => {
                            Swal.fire("Deleted!", resp.message, "success");
                            students = students.filter(s => s.id != id);
                            filteredStudents = filteredStudents.filter(s => s.id != id);
                            renderTablePage(currentPage);
                        })
                        .catch(err => {
                            console.error(err);
                            Swal.fire("Error!", "Something went wrong.", "error");
                        });
                    }
                });
            });
        });

        renderPaginationControls(dataToRender);
        renderPaginationInfo(start, end, dataToRender.length);
    }

    function renderPaginationControls(dataArray) {
        const totalPages = Math.ceil(dataArray.length / rowsPerPage);
        const paginationDiv = document.getElementById("paginationControls");
        paginationDiv.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className = "page-btn " + (i === currentPage ? "active" : "");
            btn.addEventListener("click", () => {
                currentPage = i;
                renderTablePage(currentPage);
            });
            paginationDiv.appendChild(btn);
        }
    }

    function renderPaginationInfo(start, end, total) {
        const infoDiv = document.getElementById("paginationInfo");
        const showingStart = total === 0 ? 0 : start + 1;
        const showingEnd = Math.min(end, total);
        infoDiv.textContent = `Showing ${showingStart} to ${showingEnd} of ${total} students`;
    }
    fetch(`https://hnvs-id-be.creativedevlabs.com/api/showgeneratedids`, {
        headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + localStorage.getItem("token")
        }
    })
    .then(res => res.json())
    .then(data => {
        console.log("API Response:", data);
        students = Array.isArray(data) ? data : (data.data || []);
        renderTablePage(currentPage);
    })
    .catch(err => console.error(err));
    document.getElementById("searchInput").addEventListener("input", (e) => {
        const query = e.target.value.trim().toLowerCase();
        filteredStudents = students.filter(student => 
            student.firstname.toLowerCase().includes(query) ||
            (student.middlename && student.middlename.toLowerCase().includes(query)) ||
            student.lastname.toLowerCase().includes(query)
        );
        currentPage = 1;
        renderTablePage(currentPage);
    });
</script>
