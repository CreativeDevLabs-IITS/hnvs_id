
<div class="d-flex justify-content-between">
    <div class=" text-dark fs-4">Strand List</div>
    <div class="btn btn-primary" onclick="changePane('strandTable', 'addStrandTab')" style="background-color: #0071e2 !important; border: none">Add Strand</div>
</div>

<div class="table-responsive mt-4">
    <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px;">
        <thead class="table-secondary border">
            <tr>
                <th scope="col" class="fw-semibold">Action</th>
                <th scope="col" class="fw-semibold" >Cluster/Strand</th>
                <th scope="col" class="fw-semibold">Track</th>
                <th scope="col" class="fw-semibold">Specialization</th>
            </tr>
        </thead>
        <tbody id="strand_table_body">
            
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center" style="width: 50%;">
        <div id="paginationInfo" style="font-size: 14px;"></div>
        <div class="" id="pagination"></div>
    </div>
</div>

<!-- delete strand -->
<div class="modal fade" id="deleteStrandModal" tabindex="-1" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"  style="font-size: 14px">
                Are you sure you want to delete <strong id="clusterName"></strong> strand?
            </div>
            <div class="d-flex flex-row-reverse p-3 gap-3">
                <form action="" method="post" method="POST">
                    <input type="text" id="strandId" hidden>
                    <button type="submit" id="deleteStrandtBtn" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                        Delete
                        <div class="spinner-border spinner-border-sm" id="deleteStrandSpinner" style="display: none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
    let APP_URL = "<?= APP_URL ?>"

    // populate table
    function fetchStrands() {
        fetch(`${APP_URL}/api/list/strands`, {
            method: 'GET',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(res => res.json())
        .then(data => {
            const strands = data.strands;
            console.log(strands.length);
            const tbody = document.getElementById('strand_table_body');
            tbody.innerHTML = '';
    
            if(strands.length < 1) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 4;
                emptyCell.style.textAlign = 'center';
                emptyCell.classList.add('text-muted');
                emptyCell.textContent = 'No records found';
    
                emptyRow.appendChild(emptyCell);
                tbody.appendChild(emptyRow);
            }
            
            strands.forEach(strand => {
                let row = document.createElement('tr');
                row.innerHTML = `
                <td style="border-bottom: none">
                    <div class="d-flex gap-2">
                        <div id="strandDeleteBtn" data-id="${strand.id}" data-cluster="${strand.cluster}" data-specialization="${strand.specialization}" data-bs-toggle="modal" data-bs-target="#deleteStrandModal">
                            <svg class="text-danger" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </div>

                        <a onclick="showEditTab(this, 'editStrandTab')" data-id="${strand.id}">
                            <svg class="text-primary" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        </a>
    
                    </div>
                </td>
                <td style="border-bottom: none">${strand.cluster}</td>
                <td style="border-bottom: none">${strand.track == 0 ? 'Academic' : 'TechPro'}</td>
                <td style="border-bottom: none">${strand.specialization != null ? strand.specialization : '<div class="text-secondary">--</div>'}</td>
                `;
    
                tbody.appendChild(row);
            })
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
    }
    fetchStrands();

    // populate edit modal
    $(document).on('click', '#editStrand', function () {
        console.log($(this).data('name'))
        document.getElementById('strand_id').value = $(this).data('id');
        document.getElementById('edit_strand_name').value = $(this).data('name');
        document.getElementById('editStrandDescription').value = $(this).data('description');
        document.getElementById('editTrack').value = $(this).data('track');
    });

    // populate delete modal
    $(document).on('click', '#strandDeleteBtn', function(e) {
        e.preventDefault();
        let name = document.getElementById('clusterName');
        
        if($(this).data('specialization') != null) {
            if($(this).data('cluster') == 'Industrial Arts (IA)') {
                name.textContent = '(IA) ' +  $(this).data('specialization');
            }else {
                    name.textContent = '(FCS) ' +  $(this).data('specialization');
            }
        }else {
            name.textContent = $(this).data('cluster');
        }

        document.getElementById('strandId').value = $(this).data('id');
    })

    // delete strand
    $(document).on('click', '#deleteStrandtBtn', function(e) {
        e.preventDefault();
        document.getElementById('deleteStrandSpinner').style.display = 'block';

        fetch(`${APP_URL}/api/delete/strand`, {
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
                }).then (() => {
                    const delModal = bootstrap.Modal.getInstance(document.getElementById('deleteStrandModal'));
                    delModal.hide();
                    fetchStrands();
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
            document.getElementById('deleteStrandSpinner').style.display = 'none';
        })
    })
</script>
    