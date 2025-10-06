
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
                        <li class="breadcrumb-item" style="font-size: 14px;">Students</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">Create</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Students</div>
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
                            <div class="d-flex align-items gap-5 mb-3">
                                <div class="input-group">
                                    <label for="lrn" class="text-dark">Student Learner Number <span class="text-secondary">(LRN)</span></label>
                                    <input type="text" id="lrn" style="width: 100%;" placeholder="">
                                </div>
                                <div style="width: 100%;"></div>
                                <div style="width: 100%;"></div>
                            </div>
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
                                <div class="input-group">
                                    <label for="birth" class="text-dark">Birthdate</label>
                                    <input type="date" id="birth" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="age" class="text-dark">Age</label>
                                    <input type="text" id="age" style="width: 100%;" placeholder="">
                                </div>
                            </div>

                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="level" class="text-dark">Year Level</label>
                                    <select class="" name="level" id="level" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                        <option value="" class="text-secondary" selected disabled>Select level</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="section" class="text-dark">Section</label>
                                    <select class="" name="section" id="section" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                        <!-- section -->
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-column align-items gap-5 my-3">
                                <div class="d-flex align-items gap-5">
                                    <div class="input-group">
                                        <label for="strand" class="text-dark">Strand</label>
                                        <select class="" name="strand" id="strand" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                            <!-- strand -->
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="strand" class="text-dark">Doorway</label>
                                        <select class="" name="doorway" id="doorway" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                            <option value="" disabled selected>Select Doorway</option>    
                                            <option value="STEM">STEM</option>
                                            <option value="B & E">B & E</option>
                                            <option value="ASSH">ASSH</option>
                                            <option value="SHW">SHW</option>
                                            <option value="(IA) Driving NC II">(IA) Driving NC II</option>
                                            <option value="(IA) Automotive Servicing NC I">(IA) Automotive Servicing NC I</option>
                                            <option value="(IA) Manual Metal Arc Welding (MMAW) NC II">(IA) Manual Metal Arc Welding (MMAW) NC II</option>
                                            <option value="(FCS) Kitchen Operations NC II">(FCS) Kitchen Operations NC II</option>
                                            <option value="(FCS) Bakery Operations NC II">(FCS) Bakery Operations NC II</option>
                                            <option value="(FCS) Food and Beverage Operation NC II">(FCS) Food and Beverage Operation NC II</option>
                                            <option value="(FCS) Garment Artisanry NC II">(FCS) Garment Artisanry NC II</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group" id="specializationCon" style="display: none;">
                                    <label for="specialization" class="text-dark">Specialization</label>
                                    <select class="" name="specialization" id="specialization" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                                        <!-- specialization -->
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
    
                    <div class=" d-flex flex-column gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <div class=" text-secondary">Address & Contact</div>
                        <form action="" class="d-flex flex-column gap-4">
                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="brgy" class="text-dark">Barangay</label>
                                    <input type="text" id="brgy" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="municipal" class="text-dark">Municipality</label>
                                    <input type="text" id="municipal" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="contact" class="text-dark">Contact</label>
                                    <input type="text" id="contact" style="width: 100%;" placeholder="">
                                </div>
                            </div>

                            <div class="d-flex align-items gap-5">
                                <div class="input-group">
                                    <label for="emergency" class="text-dark">Emergency Contact</label>
                                    <input type="text" id="emergency" style="width: 100%;" placeholder="">
                                </div>  
                                <div style="width: 100%;"></div>
                                <div style="width: 100%;"></div>
                            </div>
                        </form>
                    </div>
    
                    <div class=" d-flex flex-column gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <div class=" text-secondary">Media</div>
                        <div class="d-flex gap-5">
                            <div class="input-group">
                                <label for="signature" class="text-dark">Student signature</label>
                                <input type="file" id="signature" class="dropify" data-default-file="https://hnvs-id-be.creativedevlabs.com/assets/default-signature.png">
                            </div>
                            <div class="input-group">
                                <label for="studentImg" class="text-dark">Student image</label>
                                <input type="file" id="studentImg" class="dropify" data-default-file="https://hnvs-id-be.creativedevlabs.com/assets/default.jpg">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3 align-items-center mt-4 mb-3">
                        <button class="btn btn-primary fw-semibold d-flex align-items-center" id="addStudentBtn" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="createStudentLoader"></div>
                            Create
                        </button>
                        <button class="btn btn-primary d-flex align-items-center fw-semibold" id="createStudentAgain" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="createStudentAginLoader"></div>
                            Create & create another
                        </button>
                        <a href="students.php" class="btn btn-secondary fw-semibold text-white">Cancel</a>
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
        const FRONTEND_URL = "<?= FRONTEND_URL ?>"
        const APP_URL = "<?= APP_URL  ?>"
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
        });

        // populate dropdown
        $(document).ready(function() {
            fetch(`${APP_URL}/api/section/strand/list`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                const sectionSelect = document.getElementById('section');
                const strandSelect = document.getElementById('strand');
                sectionSelect.innerHTML = '';
                strandSelect.innerHTML = '';
                let sections = data.sections;
                let strands = data.strands;

                let defaultSectionOption = document.createElement('option');
                defaultSectionOption.value = '';
                defaultSectionOption.textContent = 'Select section';
                defaultSectionOption.selected = true;
                defaultSectionOption.disabled = true;
                sectionSelect.appendChild(defaultSectionOption);
                
                sections.forEach(section => {
                    let sectionOption = document.createElement('option');
                    sectionOption.value = section.id;
                    sectionOption.textContent = section.name;

                    sectionSelect.appendChild(sectionOption);
                });

                let defaultStrandOPtion = document.createElement('option');
                defaultStrandOPtion.value = '';
                defaultStrandOPtion.textContent = 'Select Strand';
                defaultStrandOPtion.selected = true;
                defaultStrandOPtion.disabled = true;
                strandSelect.appendChild(defaultStrandOPtion);

                
                strands.forEach(strand => {
                    let exists = Array.from(strandSelect.options).some(
                        option => option.textContent === strand.cluster
                    );
                    
                    if(!exists) {
                        let strandOption = document.createElement('option');
                        strandOption.value = strand.id;
                        strandOption.textContent = strand.cluster;
                        
                        strandSelect.appendChild(strandOption);
                    }
                })

            })
        })

        // show specialization
        $(document).on('change', '#strand', function() {
            const selected = this.options[this.selectedIndex].textContent;

            if(selected == 'Industrial Arts (IA)' || selected == 'Family and Consumer Science (FCS)') {
                $('#specializationCon').slideDown(200).css('display', 'block');

                fetch(`${APP_URL}/api/section/strand/list`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'Application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const specializationSelect = document.getElementById('specialization');
                    specializationSelect.innerHTML = '';

                    let defaultSpecializationOption = document.createElement('option');
                    defaultSpecializationOption.value = '';
                    defaultSpecializationOption.textContent = 'Select specialization';
                    defaultSpecializationOption.selected = true;
                    defaultSpecializationOption.disabled = true;
                    specializationSelect.appendChild(defaultSpecializationOption);

                    let specializations = data.strands;
                    specializations.forEach(specialization => {
                        if(specialization.specialization == null) {
                            return;
                        }
                        if(specialization.cluster != selected) {
                            return;
                        }
                        let specializationOption = document.createElement('option');
                        specializationOption.value = specialization.id;
                        specializationOption.textContent = specialization.specialization;
                        specializationSelect.appendChild(specializationOption);
                    })
                })


            }else {
                $('#specializationCon').val('');
                $('#specializationCon').slideUp(200).css('display', 'none');
            }
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


        // add student
        $(document).on('click', '#addStudentBtn', function(e) {
            e.preventDefault();

            document.getElementById('createStudentLoader').style.display = 'block';
            const suffix = document.getElementById('suffix');
            const specialization = document.getElementById('specialization');
            const image = document.getElementById('studentImg').files[0];
            const doorway = document.getElementById('doorway');

            let formData = new FormData();
            formData.append('firstname', document.getElementById('fName').value);
            formData.append('middlename', document.getElementById('mName').value);
            formData.append('lastname', document.getElementById('lName').value);
            formData.append('contact', document.getElementById('contact').value);
            formData.append('emergency_contact', document.getElementById('emergency').value);
            formData.append('birthdate', document.getElementById('birth').value);
            formData.append('age', document.getElementById('age').value);
            formData.append('year_level', document.getElementById('level').value);
            formData.append('section_id', document.getElementById('section').value);
            formData.append('strand', document.getElementById('strand').value);
            formData.append('lrn', document.getElementById('lrn').value);
            formData.append('barangay', document.getElementById('brgy').value);
            formData.append('municipality', document.getElementById('municipal').value);
            formData.append('signature', document.getElementById('signature').files[0]);

            
            if(suffix.value != null) {
                formData.append('suffix', suffix.value);
            }

            if(doorway.value != null) {
                formData.append('doorway', doorway.value);
            }

            if(image) {
                formData.append('image', image);
            }

            if(specialization.value != null ) {
                formData.append('specialization', specialization.value);
            }
            

            fetch(`${APP_URL}/api/student/create`, {
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
                        timer: 2000,
                    })
                    .then (() => {
                        location.href = 'students.php';
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
                document.getElementById('createStudentLoader').style.display = 'none';
            })

        })

        // add student and add again
        $(document).on('click', '#createStudentAgain', function(e) {
            e.preventDefault();

            document.getElementById('createStudentAginLoader').style.display = 'block';
            const suffix = document.getElementById('suffix');

            let formData = new FormData();
            formData.append('firstname', document.getElementById('fName').value);
            formData.append('middlename', document.getElementById('mName').value);
            formData.append('lastname', document.getElementById('lName').value);
            formData.append('contact', document.getElementById('contact').value);
            formData.append('emergency_contact', document.getElementById('emergency').value);
            formData.append('birthdate', document.getElementById('birth').value);
            formData.append('age', document.getElementById('age').value);
            formData.append('student_id', document.getElementById('studentID').value);
            formData.append('lrn', document.getElementById('lrn').value);
            formData.append('barangay', document.getElementById('brgy').value);
            formData.append('municipality', document.getElementById('municipal').value);
            formData.append('image', document.getElementById('studentImg').files[0]);
            formData.append('signature', document.getElementById('signature').files[0]);

            
            if(suffix.value != null) {
                formData.append('suffix', suffix.value);
            }
            

            fetch(`${APP_URL}/api/student/create/`, {
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
                document.getElementById('createStudentAginLoader').style.display = 'none';
            })

        })

        
    </script>
