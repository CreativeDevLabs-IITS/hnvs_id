<?php include 'partials/_head.php' ?>

<div class="" style="background-color: #f1f1f1; width: 100%; min-height: 100vh; font-family: Poppins, sans-serif;">

    <div id="screenLoaderCon" style="height: 100vh; display: flex" class="flex-column gap-1 justify-content-center align-items-center">
        <svg id="screenLader" viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
        </svg>
        <div class="text-secondary">Loading...</div>
    </div>

    <div id="error_container" class="justify-content-around align-items-center px-5" style="height: 100vh; display: none">
        <div class="">
            <div class="fw-bold text-danger" style="font-size: 100px;">Oops!</div>
            <div id="pageNotFound" class="text-secondary fw-bold" style="font-size: 50px; margin-top: -30px; display: none">Page not found</div>
            <div id="expired" class="text-secondary fw-bold" style="font-size: 50px; margin-top: -30px; display: none">Expired Token</div>
            <div id="message" class="text-dark" style="font-size: 15px;"></div>
        </div>
        <img id="notFoundIcon" src="https://hnvs-id-be.creativedevlabs.com/assets/woman.png" style="width: 380px; display: none" alt="">
        <img id="ExpiredIcon" src="https://hnvs-id-be.creativedevlabs.com/assets/error.png" style="width: 350px; display: none" alt="">
    </div>

    <div id="no-internet" class="justify-content-center flex-column align-items-center" style="height: 100vh; display: none">
        <img src="https://hnvs-id-be.creativedevlabs.com/assets/no-connection.png" style="width: 10%;" alt="">
        <div class="text-secondary fs-6 text-danger">No internet connection</div>
        <div class="text-secondary" style="font-size: 13px;">Please check your network settings and try again. Some features may not work until you're back online.</div>
    </div>
    
    
    <div id="searchForm" style="display: none" class="justify-content-center py-5 position-relative">
        <div class="bg-white shadow p-4" style="border-radius: 10px; border: 1px solid #000080; z-index: 1; width: 60%">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="https://hnvs-id-be.creativedevlabs.com/assets/logo.png" style="width: 50px;" alt="">
                <div class="fw-bold" style="font-size: 10px;">HILONGOS NATIONAL VOCATIONAL SCHOOL</div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center mt-3">
                <div class="fw-bold" style="font-size: 24px;">Student Information Form</div>
            </div>
            <div class="d-flex align-items-center gap-3 flex-row-reverse">
                <div class="dropdown d-flex">
                    <div class="" data-bs-toggle="dropdown" aria-expanded="false" aria-expanded="false" role="button" >
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-filter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>                        
                    </div>
    
                    <ul class="dropdown-menu">
                        <li>
                            <a data-bs-toggle="modal" data-bs-target="" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="showLrnForm" style="font-size: 13px" href="#">
                                Learner Reference No. (LRN)
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="modal" data-bs-target="" class="dropdown-item text-dark d-flex gap-2 align-items-center" id="showNameForm" style="font-size: 13px" href="#">
                                Name
                            </a>
                        </li>
                    </ul>
                </div>

                <form action="" class="d-flex my-5" style="">
                    <div class="d-flex gap-5" style="min-width: 400px, max-width: 800px">
                        <input type="hidden" id="studentID">
                        <div class="input-group" id="lrnForm" style="width: 100%;">
                            <input type="text" name="lrn" id="lrn" placeholder="Learner Reference No. (LRN)">
                        </div>
                        <div class="input-group" id="fnameForm" style="display: none; width: 50%;">
                            <input type="text" name="fName" id="fName" placeholder="First Name">
                        </div>
                        <div class="input-group" id="lnameForm" style="display: none; width: 50%;">
                            <input type="text" name="lName" id="lName" placeholder="Last Name">
                        </div>
                    </div>
                </form>
            </div>
    
            <div class="gap-3mt-4" style="width: 100%;">
                <button class="btn btn-primary fw-semibold d-flex justify-content-center" id="search" style="background-color: #000080 !important; border: none; width: 100%; font-size: 13px; padding: 12px 0 12px 0">
                    <div class="loader2 me-2" style="display: none;" id="saveSetupLoader"></div>
                    Search
                </button>
            </div>
        </div>
    </div>

    <div id="content" style="display: none" class="justify-content-center py-5 position-relative">
        <!-- <div class="position-absolute" style="width: 100%; height: 150px; background-color: #000080; z-index: 0; top: 0"></div> -->
        <div class="bg-white shadow p-4" style="border-radius: 10px; border: 1px solid #000080; z-index: 1;">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="https://hnvs-id-be.creativedevlabs.com/assets/logo.png" style="width: 50px;" alt="">
                <div class="fw-bold" style="font-size: 10px;">HILONGOS NATIONAL VOCATIONAL SCHOOL</div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center mt-3">
                <div class="fw-bold" style="font-size: 24px;">Setup Your Account</div>
            </div>
            <form action="" class="d-flex gap-5 px-4 my-5">
                <div class="d-flex flex-column gap-3" style="width: 300px;">
                    <input type="hidden" id="teacherId">
                    <div class="input-group" >
                        <label for="fName" class="text-secondary">Firstname</label>
                        <input type="text" name="fName" id="fName" disabled style="width: 100%;" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="mName" class="text-secondary">Middlename</label>
                        <input type="text" name="mName" id="mName" disabled style="width: 100%;" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="lName" class="text-secondary">Lastname</label>
                        <input type="text" name="lName" id="lName" disabled style="width: 100%;" placeholder="">
                    </div>
                    <div class="input-group" id="suffixContainer">
                        <label for="suffix" class="text-secondary">Suffix</label>
                        <input type="text" id="suffix" style="width: 100%;" disabled placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="contact" class="text-secondary">Contact Number</label>
                        <input type="text" id="contact" style="width: 100%;" disabled placeholder="">
                    </div>
                </div>
    
                <div class="d-flex flex-column gap-3" style="width: 300px;">
                    <div class="input-group">
                        <label for="email" class="text-secondary">Email</label>
                        <input type="text" name="email" id="email" style="width: 100%;" disabled placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="password" class="text-secondary">Password</label>
                        <input type="password" name="password" id="password" style="width: 100%;" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="confirm_password" class="text-secondary">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" style="width: 100%;" placeholder="">
                    </div>
                </div>
            </form>
    
            <div class="gap-3mt-4" style="width: 100%;">
                <button class="btn btn-primary fw-semibold d-flex justify-content-center" id="saveSetup" style="background-color: #000080 !important; border: none; width: 100%; font-size: 13px; padding: 12px 0 12px 0">
                    <div class="loader2 me-2" style="display: none;" id="saveSetupLoader"></div>
                    Create
                </button>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/config.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    const APP_URL = "<?= APP_URL ?>"

    document.getElementById("showLrnForm").addEventListener("click", function (e) {
        e.preventDefault();
        
        document.getElementById('fnameForm').style.display = 'none';
        document.getElementById('lnameForm').style.display = 'none';
        document.getElementById('lrn').style.display = 'block';
    });

    document.getElementById("showNameForm").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById('lrn').style.display = 'none';
        document.getElementById('fnameForm').style.display = 'block';
        document.getElementById('lnameForm').style.display = 'block';
    });

    function populateForm() {
        return new Promise((resolve, reject) => {
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
    
            fetch(`${APP_URL}/api/setup`, {
                method: 'POST',
                headers: {
                    'Accept': 'Application/json',
                    'Content-Type': 'Application/json',
                },
                body: JSON.stringify({
                    token: token
                })
            })
            .then(res => res.json())
            .then(data => {
                if(data.invalid) {
                    document.getElementById('error_container').style.display = 'flex';
                    document.getElementById('pageNotFound').style.display = 'block';
                    document.getElementById('message').textContent = data.invalid;
                    document.getElementById('notFoundIcon').style.display = 'block';
                }
                else if(data.expired)
                {
                    document.getElementById('error_container').style.display = 'flex';
                    document.getElementById('expired').style.display = 'block';
                    document.getElementById('message').innerHTML = data.expired;
                    document.getElementById('ExpiredIcon').style.display = 'block';
                } else {
                    document.getElementById('content').style.display = 'flex';

                    document.getElementById('teacherId').value = data.data.id;
                    document.getElementById('fName').value = data.data.firstname;
                    document.getElementById('mName').value = data.data.middlename;
                    document.getElementById('lName').value = data.data.lastname;
                    if (data.data.suffix) {
                        document.getElementById('suffixContainer').style.display = 'block';
                        document.getElementById('suffix').value = data.data.suffix;
                    }
                    document.getElementById('contact').value = data.data.contact;
                    document.getElementById('email').value = data.data.email;        
                }

                resolve();
            })
            .catch(reject)
        })

    }

    window.addEventListener("load", function () {
        setTimeout(() => {
            if(!navigator.onLine) {
                document.getElementById('screenLoaderCon').style.display = 'none';
                document.getElementById('no-internet').style.display = 'flex'; 
            }else {
                setTimeout(() => {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('searchForm').style.display = 'flex';
                }, 300);
            }
        })
    });
    
    
    function delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function showContent() {
        await delay(1000);

        await populateForm();
        document.getElementById('screenLoaderCon').style.display = 'none';
    }


    $(document).on('click', '#saveSetup', function(e) {
        e.preventDefault();
        document.getElementById('saveSetupLoader').style.display = 'block';
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value

        if(password.length < 8) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                color: "#fff",
                width: 350,
                background:  "#cc0202",
                toast: true,
                title: 'Password length must be 8 or more character.',
                showConfirmButton: false,
                timer: 4000,
            });
            document.getElementById('saveSetupLoader').style.display = 'none';
            return;
        }

        if(password != confirmPassword) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                color: "#fff",
                width: 350,
                background:  "#cc0202",
                toast: true,
                title: 'Password and confirm password does not match.',
                showConfirmButton: false,
                timer: 4000,
            });
            document.getElementById('saveSetupLoader').style.display = 'none';
            return;

        }

        fetch(`${APP_URL}/api/save/setup`, {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                id: document.getElementById('teacherId').value,
                password: password
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
                    location.href = 'index.php';
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
    })


    
</script>
