
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
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">Edit</a></li>
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
                    <div class=" d-flex flex-column position-relative gap-4 bg-white p-4 shadow rounded-4 mt-4">
                        <!-- <div class="lineLoader position-absolute" id="lineLoader" style="top: 0; left: 0; width: 100%; display: none"></div> -->
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
                                            <option value="" selected>Select Doorway</option>    
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
                                        <!-- strand -->
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
                    
                    <div class="d-flex gap-3 align-items-center mt-4">
                        <button class="btn btn-primary fw-semibold d-flex align-items-center" id="editStudent" style="background-color: #3498db !important; border: none">
                            <div class="loader2 me-2" style="display: none;" id="saveStudentEditLoader"></div>
                            Save
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
        const APP_URL = "<?= APP_URL ?>"
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
                if(!navigator.onLine) {
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
                    'Accept': 'application/json',
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
                        option => option.textContent === strand?.cluster
                    );
                    
                    if(!exists) {
                        let strandOption = document.createElement('option');
                        strandOption.value = strand.id;
                        strandOption.textContent = strand?.cluster;
                        
                        strandSelect.appendChild(strandOption);
                    }
                })

                populateForm();
            })
        })


        // populate specialization
        function populateSpecialization() {
            return new Promise((resolve, reject) => {
                const selectedOption = this.options[this.selectedIndex];
                const selected = selectedOption ? selectedOption.textContent : '';
    
                
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
                            // if(specialization.cluster != selected) {
                            //     return;
                            // }
                            let specializationOption = document.createElement('option');
                            specializationOption.value = specialization.id;
                            specializationOption.textContent = specialization.specialization;
                            specializationSelect.appendChild(specializationOption);
                        });

                        resolve();
                    })
                    .catch(reject);
        
                }else {
                    $('#specializationCon').val('');
                    $('#specializationCon').slideUp(200).css('display', 'none');
                    resolve();
                }
            })
        }        

        // populate form
        function populateForm() {
            // document.getElementById('lineLoader').style.display = 'block';
            const url = new URLSearchParams(window.location.search);
            const id = url.get('id');
            const dropifyInput = $('#studentImg');
            const dropifySign = $('#signature')


            fetch(`${APP_URL}/api/find/student`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(res => res.json())
            .then(data => {
                function delay(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }

                async function loadSpecialization() {
                    try {
                        await delay(1000)
                        const student = data.student;
                        const strandSelect = document.getElementById('strand');
                        document.getElementById('fName').value = student.firstname;
                        document.getElementById('mName').value = student.middlename;
                        document.getElementById('lName').value = student.lastname;
                        document.getElementById('contact').value = student.contact;
                        document.getElementById('emergency').value = student.emergency_contact;
                        document.getElementById('birth').value = student.birthdate;
                        document.getElementById('age').value = student.age;
                        document.getElementById('level').value = student.year_level;
                        document.getElementById('section').value = student.section.id;
                        document.getElementById('lrn').value = student.lrn;
                        document.getElementById('brgy').value = student.barangay;
                        document.getElementById('municipal').value = student.municipality;
                        document.getElementById('doorway').value = student.doorway ?? '';
                        
                        if(student.suffix != null) {
                            document.getElementById('suffix').value = student.suffix;
                        }
                
                        if(student.strand) {
                            strandSelect.value = student.strand.cluster;
                            if(student.strand.specialization != null) {
                                await populateSpecialization.call(strandSelect);
            
                                let specializationSelect = document.getElementById('specializationCon');
                                specializationSelect.style.display = 'block';
                                document.getElementById('specialization').value = student.strand.id;
                            }
                        }
                        
                        document.getElementById('screenLoaderCon').style.display = 'none';
                        document.getElementById('content').style.display = 'block';

                        let image = '';
                        let signature = '';

                        if(student.image != null) {
                            image = student.image;
                        }else {
                            image = `${APP_URL}/images/default.jpg`;
                        }
                        
                        if(student.signature != null) {
                            signature = student.signature;
                        }else {
                            signature = `${APP_URL}/images/default-signature.jpg`;
                        }

                        dropifyInput.attr('data-default-file', image);
                        dropifySign.attr('data-default-file', signature);

                        const drEvent = dropifyInput.data('dropify');
                        if (drEvent) drEvent.destroy();
                        
                        const drSignature = dropifySign.data('dropify');
                        if (drSignature) drSignature.destroy();

                        dropifyInput.dropify({
                            messages: {
                                'default': 'Drag and drop a file here or click',
                                'replace': 'Drag and drop or click to replace',
                                'remove':  'Remove',
                                'error':   'Ooops, something wrong happened.'
                            }
                        });

                        dropifySign.dropify({
                            messages: {
                                'default': 'Drag and drop a file here or click',
                                'replace': 'Drag and drop or click to replace',
                                'remove':  'Remove',
                                'error':   'Ooops, something wrong happened.'
                            }
                        });
                    }catch (error) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            color: "#fff",
                            width: 350,
                            background:  "#cc0202",
                            toast: true,
                            title: 'Something went wrong while loading data. Please try again later.',
                            showConfirmButton: false,
                            timer: 5000,
                        })
                    } 
                }
                
                loadSpecialization(); 
            })
        }


        // on change strand
        $(document).on('change', '#strand', function() {
            populateSpecialization.call(this);
        })


        // edit student
        $(document).on('click', '#editStudent', function(e) {
            e.preventDefault();
            const url = new URLSearchParams(window.location.search);
            const id = url.get('id');

            document.getElementById('saveStudentEditLoader').style.display = 'block';
            const suffix = document.getElementById('suffix');
            const image = document.getElementById('studentImg').files[0];
            const signature = document.getElementById('signature').files[0];
            const strand = document.getElementById('strand');
            const doorway = document.getElementById('doorway');

            let formData = new FormData();
            formData.append('id', id);
            formData.append('firstname', document.getElementById('fName').value);
            formData.append('middlename', document.getElementById('mName').value);
            formData.append('lastname', document.getElementById('lName').value);
            formData.append('contact', document.getElementById('contact').value);
            formData.append('emergency_contact', document.getElementById('emergency').value);
            formData.append('birthdate', document.getElementById('birth').value);
            formData.append('age', document.getElementById('age').value);
            formData.append('year_level', document.getElementById('level').value);
            formData.append('section_id', document.getElementById('section').value);
            formData.append('lrn', document.getElementById('lrn').value);
            formData.append('barangay', document.getElementById('brgy').value);
            formData.append('municipality', document.getElementById('municipal').value);
            
            if(strand.value != null) {
                formData.append('strand', strand.value);
            }

            if(doorway.value != null) {
                formData.append('doorway', doorway.value);
            }
            
            if(specialization.value != null ) {
                formData.append('specialization', specialization.value);
            }

            if(image) {
                formData.append('image', image);
            }

            if(signature) {
                formData.append('signature', signature);
            }
            
            if(suffix.value != null) {
                formData.append('suffix', suffix.value);
            }
            
            fetch(`${APP_URL}/api/edit/student`, {
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
                        timer: 5000,
                    })
                }
            })
            .finally(() => {
                document.getElementById('saveStudentEditLoader').style.display = 'none';
            })
        })

    </script>