<?php
    $currentPage = $_SERVER['REQUEST_URI'];
    $editTeacherPage = (strpos($currentPage, 'edit-teacher.php') !== false);
    $editStudentPage = (strpos($currentPage, 'edit-student.php') !== false);
    $editSubject = (strpos($currentPage, 'edit-subject.php') !== false);
    $editStrand = (strpos($currentPage, 'edit-strand.php') !== false);
    $assignSubject = (strpos($currentPage, 'student-roster.php') !== false);
?>

<div class="bg-white" style="height: 90vh; position: sticky; top: 60px">
    <nav>
        <ul class="nav main_menu d-flex flex-column" style="margin-top: 35px">
            <p class="mb-1 px-3" style="font-size: 11px; font-weight:bold; color:rgb(174, 174, 174)">MAIN MENU</p>
            <li class="px-2">
                <div class=" mb-1">
                    <a href="dashboard.php" class="<?= (strpos($currentPage, 'dashboard.php') !== false) ? 'active' : '' ?> py-2 px-3 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>                        
                        Dashboard
                    </a>
                </div>
            </li>
            <li class="px-2" id="users" style="display: none;">
                <div class=" mb-1">
                    <a href="users.php" class="<?= (strpos($currentPage, 'users.php') !== false || strpos($currentPage, 'add_user.php')) ? 'active' : '' ?> py-2 px-3 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>                        
                        Manage Users
                    </a>
                </div>
            </li>

            <li class="px-2" id="generate_menu" style="display: none;">
                <div class="mb-1">
                    <!-- Dropdown Toggle -->
                    <a href="#"
                    class="nav_btns d-flex align-items-center justify-content-between py-2 px-3 <?= (strpos($currentPage, 'studentlist.php') !== false || strpos($currentPage, 'generate_id.php') !== false) ? 'active' : '' ?>"
                    style="text-decoration: none; font-size: 15px;"
                    data-bs-toggle="collapse"
                    data-bs-target="#generateSubMenu"
                    aria-expanded="false"
                    aria-controls="generateSubMenu"
                    >
                        <div class="d-flex align-items-center">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-id">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"/>
                                <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                <path d="M15 8l2 0" />
                                <path d="M15 12l2 0" />
                                <path d="M7 16l10 0" />
                            </svg>
                            Generate ID
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ms-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>

                    <!-- Submenu -->
                    <div class="collapse ps-4" id="generateSubMenu">
                        <a href="studentgeneratedidlist.php"
                        class="d-flex align-items-center py-1 px-3 <?= (strpos($currentPage, 'studentlist.php') !== false) ? 'fw-bold' : '' ?>"
                        style="font-size: 14px; text-decoration: none; color: #566573;">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3" y2="6" />
                                <line x1="3" y1="12" x2="3" y2="12" />
                                <line x1="3" y1="18" x2="3" y2="18" />
                            </svg>
                            Student List
                        </a>
                        <a href="generate_id.php"
                        class="d-flex align-items-center py-1 px-3 <?= (strpos($currentPage, 'generate_id.php') !== false) ? 'fw-bold' : '' ?>"
                        style="font-size: 14px; text-decoration: none; color: #566573;">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect x="6" y="14" width="12" height="8" />
                            </svg>
                            Generate ID
                        </a>
                    </div>
                </div>
            </li>

            <li class="px-2" id="generate_menu" style="display: none;">
                <div class="mb-1">
                    <a href="generate_id.php" class="<?= (strpos($currentPage, 'generate_id.php') !== false) ? 'active' : '' ?> py-2  nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-id"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>                        
                        Generate ID
                    </a>
                </div>
            </li>
            <li class="px-2" id="teachers_menu" style="display: none;">

                <div class="mb-1 ">
                    <a href="teachers.php" class="<?= (strpos($currentPage, 'teachers.php') !== false || strpos($currentPage, 'add_teacher.php') || $editTeacherPage) ? 'active' : '' ?> py-2 px-3  nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>                        
                        Teachers
                    </a>
                </div>
            </li>
            <li class="px-2" id="students_menu" style="display: none;">
                <div class="mb-1">
                    <a href="students.php" class="<?= (strpos($currentPage, 'students.php') !== false || strpos($currentPage, 'add_student.php') || $editStudentPage) ? 'active' : '' ?> py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="19"  height="19"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>                        
                        Students
                    </a>
                </div>
            </li>
            <li class="px-2" id="subjects_menu" style="display: none;">
                <div class="mb-1">
                    <a href="subjects.php" class="<?= (strpos($currentPage, 'subjects.php') !== false || strpos($currentPage, 'add-subject.php') || $editSubject || $assignSubject) ? 'active' : '' ?> py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vocabulary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" /><path d="M12 5v16" /><path d="M7 7h1" /><path d="M7 11h1" /><path d="M16 7h1" /><path d="M16 11h1" /><path d="M16 15h1" /></svg>                        
                        Subjects
                    </a>
                </div>
            </li>
            <li class="px-2" id="my_subjects" style="display: none;">
                <div class="mb-1">
                    <a href="#" class="py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vocabulary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" /><path d="M12 5v16" /><path d="M7 7h1" /><path d="M7 11h1" /><path d="M16 7h1" /><path d="M16 11h1" /><path d="M16 15h1" /></svg>                        
                        Subjects
                    </a>
                </div>
            </li>
            <li class="px-2" id="subjects_menu">
                <div class="mb-1">
                    <a href="#" class=" py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>                        
                        Attendance
                    </a>
                </div>
            </li>
        </ul>

        <ul class="nav main_menu mt-4 d-flex flex-column">
            <p class="mb-1 px-3" style="font-size: 11px; font-weight:bold; color:rgb(174, 174, 174)">SETTINGS</p>
            <li class="px-2">
                <div class=" mb-1">
                    <a href="settings.php" class="<?= (strpos($currentPage, 'settings.php') !== false) ? 'active' : '' ?> py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>                        
                        General Settings
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>

