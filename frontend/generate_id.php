
<?php include 'partials/_head.php' ?>

    <div style="height: auto; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3 breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 14px;">Generate ID</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">Editor</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center" style="position:relative;">
                    <div class="fs-4 mt-2">Generate ID</div>
                        <form class="generate_search" style="position: relative; width: 300px;">
                            <input class="input" placeholder="Search" required type="text" id="id_search"
                                style="width: 100%; padding: 8px; border-radius:5px;">
                            <button type="submit" 
                                style="position:absolute; right:10px; top:50%; transform:translateY(-50%); border:none; background:none;">
                                <div class="loader" style="display: none;" id="searchLoader"></div>
                                <svg id="searchIcon" width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" 
                                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </button>
                            <ul id="searchResults" 
                                style="position: absolute; top: 100%; left: 0; width: 100%; 
                                    background: #fff; border: 1px solid #ccc; border-top: none; 
                                    max-height: 200px; overflow-y: auto; display: none; z-index: 9999; 
                                    border-radius: 0 0 5px 5px; list-style: none; margin:0; padding:0;">
                            </ul>
                        </form>
                    </div>
                    <div id="studentInfo"></div>

                </div>
            </div>

        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <?php include 'partials/_logout.php' ?>
    <?php include 'partials/config.php' ?>

<script>
    const APP_URL = "<?= APP_URL ?>";
    const FRONTEND_URL = "<?= FRONTEND_URL ?>"
    document.addEventListener('DOMContentLoaded', () => {
        const token = localStorage.getItem('token');
        if(!token) {
            location.replace(`${FRONTEND_URL}`);
        }else {
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, location.href);
                window.onpopstate = function () {
                    window.history.pushState(null, null, location.href); 
                };
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", async () => {
    const form = document.querySelector(".generate_search");
    const searchInput = document.querySelector("#id_search");
    const resultsDiv = document.querySelector("#searchResults");
    const loader = document.querySelector("#searchLoader");
    const searchIcon = document.querySelector("#searchIcon");
    const infoDiv = document.querySelector("#studentInfo"); 

    let students = []; 

 function showStudentInfo(student) {
    infoDiv.innerHTML = `
        <div style="border:1px solid #ddd; padding:15px; border-radius:5px; margin-top:15px; background:#fafafa;">
            <h5>${student.firstname ?? ""} ${student.middlename ?? ""} ${student.lastname ?? ""}</h5>
            <p><strong>Address:</strong> ${student.municipality ?? "-"}</p>
            <p><strong>Contact:</strong> ${student.contact ?? "-"}</p>

            <div style="margin-top:15px; text-align:right;">
                <button onclick="window.location.href='edit-generate_id.php?id=${student.id}'" 
                    style="
                        padding:8px 15px; 
                        border:none; 
                        border-radius:5px; 
                        background:#007bff; 
                        color:#fff; 
                        cursor:pointer;">
                    Edit
                </button>
            </div>
        </div>
    `;
}

    function renderStudents(list) {
        resultsDiv.innerHTML = "";
        if (list.length === 0) {
            resultsDiv.style.display = "none";
            return;
        }
        list.forEach(student => {
            let li = document.createElement("li");
            li.innerHTML = `
                <strong>${student.firstname ?? ""} ${student.lastname ?? ""}</strong> 
            `;
            li.style.padding = "8px";
            li.style.cursor = "pointer";
            li.style.borderBottom = "1px solid #eee";

            li.addEventListener("click", () => {
                searchInput.value = `${student.firstname} ${student.lastname}`;
                resultsDiv.style.display = "none";
                showStudentInfo(student); // <-- dito lalabas details
            });

            li.addEventListener("mouseover", () => li.style.background = "#f1f1f1");
            li.addEventListener("mouseout", () => li.style.background = "#fff");

            resultsDiv.appendChild(li);
        });
        resultsDiv.style.display = "block";
    }

    try {
        const res = await fetch(`${APP_URL}/api/students`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        });
        if (!res.ok) throw new Error("HTTP " + res.status);
        students = await res.json();
    } catch (err) {
        console.error("Failed to load students:", err);
    }

    searchInput.addEventListener("keyup", () => {
        const query = searchInput.value.trim().toLowerCase();
        if (!query) {
            resultsDiv.style.display = "none";
            return;
        }
        loader.style.display = "inline-block";
        searchIcon.style.display = "none";

        setTimeout(() => {
            const filtered = students.filter(s =>
                (s.firstname && s.firstname.toLowerCase().includes(query)) ||
                (s.middlename && s.middlename.toLowerCase().includes(query)) ||
                (s.lastname && s.lastname.toLowerCase().includes(query))
            );
            renderStudents(filtered);
            loader.style.display = "none";
            searchIcon.style.display = "inline-block";
        }, 200);
    });

    document.addEventListener("click", (e) => {
        if (!form.contains(e.target)) {
            resultsDiv.style.display = "none";
        }
    });
});

</script>