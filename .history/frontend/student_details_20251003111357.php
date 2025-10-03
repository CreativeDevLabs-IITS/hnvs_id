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

    <div id="content" style="display: none" class="justify-content-center py-5 position-relative px-3">
        <div class="bg-white shadow py-2" style="border-radius: 10px; border: 1px solid #000080; z-index: 1; width: 800px;">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="https://hnvs-id-be.creativedevlabs.com/assets/logo.png" style="width: 50px;" alt="">
                <div class="fw-bold" style="font-size: 10px;">HILONGOS NATIONAL VOCATIONAL SCHOOL</div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center mt-3">
                <div class="fw-bold" style="font-size: 18px;">Student Information Form</div>
            </div>

            <div id="contentSpinner" style="height: 50px; display: none" class="flex-column gap-1 justify-content-center align-items-center">
                <svg viewBox="25 25 50 50">
                    <circle r="20" cy="50" cx="50"></circle>
                </svg>
                <div class="text-secondary">Loading...</div>
            </div>

            <div class="flex-column align-items-center p-3 gap-3 mt-5" id="filterSelection" style="display: flex; justify-content: center">
                <button class="btn btn-primary fw-semibold d-flex justify-content-center" id="searchLRN" style="background-color: #000080 !important; border: none; width: 100%; font-size: 13px; padding: 12px 0 12px 0">
                    Search by LRN
                </button>
                <button class="btn btn-primary fw-semibold d-flex justify-content-center" id="searchName" style="background-color: #000080 !important; border: none; width: 100%; font-size: 13px; padding: 12px 0 12px 0">
                    Search by Fullname
                </button>
            </div>

            <div id="formContainer" class="flex-column px-3 my-5" style="display: none; justify-content: center">
                <div class="text-danger align-self-center mx-3" id="fetchError"></div>
                <form action="" class="gap-5 px-2" id="lrnFormCon" style="display: none; justify-content: center">
                    <div class="d-flex flex-column gap-3" style="width: 100%;">
                        <div class="input-group" >
                            <label for="lrnInput" class="text-secondary" style="font-size: 14px">Learner Reference No. (LRN)</label>
                            <input type="text" name="lrnInput" id="lrnInput" style="width: 100%;" placeholder="">
                        </div>
                    </div>
                </form>

                <form action="" class="gap-5 px-2 my-5" id="nameFormCon" style="display: none; justify-content: center">
                    <div class="d-flex flex-column gap-3" style="width: 100%;">
                        <input type="hidden" id="teacherId">
                        <div class="input-group" >
                            <label for="fnameInput" class="text-secondary" style="font-size: 14px">First Name</label>
                            <input type="text" name="fnameInput" id="fnameInput" style="width: 100%;" placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="lnameInput" class="text-secondary" style="font-size: 14px">Last Name</label>
                            <input type="text" name="lnameInput" id="lnameInput" style="width: 100%;" placeholder="">
                        </div>
                    </div>
                </form>
                <div class="gap-3 mt-4" style="width: 100%">
                    <button onclick="searchStudent()" class="btn btn-primary fw-semibold d-flex justify-content-center" id="search" style="background-color: #000080 !important; border: none; width: 100%; font-size: 13px; padding: 12px 0 12px 0">
                        <div class="loader2 me-2" style="display: none;" id="searchSpinner"></div>
                        Search
                    </button>
                </div>
            </div>

            <div id="infoFormCon" style="display: none; justify-content: center; width: 100%;" class="mt-4 flex-column px-3">
                <form action="" style=" width: 100%;">
                    <div class="d-flex flex-column gap-3" >
                        <input type="hidden" id="studentID">
                        <div class="input-group" >
                            <label for="fName" class="text-secondary" style="font-size: 14px">First Name</label>
                            <input type="text" name="fName" id="fName" disabled style="width: 100%; font-size: 15px;" placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="mName" class="text-secondary" style="font-size: 14px">Middle Name</label>
                            <input type="text" name="mName" id="mName" disabled style="width: 100%; font-size: 15px" placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="lName" class="text-secondary" style="font-size: 14px">Last Name</label>
                            <input type="text" name="lName" id="lName" disabled style="width: 100%; font-size: 15px" placeholder="">
                        </div>
                        <div class="input-group" id="suffixContainer">
                            <label for="suffix" class="text-secondary" style="font-size: 14px">Suffix</label>
                            <input type="text" id="suffix" style="width: 100%; font-size: 15px" disabled placeholder="">
                        </div>
                        <div class="input-group" id="suffixContainer">
                            <label for="section" class="text-secondary" style="font-size: 14px">Section</label>
                            <input type="text" id="section" style="width: 100%; font-size: 15px" disabled placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="barangay" class="text-secondary" style="font-size: 14px">Barangay</label>
                            <input type="text" name="barangay" id="barangay" style="width: 100%; font-size: 15px" placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="town" class="text-secondary" style="font-size: 14px">Town</label>
                            <input type="text" name="town" id="town" style="width: 100%; font-size: 15px" placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="address" class="text-secondary" style="font-size: 14px">Emergency Contact Person</label>
                            <input type="text" name="address" id="address" style="width: 100%; font-size: 15px" placeholder="">
                        </div>
                        <div class="input-group">
                            <label for="contact" class="text-secondary" style="font-size: 14px">Emergency Contact Number</label>
                            <input type="text" id="contact" style="width: 100%; font-size: 15px" placeholder="">
                        </div>
                        <div class="d-flex flex-column">
                            <label for="" class="text-secondary" style="font-size: 14px">Strand</label>
                            <div class="gap-4" id="strands">
                                <!-- strands -->
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <label for="" class="text-secondary" style="font-size: 14px">Doorway</label>
                            <div class="gap-4" id="doorway">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="STEM">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios1">
                                       STEM
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="B & E">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios2">
                                        B & E
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="ASSH">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios3">
                                        ASSH
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="SHW">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios4">
                                        SHW
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="(IA) Driving NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios5">
                                        (IA) Driving NC II
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="(IA) Automotive Servicing NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios6">
                                        (IA) Automotive Servicing NC II
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios7" value="(IA) Manual Metal Arc Welding (MMAW) NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios7">
                                        (IA) Manual Metal Arc Welding (MMAW) NC II
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios8" value="(FCS) Kitchen Operations NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios8">
                                        (FCS) Kitchen Operations NC II
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios9" value="(FCS) Bakery Operations NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios9">
                                        (FCS) Bakery Operations NC II
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios10" value="(FCS) Food and Beverage Operation NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios10">
                                        (FCS) Food and Beverage Operation NC II
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios11" value="(FCS) Garment Artisanry NC II">
                                    <label class="form-check-label" style="font-size: 15px" for="exampleRadios11">
                                        (FCS) Garment Artisanry NC II
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="gap-3 mt-4" style="width: 100%">
                    <button class="btn btn-primary fw-semibold d-flex justify-content-center" id="saveInfoBtn" style="background-color: #000080 !important; border: none; width: 100%; font-size: 13px; padding: 12px 0 12px 0">
                        <div class="loader2 me-2" style="display: none;" id="saveInfoSpinner"></div>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/config.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    const APP_URL = "<?= APP_URL ?>"


    function searchStudent() {
        return new Promise((resolve, reject) => {
            let payload = {};

            document.getElementById('searchSpinner').style.display = 'flex';
            const lrn = document.getElementById('lrnInput')?.value.trim();
            const fname = document.getElementById('fnameInput')?.value.trim();
            const lname = document.getElementById('lnameInput')?.value.trim();

            if (lrn) {
                payload.lrn = lrn;
            } else if (fname || lname) {
                payload.firstname = fname;
                payload.lastname = lname;
            } else {
                document.getElementById('fetchError').innerText = "No input provided for search.";
                document.getElementById('searchSpinner').style.display = 'none';
                return resolve();
            }

            fetch(`${APP_URL}/api/find-student`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(response => {
                if(!response.error) {
                    console.log(response);
                    const strandsCon = document.getElementById('strands');
                    document.getElementById('filterSelection').style.display = 'none';
                    document.getElementById('formContainer').style.display = 'none';
                    document.getElementById('contentSpinner').style.display = 'flex';
                    document.getElementById('infoFormCon').style.display = 'flex';

                    setTimeout(() => {    
                        document.getElementById('contentSpinner').style.display = 'none';
                        setTimeout(() => {
                            document.getElementById('studentID').value = response.data.id ?? '';
                            document.getElementById('fName').value = response.data.firstname ?? '';
                            document.getElementById('mName').value = response.data.middlename ?? '';
                            document.getElementById('lName').value = response.data.lastname ?? '';
                            
                            if (response.data.suffix) {
                                document.getElementById('suffix').value = response.data.suffix;
                            } else {
                                document.getElementById('suffix').value = 'N/A';
                            }
        
                            document.getElementById('section').value = response.data.section.name ?? '';
                            document.getElementById('barangay').value = response.data.barangay ?? '';
                            document.getElementById('town').value = response.data.municipality ?? '';
                            document.getElementById('address').value = response.data.emergency_contactt ?? '';
                            document.getElementById('contact').value = response.data.contact ?? '';

                            response.strands.forEach((strand) => {
                                const wrapper = document.createElement('div');
                                wrapper.classList.add("form-check");

                                wrapper.innerHTML = `
                                    <input class="form-check-input" type="radio" name="studentStrand" id="radio${strand.id}" value="${strand.id}">
                                    <label class="form-check-label" style="font-size: 15px" for="radio${strand.id}">
                                        ${strand.specialization ?? strand.cluster}
                                    </label>
                                `;

                                strandsCon.appendChild(wrapper);
                            })

                        }, 300);
                    }, 400);


                }
                document.getElementById('fetchError').innerText = response.error;
                resolve();
            })
            .finally(() => {
                document.getElementById('searchSpinner').style.display = 'none';
            })
            .catch(reject);
        });
    }

    window.addEventListener("load", function () {
        setTimeout(() => {
            if(!navigator.onLine) {
                document.getElementById('screenLoaderCon').style.display = 'none';
                document.getElementById('no-internet').style.display = 'flex'; 
            }else {
                setTimeout(() => {
                    document.getElementById('screenLoaderCon').style.display = 'none';
                    document.getElementById('content').style.display = 'flex';
                }, 300);
            }
        })
    });

    function toggleForm(formToShow) {
        document.getElementById('lrnFormCon').style.display = 'none';
        document.getElementById('nameFormCon').style.display = 'none';
        document.getElementById('formContainer').style.display = 'flex';
        document.getElementById(formToShow).style.display = 'flex';
    }

    document.getElementById("searchLRN").addEventListener("click", function (e) {
        e.preventDefault(); 
        toggleForm('lrnFormCon')

    });

    document.getElementById("searchName").addEventListener("click", function (e) {
        e.preventDefault();
        toggleForm('nameFormCon');
    });
    

    $(document).on('click', '#saveInfoBtn', function(e) {
        e.preventDefault();
        document.getElementById('saveInfoSpinner').style.display = 'block';

        let studentData = {
            studentID: document.getElementById('studentID').value,
            barangay: document.getElementById('barangay').value,
            town: document.getElementById('town').value,
            address: document.getElementById('address').value,
            contact: document.getElementById('contact').value,
            doorway: document.querySelector('input[name="exampleRadios"]:checked')?.value
        };



        fetch(`${APP_URL}/api/save/student-info`, {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify(studentData)
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
        .finally(() => {
            document.getElementById('saveInfoSpinner').style.display = 'none';
        })
    })


    
</script>
