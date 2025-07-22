
<div class=" d-flex flex-column gap-4">
    <div class=" text-dark fs-4">Add Strand</div>
    <div class=" text-secondary">Details</div>
    <form action="" class="d-flex flex-column gap-5 mb-3">
        <div class="d-flex align-items gap-5">
            <div class="input-group">
                <label for="trackSelect" class="text-dark">Track</label>
                <select class="" name="trackSelect" id="trackSelect" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                    <option value="" class="text-secondary" selected disabled>Select track</option>
                    <option value="0">Academic</option>
                    <option value="1">TechPro (Technical Professional)</option>
                </select>
            </div>
            <div class="input-group">
                <label for="addstrandDescription" class="text-dark">Description <span class="text-secondary">(Optional)</span> </label>
                <input type="text" name="addstrandDescription" id="strandDescription" style="width: 100%;" placeholder="">
            </div>
        </div>

        <div class="align-items gap-5" id="addtechTrack" style="display: none;">
            <div class="input-group">
                <label for="addtechCluster" class="text-dark">Cluster</label>
                <select class="" name="addtechCluster" id="addtechCluster" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                    <option value="" class="text-secondary" selected disabled>Select Cluster</option>
                    <option value="Industrial Arts (IA)">Industrial Arts (IA)</option>
                    <option value="Family and Consumer Science (FCS)">Family and Consumer Science (FCS)</option>
                </select>
            </div>
            <div class="input-group">
                <label for="addspecialization" class="text-dark">Specialization</label>
                <input type="text" name="addspecialization" id="addspecialization" style="width: 100%;" placeholder="">
            </div>
        </div>

        <div class="align-items gap-5" id="addacademicTrack" style="display: none;">
            <div class="input-group">
                <label for="addacademicName" class="text-dark">Cluster Name</label>
                <input type="text" name="addacademicName" id="addacademicName" style="width: 100%;" placeholder="">
            </div>
            <div style="width: 100%;"></div>
        </div>

    </form>
    <div class="d-flex gap-3 align-items-center mt-2">
        <button class="btn btn-primary fw-semibold d-flex align-items-center" id="addStrandBtn" style="background-color: #3498db !important; border: none">
            <div class="loader2 me-2" style="display: none;" id="createStrandLoader"></div>
            Save
        </button>
        <a onclick="closeEditPane('strandTable', 'addStrandTab')" class="btn btn-secondary fw-semibold text-white">Cancel</a>
    </div>
</div>


<script>
    // dynamic form
    $(document).on('change', '#trackSelect', function() {
        const value = this.value;
        
        if(value == 0) {
            console.log('0');
            $('#addtechCluster').val('');
            $('#addspecialization').val('');
            $('#addtechTrack').slideUp(200);
            $('#addacademicTrack').slideDown(200).css('display', 'flex');
        }

        if(value == 1) {
            console.log('1');
            $('#addacademicName').val('');
            $('#addacademicTrack').slideUp(200);
            $('#addtechTrack').slideDown(200).css('display', 'flex');
        }
    });


    $('#addStrandBtn').on('click', function(e) {
        e.preventDefault();
        const description = '';
        if(document.getElementById('addstrandDescription')) {
            description = document.getElementById('addstrandDescription').value;
        }
        

        document.getElementById('createStrandLoader').style.display = 'block';
        fetch(`${APP_URL}/api/create/strand`, {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                academicClusterName: document.getElementById('addacademicName').value,
                track: document.getElementById('trackSelect').value,
                description: description,
                cluster: document.getElementById('addtechCluster').value,
                specialization: document.getElementById('addspecialization').value
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
                    fetchStrands();
                    changePane('addStrandTab', 'strandTable');
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

</script>

