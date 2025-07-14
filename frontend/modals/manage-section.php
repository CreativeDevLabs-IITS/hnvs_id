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

