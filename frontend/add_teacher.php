
<?php include 'partials/_head.php' ?>

    <div style="height: auto; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr;">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3 breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 14px;">Teachers</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="add_teacher.php" class="text-decoration-none text-dark">Create</a></li>
                    </ol>
                </nav>
                <div class="">
                    <div class="fs-4 mt-2">Add Teachers</div>
                </div>

                <div id="screenLoaderCon" style="height: 80%; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
                    <svg id="screenLader" viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                    <div class="text-secondary">Loading...</div>
                </div>

                <div id="content" style="display: none;">
                    <div class=" d-flex flex-column gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <div class=" text-secondary">Basic Info</div>
                        <form action="" class="d-flex flex-column gap-4">
                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="fName" class="text-dark">Firstname</label>
                                    <input type="text" name="fName" id="fName" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="mName" class="text-dark">Middlename</label>
                                    <input type="text" name="mName" id="mName" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="lName" class="text-dark">Lastname</label>
                                    <input type="text" name="lName" id="lName" style="width: 100%;" placeholder="">
                                </div>
                            </div>
    
                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="suffix" class="text-dark">Suffix</label>
                                    <input type="text" id="suffix" style="width: 100%;" placeholder="">
                                </div>
                                <!-- <div class="input-group">
                                    <label for="teacher_role" class="text-dark">Role</label>
                                    <select class="" name="teacher_role" id="teacher_role" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                        <option value="" class="text-secondary" selected disabled>Select role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Regular Teacher</option>
                                    </select>
                                </div> -->
                                <div style="width: 100%;"></div>
                                <div style="width: 100%;"></div>
                            </div>
                        </form>
                    </div>
    
                    <div class=" d-flex flex-column gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <div class=" text-secondary">Credentials & Contact</div>
                        <form action="" class="d-flex flex-column gap-4">
                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="contact" class="text-dark">Contact Number</label>
                                    <input type="text" id="contact" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="email" class="text-dark">Email</label>
                                    <input type="text" name="email" id="email" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="password" class="text-dark">Password</label>
                                    <input type="password" name="password" id="password" style="width: 100%;" placeholder="">
                                </div>
                            </div>
                        </form>
                    </div>
    
                    <div class=" d-flex flex-column gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <div class=" text-secondary">Image</div>
                        <input type="file" id="profile" class="dropify" data-default-file="https://hnvs-id-be.creativedevlabs.com/assets/default.jpg">
                    </div>
                    <div class="d-flex gap-3 align-items-center mt-4">
                        <button class="btn btn-primary fw-semibold d-flex align-items-center" id="addTeacher" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="createLoader"></div>
                            Create
                        </button>
                        <button class="btn btn-primary d-flex align-items-center fw-semibold" id="createAgain" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="createAginLoader"></div>
                            Create & create another
                        </button>
                        <a href="teachers.php" class="btn btn-secondary fw-semibold text-white">Cancel</a>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://hnvs-id-be.creativedevlabs.com/dist/js/dropify.min.js"></script>

    <?php include 'partials/_logout.php' ?>
    <?php include 'partials/config.php' ?>

    <script>
        const APP_URL = "<?= APP_URL  ?>"
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

        // dropify
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


        // add teacher
        $(document).on('click', '#addTeacher', function(e) {
            e.preventDefault();

            document.getElementById('createLoader').style.display = 'block';
            const suffix = document.getElementById('suffix');
            const image = document.getElementById('profile').files[0];

            let formData = new FormData();
            formData.append('firstname', document.getElementById('fName').value);
            formData.append('middlename', document.getElementById('mName').value);
            formData.append('lastname', document.getElementById('lName').value);
            formData.append('contact', document.getElementById('contact').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            // formData.append('role', document.getElementById('teacher_role').value);
            
            if(suffix.value != null) {
                formData.append('suffix', suffix.value);
            }
            
            if(image) {
                formData.append('image', image);
            }

            fetch(`${APP_URL}/api/create/teacher`, {
                method: 'POST',
                headers: {
                    'Accept': 'Applicatin/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: formData,
                processData: false,
                contentType: false,
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
                        timer: 1000,
                    })
                    .then (() => {
                        location.href = 'teachers.php';
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
                        timer: 5000,
                    })
                }
            })
            .finally(() => {
                document.getElementById('createLoader').style.display = 'none';
            })

        })

        // create and create again
        $(document).on('click', '#createAgain', function(e) {
            e.preventDefault();

            document.getElementById('createAginLoader').style.display = 'block';
            const suffix = document.getElementById('suffix');
            const image = document.getElementById('profile').files[0];

            let formData = new FormData();
            formData.append('firstname', document.getElementById('fName').value);
            formData.append('middlename', document.getElementById('mName').value);
            formData.append('lastname', document.getElementById('lName').value);
            formData.append('contact', document.getElementById('contact').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            
            if(suffix.value != null) {
                formData.append('suffix', suffix.value);
            }
            
            if(image) {
                formData.append('image', image);
            }

            fetch(`${APP_URL}/api/create/teacher`, {
                method: 'POST',
                headers: {
                    'Accept': 'Applicatin/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: formData,
                processData: false,
                contentType: false,
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
                        timer: 3000,
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
                document.getElementById('createAginLoader').style.display = 'none';
            })

        })

    </script>

<?php include 'partials/_footer.php' ?>
