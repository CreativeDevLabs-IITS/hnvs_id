
<?php include 'partials/_head.php' ?>

    <div style="height: auto; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <div class="fs-4">Dashboard</div>
                <div class="d-flex flex-wrap gap-4 mt-5">
                    <div class="ps-4 pe-5 py-4 bg-white rounded-4 shadow" id="id_percentage" style="width: 300px; display: none">
                        <div style="font-size: 18px;">Total ID Percentage</div>
                        <div class="fw-bold fs-1 mt-3 d-flex align-items-center gap-2">
                            <div class="progress-ring" id="circle-border">
                                <svg width="120" height="120">
                                    <circle class="bg" cx="60" cy="60" r="45"></circle>
                                    <circle class="progress" cx="60" cy="60" r="45"></circle>
                                </svg>
                                <div id="percent" style="color: #3498DB"></div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center gap-1">
                                    <div style="background-color: #3498DB; width: 15px; height: 15px"></div>
                                    <div id="totalId" style="font-size: 15px; font-weight: 400"></div>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div style="background-color: #F54927; width: 15px; height: 15px"></div>
                                    <div id="noIdTotal" style="font-size: 15px; font-weight: 400"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-4 pe-5 py-4 bg-white rounded-4 shadow" style="width: 300px;">
                        <div style="font-size: 18px;">Students</div>
                        <div class="fw-bold fs-1 mt-3 d-flex align-items-center gap-2">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>                        
                            <div id="student_num"></div>
                        </div>
                    </div>

                    <div class="ps-4 pe-5 py-4 bg-white rounded-4 shadow" id="teacherNumCon" style="width: 300px; display: none">
                        <div style="font-size: 18px;">Teachers</div>
                        <div class="fw-bold fs-1 mt-3 d-flex align-items-center gap-2">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            <div id="teacher_num"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>


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


    $(document).ready(() => {
        fetch(`${APP_URL}/api/count/students`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('student_num').textContent = data.students;
            document.getElementById('totalId').textContent = `With ID: ${data.idcount}`;
            document.getElementById('noIdTotal').textContent = `No ID: ${data.noIdCount}`;
            getPercentage(data.idcount, data.students);
        });

        fetch(`${APP_URL}/api/count/teachers`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if(data.user == 1 || data.user == 0) {
                document.getElementById('teacherNumCon').style.display = 'block';
                document.getElementById('id_percentage').style.display = 'block';
                document.getElementById('teacher_num').textContent = data.teachers;
            }
        });

    });


    function getPercentage(idCount, studentCount) {
        const circle = document.querySelector('.progress');
        let percent = document.getElementById('percent');
        const percentage = Math.round(idCount / studentCount * 100);

        const color = '#3498DB';
        const radius = 45;
        const circumference = 2 * Math.PI * radius;
        const offset = circumference - (percentage / 100) *circumference;
        
        circle.style.strokeDashoffset = offset;
        circle.style.stroke = color;
        percent.textContent = `${Math.round(percentage)}%`
    }

</script>

<?php include 'partials/_footer.php' ?>
