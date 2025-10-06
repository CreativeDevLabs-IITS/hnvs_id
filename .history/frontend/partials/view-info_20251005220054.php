<!-- <style>
    @media print {
    .no_print {
        display: none !important;
    }
} -->

</style>

<div class="offcanvas offcanvas-end d-flex flex-column justify-content-center px-3" style="width: 1050px; background-color: #f1f1f1; font-family: Poppins, sans-serif;" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close no_print" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    <div class="top-con px-3 mt-3 pb-3">
        <div class="d-flex justify-content-center fs-6 fw-bold rounded shadow p-3 text-white" style="background-color: #3498db; width: 100%">STUDENT INFORMATION</div>                
        <div class="d-flex gap-4 mt-5" style="width: 100%; height: 100%">
            <div class="d-flex flex-column gap-4 align-items-center" style="width: 100%">
                <div class=" d-flex flex-column gap-3 bg-white p-4 shadow rounded-4">
                    <div class=" text-secondary mt-3">Basic Info</div>
                    <form action="" class="d-flex flex-column gap-4">
                        <div class="d-flex align-items gap-3">
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
    
                        <div class="d-flex align-items gap-3">
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
                    </form>
                </div>

                <div class=" d-flex flex-column gap-3 bg-white p-4 shadow rounded-4">
                    <div class=" text-secondary mt-3">Academic</div>
                    <form action="" class="d-flex flex-column gap-4">
                        <div class="d-flex align-items gap-3">
                            <div class="input-group">
                                <label for="lrn" class="text-dark">Student LRN</label>
                                <input type="text" id="lrn" style="width: 100%;" placeholder="">
                            </div>
                            <div class="input-group">
                                <label for="section" class="text-dark">Section</label>
                                <input type="text" id="section" style="width: 100%;" placeholder="">
                            </div>
                            <div class="input-group">
                                <label for="strand" class="text-dark">Strand</label>
                                <input type="text" id="strand" style="width: 100%;" placeholder="">
                            </div>
                        </div>
    
                        <div class="d-flex align-items gap-3">
                            <div class="input-group">
                                <label for="level" class="text-dark">Year Level</label>
                                <input type="text" id="level" style="width: 100%;" placeholder="">
                            </div>
                            <div class="input-group flex-column" style="display: none; width: 210%;" id="specialization_con">
                                <label for="specialization" class="text-dark">Specialization</label>
                                <input type="text" id="specialization" placeholder="">
                            </div>
                            <div style="width: 210%;" id="empty_con"></div>
                        </div>

                        <div class="d-flex align-items gap-3">
                            <div class="input-group">
                                <label for="doorway" class="text-dark">Doorway</label>
                                <input type="text" id="doorway" style="width: 100%;" placeholder="">
                            </div>  
                            <div style="width: 100%;"></div>
                        </div>
                    </form>
                </div>
    
                <div class=" d-flex flex-column gap-3 bg-white p-4 shadow rounded-4">
                    <div class=" text-secondary">Address & Contact</div>
                        <form action="" class="d-flex flex-column gap-4">
                            <div class="d-flex align-items gap-3">
                                <div class="input-group">
                                    <label for="brgy" class="text-dark">Barangay</label>
                                    <input type="text" id="brgy" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="municipal" class="text-dark">Municipality</label>
                                    <input type="text" id="municipal" style="width: 100%;" placeholder="">
                                </div>
                                <div class="input-group">
                                    <label for="contact" class="text-dark"> Emergency Contact#</label>
                                    <input type="text" id="contact" style="width: 100%;" placeholder="">
                                </div>
                            </div>

                            <div class="d-flex align-items gap-3">
                                <div class="input-group">
                                    <label for="emergency" class="text-dark">Emergency Contact Person</label>
                                    <input type="text" id="emergency" style="width: 100%;" placeholder="">
                                </div>  
                                <div style="width: 100%;"></div>
                            </div>
                        </form>
                </div>
            </div>

            <div style="width: 40%; height: 380px" class="p-4 bg-white rounded-4 shadow position-relative">
                <div class="d-flex flex-column align-items-center justify-content-center pt-5">
                    <div id="no-image"></div>
                    <img src="" id="studentImg" class="position-absolute" style="width: 150px; height: 150px; border-radius: 100%; top: -30px; left: 50%; transform: translateX(-50%);" alt="">
                    <img src="" class="mt-5" id="qrcode" style="width: 80%; height: 80%; object-fit: contain"  alt="">
                    <div class="fs-6">SCAN ME!</div>
                </div>
            </div>
        </div>
      </div>
    </div>
    
</div>


<script>

    $(document).on('click', "#view_student", function() {
        let image = document.getElementById('studentImg');

        document.getElementById('fName').value = $(this).data('firstname');
        document.getElementById('mName').value = $(this).data('middlename');
        document.getElementById('lName').value = $(this).data('lastname');
        document.getElementById('suffix').value = $(this).data('suffix');
        document.getElementById('contact').value = $(this).data('contact');
        document.getElementById('emergency').value = $(this).data('emergency');
        document.getElementById('birth').value = $(this).data('birth');
        document.getElementById('age').value = $(this).data('age');
        document.getElementById('section').value = $(this).data('section');
        document.getElementById('strand').value = $(this).data('strand');
        document.getElementById('level').value = $(this).data('level');
        document.getElementById('lrn').value = $(this).data('lrn');
        document.getElementById('doorway').value = $(this).data('doorway');
        document.getElementById('brgy').value = $(this).data('brgy');
        document.getElementById('municipal').value = $(this).data('municipal');
        if ($(this).data('image') == null){
            image.style.display =  'none';
            document.getElementById('no-image').textContent = 'No image';
        }else {
            document.getElementById('no-image').style.display = 'none';
            image.style.display = 'block';
            image.src = $(this).data('image');
        }
        const qrUrl = $(this).data('qr');
        const qrName = qrUrl.spplit('/').pop();
        document.getElementById('qrcode').src = `${APP_URL}/storage/qr_code/${qrName}`;

        if($(this).data('specialization') != null) {
            document.getElementById('empty_con').style.display = 'none';
            document.getElementById('specialization_con').style.display = 'flex';
            document.getElementById('specialization').value = $(this).data('specialization');
        }else {
            document.getElementById('empty_con').style.display = 'block';
            document.getElementById('specialization_con').style.display = 'none';
        }
    })
</script>

