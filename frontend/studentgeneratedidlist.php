<style>
    #taskTable {
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 12px;
    }
    #taskTable thead th {
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    padding: 14px 16px;
    }
    #taskTable tbody td {
    padding: 12px 16px;
    vertical-align: middle;
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
                <table id="taskTable" class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden mt-2">
                <thead class="bg-primary text-white">
                    <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>1</td>
                    <td>Juan Dela Cruz</td>
                    <td>Male</td>
                    <td>Cebu City</td>
                    <td>09123456789</td>
                    </tr>
                </tbody>
                </table>
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