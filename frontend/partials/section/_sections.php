<div class="d-flex justify-content-between">
    <div class=" text-dark fs-4">Section List</div>
    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal" style="background-color: #0071e2 !important; border: none">Add Section</div>
</div>

<div id="" class="mt-3 text-dark">
    <div class="table-responsive">
        <table class="table table-hover table-hoveralign-middle rounded overflow-hidden" style="font-size: 14px;">
            <thead class="table-secondary border">
                <tr>
                    <th class="fw-semibold">Action</th>
                    <th scope="col" class="fw-semibold" >Name</th>
                </tr>
            </thead>
            <tbody id="section_table_body">
                
            </tbody>
        </table>
    </div>
</div>

<!-- add strand modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Strand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class=" px-3">
                        <small class="d-flex justify-content-center text-danger" style="font-size: 12px" id="roleError"></small>
                        <div class="input-group my-3 d-flex flex-column">
                            <small class="text-secondary mx-1" style="font-size: 13px">Section name</small>
                            <input type="text" id="section_name" style="font-size: 15px" class="" name="name">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end p-3 gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveSection" class="btn btn-warning text-light fw-semibold d-flex align-items-center gap-2" style="background-color: #3498db; border: none">
                        Save
                        <div class="spinner-border spinner-border-sm" id="saveSectionSpinner" style="display: none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- edit strand -->
<div class="modal fade" id="editSectionModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class=" px-3">
                        <small class="d-flex justify-content-center text-danger" style="font-size: 12px" id="roleError"></small>
                        <input type="hidden" id="section_id">
                        <div class="input-group my-3 d-flex flex-column">
                            <small class="text-secondary mx-1" style="font-size: 13px">Section name</small>
                            <input type="text" id="edit_section_name" style="font-size: 15px" class="" name="name">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end p-3 gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveEditSection" class="btn btn-warning text-light fw-semibold d-flex align-items-center gap-2" style="background-color: #3498db; border: none">
                        Save
                        <div class="spinner-border spinner-border-sm" id="saveEditSpinner" style="display: none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- delete section -->
<div class="modal fade" id="deleteSectionModal" tabindex="-1" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"  style="font-size: 14px">
                Are you sure you want to delete <strong id="sectionName"></strong> section?
            </div>
            <div class="d-flex flex-row-reverse p-3 gap-3">
                <form action="" method="post" method="POST">
                    <input type="text" id="sectionId" hidden>
                    <button type="submit" id="deleteSectiontModalBtn" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                        Delete
                        <div class="spinner-border spinner-border-sm" id="deleteSectionSpinner" style="display: none" role="status">
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

    function fetchSections() {
        fetch('http://hnvs_backend.test/api/section/list', {
            method: 'GET',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(res => res.json())
        .then(data => {
            const sections = data.sections;

            const tbody = document.getElementById('section_table_body');
            tbody.innerHTML = '';

            if(sections.length < 1) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 2;
                emptyCell.style.textAlign = 'center';
                emptyCell.classList.add('text-muted');
                emptyCell.textContent = 'No records found';

                emptyRow.appendChild(emptyCell);
                tbody.appendChild(emptyRow);
            }
            
            sections.forEach(section => {
                let row = document.createElement('tr');
                row.innerHTML = `
                <td style="border-bottom: none">
                    <div class="d-flex gap-2">
                        <div id="sectionDeleteBtn" data-id="${section.id}" data-name="${section.name}" data-bs-toggle="modal" data-bs-target="#deleteSectionModal">
                            <svg class="text-danger" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </div>
                        
                        <a href="" id="editSectionBtn" data-bs-toggle="modal" data-bs-target="#editSectionModal" data-id="${section.id}" data-name="${section.name}">
                            <svg class="text-primary" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        </a>

                    </div>
                </td>
                <td style="border-bottom: none">${section.name}</td>
                `;

                tbody.appendChild(row);
            })
        })
    }

    fetchSections();

    // save section
    $('#saveSection').on('click', function(e) {
        e.preventDefault();
        document.getElementById('saveSectionSpinner').style.display = 'block';

        fetch('http://hnvs_backend.test/api/section/create', {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                name: document.getElementById('section_name').value
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
                    const addModal = bootstrap.Modal.getInstance(document.getElementById('addSectionModal'));
                    addModal.hide();
                    fetchSections();
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
            document.getElementById('saveSectionSpinner').style.display = 'none';
        })
    })

    // populate edit modal
    $(document).on('click', '#editSectionBtn', function() {
        document.getElementById('edit_section_name').value = $(this).data('name');
        document.getElementById('section_id').value = $(this).data('id');
    })

    // edit
    $(document).on('click', '#saveEditSection', function(e) {
        e.preventDefault();
        document.getElementById('saveEditSpinner').style.display = 'block';
        
        fetch('http://hnvs_backend.test/api/section/edit', {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                id: document.getElementById('section_id').value,
                name: document.getElementById('edit_section_name').value,
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editSectionModal'));
                    modal.hide();
                    fetchSections();
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
            document.getElementById('saveEditSpinner').style.display = 'none';
        })
    })


    // populate delete modal
    $(document).on('click', '#sectionDeleteBtn', function() {
        document.getElementById('sectionName').textContent = $(this).data('name');
        document.getElementById('sectionId').value = $(this).data('id');
    });

    // delete section
    $(document).on('click', '#deleteSectiontModalBtn', function(e) {
        e.preventDefault();
        document.getElementById('deleteSectionSpinner').style.display = 'block';

        fetch('http://hnvs_backend.test/api/section/delete', {
            method: 'POST',
            headers: {
                'Accept': 'Application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify({
                id: document.getElementById('sectionId').value
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteSectionModal'));
                    modal.hide();
                    fetchSections();
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
            document.getElementById('deleteSectionSpinner').style.display = 'none';
        })
    })

</script>