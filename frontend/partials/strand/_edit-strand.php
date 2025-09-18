
<div class="flex-column gap-4" id="editStrandContent" style="display: none;">
    <div class=" text-dark fs-4">Edit Strand</div>
    <div class=" text-secondary">Details</div>
    <form action="" class="d-flex flex-column gap-5 mb-3">
        <input type="hidden" id="strandId">
        <div class="d-flex align-items gap-5">
            <div class="input-group">
                <label for="track" class="text-dark">Track</label>
                <select class="" name="track" id="track" disabled style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
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
    <div class="d-flex gap-3 align-items-center mt-2">
        <button class="btn btn-primary fw-semibold d-flex align-items-center" id="editStrandBtn" style="background-color: #3498db !important; border: none">
            <div class="loader2 me-2" style="display: none;" id="editStrandLoader"></div>
            Save
        </button>
        <a onclick="closeEditPane('strandTable', 'editStrandTab')" class="btn btn-secondary fw-semibold text-white">Cancel</a>
    </div>
</div>


<script>

    // populate table
    function fetchAndPopulateTable() {
        fetch(`${APP_URL}/api/find/strand`, {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                id: document.getElementById('strandId').value
            })
        })
        .then(res => res.json())
        .then(data => {
            const strand = data.strand;
            document.getElementById('techTrack').style.display = 'none';
            document.getElementById('academicTrack').style.display = 'none';

            document.getElementById('track').value = '';
            document.getElementById('strandDescription').value = '';
            document.getElementById('techCluster').value = '';
            document.getElementById('specialization').value = '';
            document.getElementById('academicName').value = '';

            if(strand.track == 1) {
                document.getElementById('track').value = strand.track;
                document.getElementById('techTrack').style.display = 'flex';
                document.getElementById('techCluster').value = strand.cluster;
                document.getElementById('specialization').value = strand.specialization;
                document.getElementById('strandDescription').value = strand.description;
            }

            if(strand.track == 0) {
                document.getElementById('track').value = strand.track;
                document.getElementById('academicTrack').style.display = 'flex';
                document.getElementById('academicName').value = strand.cluster;
                document.getElementById('strandDescription').value = strand.description;
            }
        })
        .catch(error => {
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
        })
        .finally(() => {
            setTimeout(() => document.getElementById('editStrandContent').style.display = 'flex', 100);
        })
    }


    // update strand
    $(document).on('click', '#editStrandBtn', function(e) {
        e.preventDefault();
        document.getElementById('editStrandLoader').style.display = 'block';
        console.log(document.getElementById('strandId').value);
        
        fetch(`${APP_URL}/api/update/strand`, {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                id: document.getElementById('strandId').value,
                track: document.getElementById('track').value,
                description: document.getElementById('strandDescription').value,
                cluster: document.getElementById('techCluster').value,
                specialization: document.getElementById('specialization').value,
                academicName: document.getElementById('academicName').value
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
                    timer: 2000,
                })
                .then (() => {
                    fetchStrands();
                    changePane('editStrandTab', 'strandTable');
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
            document.getElementById('editStrandLoader').style.display = 'none';
        })
    })


</script>
