
<?php include 'partials/_head.php' ?>
    <?php include 'partials/config.php' ?>
    <div style="height: auto; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3 breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 14px;">Dashboard</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">General Settings</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">General Settings</div>
                </div>
                <div class="mt-4">
                    <div class="container mt-4">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active d-flex align-items-center" id="tab1-tab" data-bs-toggle="tab" onclick="displayContent('tab1')" data-bs-target="#tab1"
                                    type="button" role="tab" aria-controls="tab1" aria-selected="true">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                                General Settings
                            </button>
                        </li>
                        <li class="nav-item" id="strandBtn" style="display: none;" role="presentation">
                            <button class="nav-link d-flex align-items-center" id="tab2-tab" data-bs-toggle="tab" onclick="displayContent('tab2')" data-bs-target="#tab2"
                                    type="button" role="tab" aria-controls="tab2" aria-selected="false">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-library"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" /><path d="M11 7h5" /><path d="M11 10h6" /><path d="M11 13h3" /></svg>
                                Strands
                            </button>
                        </li>
                        <li class="nav-item" id="sectionsBtn" style="display: none;" role="presentation">
                            <button class="nav-link d-flex align-items-center" id="tab3-tab" onclick="displayContent('tab3')" data-bs-toggle="tab" data-bs-target="#tab3"
                                    type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                                Sections
                            </button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content shadow" id="myTabContent">
                        <!-- page loader -->
                        <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                            <svg id="screenLader" viewBox="25 25 50 50">
                                <circle r="20" cy="50" cx="50"></circle>
                            </svg>
                            <div class="text-secondary">Loading...</div>
                        </div>
                        
                        <!-- no internet -->
                        <div id="no-internet" class="justify-content-center flex-column align-items-center" style="height: 80%; display: none">
                            <img src="https://hnvs-id-be.creativedevlabs.com/assets/no-connection.png" style="width: 10%;" alt="">
                            <div class="text-secondary fs-6 text-danger">No internet connection</div>
                            <div class="text-secondary" style="font-size: 13px;">Please check your network settings and try again. Some features may not work until you're back online.</div>
                        </div>

                        <!-- content -->
                        <div style="display: none;" class="tab-pane fade show active p-4 border border-top-0" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <div class="text-dark"></div>
                        </div>

                        <!-- strand tabs -->
                        <div style="display: none;" class="tab-pane fade p-4 border border-top-0" id="tab2" role="tabpanel" >
                            <div id="strandTable">
                                <?php include 'partials/strand/_strands.php' ?>
                            </div>
                            <div id="editStrandTab" style="display: none">
                                <?php include 'partials/strand/_edit-strand.php' ?>
                            </div>
                            <div id="addStrandTab" style="display: none">
                                <?php include 'partials/strand/_add-strand.php' ?>
                            </div>
                        </div>

                        <!-- sections tabs -->
                        <div class="tab-pane text-dark fade p-4 border border-top-0" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                            <div id="sectionTable">
                                <?php include 'partials/section/_sections.php' ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <?php include 'partials/_logout.php' ?>

    <script>
        const APP_URl = "<?= APP_URL ?>"
        const FRONTEND_URL = "<?= FRONTEND_URL ?>"

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
            document.getElementById('no-internet').style.display = 'none'; 

            const role = localStorage.getItem('role');
            if(role != 2) {
                document.getElementById('strandBtn').style.display = 'block';
                document.getElementById('sectionsBtn').style.display = 'block';
            }
            
            setTimeout(() => {
                if(navigator.onLine) {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('tab1').style.display = 'block';
                }else {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('no-internet').style.display = 'flex'; 
                }
            }, 800)

        });   

        function displayContent(id) {
            const panes = document.querySelectorAll('.tab-pane');
            document.getElementById('no-internet').style.display = 'none'; 
            document.getElementById('screenLoaderCon').style.display = 'flex';

            panes.forEach(pane => {
                pane.style.display = 'none';
            })

            setTimeout(() => {
                if(navigator.onLine) {
                    panes.forEach(pane => {
                        pane.style.display = 'none';
                    })
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById(id).style.display = 'block';
                }else {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('no-internet').style.display = 'flex'; 
                }
            }, 800)
        }

        function fadeAnimation(e) {
            document.getElementById('no-internet').style.display = 'none'; 
            document.getElementById('screenLoaderCon').style.display = 'flex';

            setTimeout(() => {
                if(navigator.onLine) {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    e.classList.remove('fade', 'show');
                    e.classList.add('fade');
                    e.style.display = 'block';
                    setTimeout(() => e.classList.add('show'), 100);
                }else {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('no-internet').style.display = 'flex'; 
                }
            }, 800)

        }

        // show th edit container
        function showEditTab(button) {
            const id = $(button).data('id');
            document.getElementById('strandTable').style.display = 'none';
            const pane = document.getElementById('editStrandTab');
            let idContainer = document.getElementById('strandId');
            idContainer.value = id;

            fetchAndPopulateTable();
            fadeAnimation(pane);
        }

        function changePane(pane, id) {
            document.getElementById(pane).style.display = 'none'
            fadeAnimation(document.getElementById(id));
        }

        function closeEditPane(add, remove) {
            document.getElementById(remove).classList.remove('show');
            setTimeout(() => {
                document.getElementById(remove).style.display = 'none';
                fadeAnimation(document.getElementById(add));
            }, 200);
        }



    </script>
