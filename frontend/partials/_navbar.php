<div style="background-color: #fff; width: 100%; box-shadow: 0 0 12px 0 #abb2b9; z-index: 3">
    <div class="d-flex justify-content-between align-items-center" style="position: sticky; top: 0; padding: 12px 18px">
        <div class="d-flex align-items-center gap-2">
            <img src="http://hnvs_backend.test/images/logo.png" style="width: 35px;" alt="">
            <div class="fw-semibold" style="font-size: 18px;">HNVS</div>
        </div>

        <div class="d-flex align-items-center gap-4">
            <div id="role" style="font-size: 13px; color: #808b96"></div>
            <div style="width: 1px; height: 25px; background-color: #d5d8dc"></div>
            <ul class="nav">
                <li class="nav-item">
                    <div class="dropdown d-flex justify-content-center" style="cursor: pointer" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center gap-2">
                            <img src="" id="profileImage" style="width: 35px; border-radius: 35px" alt="">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
                        </div>
                        <div class="">
                            <ul class="user-drop dropdown-menu dropdown-menu-lg-end p-0" style="border: 1px solid #e0e0e0; width:200px">
                                <div id="profileBtn" class="list-group-item  p-2" style="cursor: default;">
                                    <div style="font-size: 14px;" id="user_name"></div>
                                    <small class="text-secondary" style="font-size: 12px" id="user_role"></small>
                                </div>
                                <li><hr class="dropdown-divider m-0"></li>
                                <a style="font-size: 13px;" class="list-group-item text-danger shadow dropdown-item admin-na py-2" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <svg class="ms-3" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                                    Logout
                                </a>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        fetch(`http://hnvs_backend.test/api/current/user`, {
            method: 'GET',
            headers: {
                'Accept': 'Appplication/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => response.json())
        .then(data => {
            let profileImg = document.getElementById('profileImage');
            let role = document.getElementById('role');
            let userRole = document.getElementById('user_role');
            document.getElementById('user_name').textContent = data.firstname + ' ' + data.lastname;
            
            if(data.image == null) {
                profileImg.src = 'http://hnvs_backend.test/images/default.jpg'
            }else{
                profileImg.src = `http://hnvs_backend.test/storage/${data.image}`
            }

            if(data.role == 0) {
                role.textContent = 'Root Admin'
                userRole.textContent = 'Root Admin'
            }

            if(data.role == 1) {
                role.textContent = 'Admin'
                userRole.textContent = 'Admin'
            }

            if(data.role == 2) {
                role.textContent = 'Teacher'
                userRole.textContent = 'Teacher'
            }
        })
    })
</script>