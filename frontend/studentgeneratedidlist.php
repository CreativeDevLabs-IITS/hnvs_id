<style>
    .table-container {
    position: relative;
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
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
                    <div class="table-container">
                        <div class="table-header">
                            <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Search student...">
                            <span class="search-icon">🔍</span>
                            </div>
                        </div>
                        <table id="taskTable" class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden mt-2">
                            <thead>
                            <tr>
                                <th scope="col">Fullname</th>
                                <th scope="col">Address</th>
                                <th scope="col">Age</th>
                                <th scope="col">LRN</th>
                                <th scope="col">Contact</th>
                            </tr>
                            </thead>
                        <tbody id="studentTableBody"></tbody>
                        </table>
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
        fetch("http://backend.test/api/showgeneratedids", {
        headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + localStorage.getItem("token")
        }
        })
        .then(res => res.json())
        .then(data => {
        const tbody = document.getElementById("studentTableBody");
        tbody.innerHTML = ""; 

        data.forEach(student => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
            <td>${student.lastname}, ${student.firstname} ${student.middlename ?? ""}</td>
            <td>${student.barangay}, ${student.municipality}</td>
            <td>${student.age}</td>
            <td>${student.lrn}</td>
            <td>${student.emergency_contact}</td>
            `;
            tbody.appendChild(tr);
        });
        })
        .catch(err => console.error(err));
    </script>