<?php
    $currentPage = $_SERVER['REQUEST_URI'];
    $editTeacherPage = (strpos($currentPage, 'edit-teacher.php') !== false);
    $editStudentPage = (strpos($currentPage, 'edit-student.php') !== false);
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
            <li class="px-2">
                <div class="mb-1">
                    <a href="generate_id.php" class="<?= (strpos($currentPage, 'generate_id.php') !== false) ? 'active' : '' ?> py-2  nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-id"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>                        
                        Generate ID
                    </a>
                </div>
            </li>
            <li class="px-2">
                <div class="mb-1 ">
                    <a href="teachers.php" class="<?= (strpos($currentPage, 'teachers.php') !== false || strpos($currentPage, 'add_teacher.php') || $editTeacherPage) ? 'active' : '' ?> py-2 px-3  nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>                        
                        Teachers
                    </a>
                </div>
            </li>
            <li class="px-2">
                <div class="mb-1">
                    <a href="students.php" class="<?= (strpos($currentPage, 'students.php') !== false || strpos($currentPage, 'add_student.php') || $editStudentPage) ? 'active' : '' ?> py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="19"  height="19"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>                        
                        Students
                    </a>
                </div>
            </li>
        </ul>
        <ul class="nav main_menu d-flex flex-column" style="margin-top: 35px">
            <p class="mb-1 px-3" style="font-size: 11px; font-weight:bold; color:rgb(174, 174, 174)">SETTINGS</p>
            <li class="px-2">
                <div class=" mb-1">
                    <a href="settings.php" class="<?= (strpos($currentPage, 'settings.php') !== false) ? 'active' : '' ?> py-2 nav_btns d-flex align-items-center" style="text-decoration: none; font-size: 15px; padding-left: 12px; padding-right: 12px">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>                        
                        Settings
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>


