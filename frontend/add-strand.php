
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Strand</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">Create</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Strand</div>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" style="display: none;">
                    <div class=" d-flex flex-column gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <div class=" text-secondary">Details</div>
                        <form action="" class="d-flex flex-column gap-5 mb-3">
                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="track" class="text-dark">Track</label>
                                    <select class="" name="track" id="track" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                        <option value="" class="text-secondary" selected disabled>Select track</option>
                                        <option value="0">Academic</option>
                                        <option value="1">TechPro (Technical Professional)</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="strandDescription" class="text-dark">Description <span class="text-secondary">(Optional)</span> </label>
                                    <input type="text" name="mName" id="strandDescription" style="width: 100%;" placeholder="">
                                </div>
                            </div>
                            <div class="align-items gap-5" id="techTrack">
                                <div class="input-group">
                                    <label for="techCluster" class="text-dark">Cluster</label>
                                    <select class="" name="techCluster" id="techCluster" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                        <option value="" class="text-secondary" selected disabled>Select Cluster</option>
                                        <option value="Industrial Arts (IA)">Industrial Arts (IA)</option>
                                        <option value="Family and Consumer Science (FCS)">Family and Consumer Science (FCS)</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="specialization" class="text-dark">Specialization</label>
                                    <input type="text" name="specialization" id="specialization" style="width: 100%;" placeholder="">
                                </div>
                            </div>

                            <div class="align-items gap-5" id="academicTrack">
                                <div class="input-group">
                                    <label for="academicName" class="text-dark">Cluster Name</label>
                                    <input type="text" name="academicName" id="academicName" style="width: 100%;" placeholder="">
                                </div>
                                <div style="width: 100%;"></div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex gap-3 align-items-center mt-4">
                        <button class="btn btn-primary fw-semibold d-flex align-items-center" id="addStrandBtn" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="createStrandLoader"></div>
                            Create
                        </button>
                        <button class="btn btn-primary d-flex align-items-center fw-semibold" id="createStrandAgain" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="createStrandAginLoader"></div>
                            Create & create another
                        </button>
                        <a href="strands.php" class="btn btn-secondary fw-semibold text-white">Cancel</a>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

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

        // dynamic form
        $(document).on('change', '#track', function() {
            const value = this.value;

            if(value == 0) {
                $('#techCluster').val('');
                $('#specailization').val('');
                $('#techTrack').slideUp(200);
                $('#academicTrack').slideDown(200).css('display', 'flex');
            }

            if(value == 1) {
                $('#academicName').val('');
                $('#academicTrack').slideUp(200);
                $('#techTrack').slideDown(200).css('display', 'flex');
            }
        });

        $('#addStrandBtn').on('click', function(e) {
            e.preventDefault();

            document.getElementById('createStrandLoader').style.display = 'block';
            fetch('http://hnvs_backend.test/api/create/strand', {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    academicClusterName: document.getElementById('academicName').value,
                    track: document.getElementById('track').value,
                    description: document.getElementById('strandDescription').value,
                    cluster: document.getElementById('techCluster').value,
                    specialization: document.getElementById('specialization').value
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
                        location.href = 'strands.php';
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
                document.getElementById('createStrandLoader').style.display = 'none';
            })

        })

        $('#createStrandAgain').on('click', function(e) {
            e.preventDefault();

            document.getElementById('createStrandAginLoader').style.display = 'block';
            fetch('http://hnvs_backend.test/api/create/strand', {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    academicClusterName: document.getElementById('academicName').value,
                    track: document.getElementById('track').value,
                    description: document.getElementById('strandDescription').value,
                    cluster: document.getElementById('techCluster').value,
                    specialization: document.getElementById('specialization').value
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
                        timer: 4000,
                    })
                }
            })
            .finally(() => {
                document.getElementById('createStrandAginLoader').style.display = 'none';
            })

        })

        
    </script>