<script>

    // document.addEventListener('DOMContentLoaded', () => {
    //     fetch(`${APP_URL}/api/current/user`, {
    //         method: 'GET',
    //         headers: {
    //             'Accept': 'Application/json',
    //             'Authorization': 'Bearer ' + localStorage.getItem('token')
    //         }
    //     })
    //     .then(res => res.json())
    //     .then(data => {

    //         if(data.role == 0) {
    //             document.getElementById('generate_menu').style.display = 'block';
    //             document.getElementById('teachers_menu').style.display = 'block';
    //             document.getElementById('students_menu').style.display = 'block';
    //             document.getElementById('subjects_menu').style.display = 'block';
    //         }

    //         if(data.role == 1) {
    //             document.getElementById('teachers_menu').style.display = 'block';
    //             document.getElementById('students_menu').style.display = 'block';
    //             document.getElementById('subjects_menu').style.display = 'block';
    //         }

    //         if (data.role == 2) {
    //             document.getElementById('my_subjects').style.display = 'block';
    //         }
    //     })
    // })

    document.addEventListener('DOMContentLoaded', () => {
        const role = localStorage.getItem('role');

        if(role == '0') {
            document.getElementById('generate_menu').style.display = 'block';
            document.getElementById('teachers_menu').style.display = 'block';
            document.getElementById('students_menu').style.display = 'block';
            document.getElementById('subjects_menu').style.display = 'block';
            document.getElementById('users').style.display = 'block';
        }

        if(role == '1') {
            document.getElementById('teachers_menu').style.display = 'block';
            document.getElementById('students_menu').style.display = 'block';
            document.getElementById('subjects_menu').style.display = 'block';
        }

        if (role == '2') {
            document.getElementById('my_subjects').style.display = 'block';
        }
    })
</script>