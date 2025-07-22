

<div class="offcanvas offcanvas-end d-flex flex-column justify-content-center px-3" style="width: 85%; background-color: #fff; font-family: Poppins, sans-serif;" tabindex="-1" id="student-roster" aria-labelledby="student-rosterLabel">
    <div class="lineLoader position-absolute top-0 start-0" id="offLineLoader" style="width: 100%; display: none"></div>
    <div class="offcanvas-header">
        <div class="fs-4 mt-2">Add Subject Roster</div>
        <button type="button" class="btn-close no_print" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="top-con px-3 pb-3">
            <div class="d-flex justify-content-end gap-4 mb-4">
                <form class="form" style="width: 40%">
                    <button>
                        <div class="loader" style="display: none;" id="offcanvasearchLoader"></div>
                        <svg id="offSearchIcon" width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                            <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <input class="input" placeholder="Search Student" required="" type="text" id="offcanva_search_student">
                </form>
                <button id="countBtn" class="btn btn-primary fw-semibold btn-sm" disabled> <span id="student_count"></span> Apply</button>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <div class="d-flex flex-column" style="max-width: 30%;">
                    <div class="text-secondary" style="font-size: 13px;">Subject:</div>
                    <div class="fs-5 fw-semibold" style="margin-top: -5px;" id="subject_name_offCanvas"></div>
                </div>
                <div class="d-flex gap-4 align-items-end">
                    <div class="fw-semibold" id="offAllBtn" style="padding: 2px 8px; color: #fff; border-radius: 5px; border: none; cursor: pointer">
                        All
                        <svg xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-caret-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 9c.852 0 1.297 .986 .783 1.623l-.076 .084l-6 6a1 1 0 0 1 -1.32 .083l-.094 -.083l-6 -6l-.083 -.094l-.054 -.077l-.054 -.096l-.017 -.036l-.027 -.067l-.032 -.108l-.01 -.053l-.01 -.06l-.004 -.057v-.118l.005 -.058l.009 -.06l.01 -.052l.032 -.108l.027 -.067l.07 -.132l.065 -.09l.073 -.081l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01l.057 -.004l12.059 -.002z" /></svg>
                    </div>
                    <div class="input-group d-flex flex-column align-items-baseline" style="width: 260px">
                        <label for="sem" style="font-size: 13px;" class="text-secondary">Stand</label>
                        <select class="" name="sem" id="offStrand" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                            <option value="" class="text-secondary" selected disabled>Select strand</option>
                            <!-- strand -->
                        </select>                                
                    </div>
    
                    <div class="input-group d-flex flex-column align-items-baseline" style="width: 260px">
                        <label for="sem" style="font-size: 13px;" class="text-secondary">Section</label>
                        <select class="" name="sem" id="offSection" style="border: none; box-shadow: none; border-bottom: 1px solid #808b96; outline: none !important; width: 100%">
                            <option value="" class="text-secondary" selected disabled>Select section</option>
                            <!-- section -->
                        </select>                                
                    </div>
                </div>
            </div>
            
            <div class="table-responsive mt-5">
                <table class="table table-hover align-middle rounded overflow-hidden" style="font-size: 13px;">
                    <thead class="table-secondary border">
                        <tr>
                            <th scope=""><input class="form-check-input" type="checkbox" id="offSelectAll"></th>
                            <th scope="col">Image</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Section</th>
                            <th scope="col">Strand</th>
                        </tr>
                    </thead>
                    <tbody id="offcanvas_table_body">
                        
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center" style="width: 50%;">
                    <div id="offPaginationInfo" style="font-size: 14px;"></div>
                    <div class="" id="offpagination"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<script>

        // populate strand dropdown
        $(document).ready(function() {
            fetch(`${APP_URL}/api/list/strands`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                let strandSelect = document.getElementById('offStrand');
                let strands = data.strands;
                
                strands.forEach(strand => {
                    let exists = Array.from(strandSelect.options).some(
                        option => option.textContent === strand.cluster
                    )
                    
                    if(!exists) {
                        let strandOption = document.createElement('option');
                        strandOption.value = strand.cluster;
                        strandOption.textContent = strand.cluster;

                        strandSelect.appendChild(strandOption);
                    }
                })
            });
        })

        // populate section dropdown
        $(document).ready(function() {
            fetch(`${APP_URL}/api/section/list`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                let sectionSelect = document.getElementById('offSection');
                let sections = data.sections;
                
                sections.forEach(section => {
                    let sectionOption = document.createElement('option');
                    sectionOption.value = section.name;
                    sectionOption.textContent = section.name;

                    sectionSelect.appendChild(sectionOption);
                })
            });
        })

        // pupulate table and search
        let offcurrentPage = 1;
        let offcurrentSearch = '';
        const selectedIds = new Set();
        let allIds = [];

        $(document).on('click', '#rosrterOffcanvas', function() {
            document.getElementById('offStrand').value = '';
            document.getElementById('offSection').value = '';
            document.getElementById('offAllBtn').style.color = '#fff';
            document.getElementById('offAllBtn').style.backgroundColor = '#3498db';
            offFetchStudents();

            // fetch all ids to use in the future
            fetch(`${APP_URL}/api/student/unpaginated/list`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'authorization': 'Bearer ' + localStorage.getItem('token',)
                }
            })
            .then(res => res.json())
            .then(data => {
                data.students.forEach( student => {
                    allIds.push(student.id);
                })

                if(data.students.length > 0) {
                    const urlParam = new URLSearchParams(window.location.search);
                    const id = urlParam.get('id');

                    data.students.forEach(student => {
                        if(student.subjects.some(sub => sub.id == id)) {
                            selectedIds.add(String(student.id));
                        }
                    });
                }
            })
        });

        function offFetchStudents(page = 1) {
            offcurrentSearch = ''; // clear search if it's a normal fetch
            fetch(`${APP_URL}/api/student/list?page=${page}`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                }
            })
            .then(response => response.json())
            .then(data => {
                const offstudents = data.students.data;
                const offmeta = data.students;
                offRenderTable(offstudents, offmeta);
                offRenderPagination(offmeta, false);
            });
        }

        function offFetchSearchResults(search, page = 1) {
            const section = document.getElementById('offSection').value;
            const strand = document.getElementById('offStrand').value;

            const params = new URLSearchParams({
                search: search,
                strand: strand,
                section: section,
                page: page
            });

            fetch(`${APP_URL}/api/search/student?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(res => res.json())
            .then(data => {
                const students = data.students.data;
                const meta = data.students;
                offRenderTable(students, meta);
                offRenderPagination(meta, true);
            })
        }

        function offRenderTable(students, meta) {
            const urlParam = new URLSearchParams(window.location.search);
            const id = urlParam.get('id');
            const tableBody = document.getElementById('offcanvas_table_body');
            tableBody.innerHTML = '';

            if(students.length  < 1) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 9;
                emptyCell.style.textAlign = 'center';
                emptyCell.classList.add('text-muted');
                emptyCell.textContent = 'No records found';

                emptyRow.appendChild(emptyCell);
                tableBody.appendChild(emptyRow);
                return;
            }

            let checkedAll = false;
            if(document.getElementById('offSelectAll').checked) {
                checkedAll = true;
            }

            students.forEach(student => {
                const is_checked = selectedIds.has(String(student.id)) || student.subjects.some(subject => subject.id == id) || checkedAll;

                let row = document.createElement('tr');
                row.innerHTML = `
                <td><input class="form-check-input studentCheckbox" type="checkbox" ${is_checked ? 'checked' : ''} value="${student.id}"></td>
                <td>${student.image ? `<img style="height: 30px; width: 30px; border-radius: 30px" src="${APP_URL}/storage/${student.image}" />` : 'No Image'}</td>
                <td>${student.lastname + ', ' + student.firstname + ' ' + (student.suffix != null ? student.suffix : '') + ' ' + (student.middlename != null ? student.middlename.charAt(0) : '') + '.'}</td>
                <td>${student.section.name}</td>
                <td>${student.strand.cluster == 'Industrial Arts (IA)' ? `(IA) ${student.strand.specialization}` : student.strand.cluster == 'Family and Consumer Science (FCS)' ? `(FCS) ${student.strand.specialization}` : student.strand.cluster }</td>
                `;

                tableBody.appendChild(row);

            })

            bindCheckboxListener();
        }

        function offRenderPagination(meta, isSearch = false) {
            const offPaginationInfo = document.getElementById('offPaginationInfo');
            offPaginationInfo.textContent = `Showing ${(meta.current_page - 1) * meta.per_page + 1} to ${Math.min(meta.current_page * meta.per_page, meta.total)} of ${meta.total} students`;

            const offContainer = document.getElementById('offpagination');
            offContainer.innerHTML = '';

            const offTotalPages = meta.last_page;
            const offCurrent = meta.current_page;
            const offMaxVisible = 5;
            let start = Math.max(1, offCurrent - Math.floor(offMaxVisible / 2));
            let end = Math.min(offTotalPages, start + offMaxVisible - 1);

            if (end - start < offMaxVisible - 1) {
                start = Math.max(1, end - offMaxVisible + 1);
            }

            if (offCurrent > 1) {
                const prev = document.createElement('button');
                prev.textContent = '<';
                prev.style.border = 'none';
                prev.style.padding = '1px 5px';
                prev.style.backgroundColor = '#ccd1d1';
                prev.style.marginRight = '8px';
                prev.style.borderRadius = '4px'
                prev.onclick = () => isSearch ? offFetchSearchResults(offcurrentSearch, offCurrent -1) : offFetchStudents(offCurrent - 1);
                offContainer.appendChild(prev);
            }

            for (let i = start; i <= end; i++) {
                const btn = document.createElement('button');
                btn.style.padding = '6px 10px';
                btn.style.border = '1px solid #aeb6bf';
                btn.style.backgroundColor = '#d7dbdd';
                if (i === offCurrent) {
                    btn.style.padding = '7px 12px';
                    btn.style.border = 'none';
                    btn.style.backgroundColor = '#3498db';
                    btn.style.color = '#fff';
                }
                btn.textContent = i;
                btn.disabled = i === offCurrent;
                btn.onclick = () => isSearch ? offFetchSearchResults(offcurrentSearch, i) : offFetchStudents(i);
                offContainer.appendChild(btn);
            }

            if(offCurrent < offTotalPages) {
                const next = document.createElement('button');
                next.textContent = '>';
                next.style.border = 'none';
                next.style.padding = '1px 5px';
                next.style.backgroundColor = '#ccd1d1';
                next.style.marginLeft = '8px';
                next.style.borderRadius = '4px'
                next.onclick = () => isSearch ? offFetchSearchResults(offcurrentSearch, offCurrent + 1) : offFetchStudents(offCurrent + 1);
                offContainer.appendChild(next);
            }
        }

        const offSearch = document.getElementById('offcanva_search_student');
        const offSearchIcon = document.getElementById('offSearchIcon');
        const offSearchLoader = document.getElementById('offcanvasearchLoader');

        offSearch.addEventListener('input', () => {
            document.getElementById('offAllBtn').style.backgroundColor = 'transparent';
            document.getElementById('offAllBtn').style.color = '#000';
            offSearchIcon.style.display = 'none',
            offSearchLoader.style.display = 'block';

            offcurrentSearch = offSearch.value.trim();

            if(offcurrentSearch === '') {
                document.getElementById('offAllBtn').style.backgroundColor = '#3498db';
                document.getElementById('offAllBtn').style.color = '#fff';
                offFetchStudents();
            } else {
                offFetchSearchResults(offcurrentSearch, 1);
            }

            setTimeout(() => {
                offSearchLoader.style.display = 'none';
                offSearchIcon.style.display = 'block';
            }, 300);

        })


        // filter by strand and section
        document.getElementById('offStrand').addEventListener('change', () => {
            document.getElementById('offAllBtn').style.backgroundColor = 'transparent';
            document.getElementById('offAllBtn').style.color = '#000';
            offcurrentSearch = offSearch.value.trim();
            offFetchSearchResults(offcurrentSearch, 1);
        });

        document.getElementById('offSection').addEventListener('change', () => {
            document.getElementById('offAllBtn').style.backgroundColor = 'transparent';
            document.getElementById('offAllBtn').style.color = '#000';
            offcurrentSearch = offSearch.value.trim();
            offFetchSearchResults(offcurrentSearch, 1);
        });

        document.getElementById('offAllBtn').addEventListener('click', () => {
            offFetchStudents();
            document.getElementById('offStrand').value = '';
            document.getElementById('offSection').value = '';
            offcurrentSearch.value = '';
            document.getElementById('offAllBtn').style.backgroundColor = '#3498db';
            document.getElementById('offAllBtn').style.color = '#fff';
        })

        function updateCountValue() {
            const selected = document.querySelectorAll('.studentCheckbox:checked');
            document.getElementById('student_count').textContent = `(${selectedIds.size})`;
            document.getElementById('countBtn').disabled = selectedIds.size === 0;

        }


        function bindCheckboxListener() {
            document.querySelectorAll('.studentCheckbox').forEach(checkBox => {
                const id = checkBox.value;

                if(checkBox.checked) {
                    selectedIds.add(String(id));
                }
                
                checkBox.addEventListener('change', function() {
                    if(this.checked) {
                        selectedIds.add(String(id));
                    } else {
                        selectedIds.delete(id);
                        document.getElementById('offSelectAll').checked = false;
                    }

                    const all =  document.querySelectorAll('.studentCheckbox');
                    const allChecked =  document.querySelectorAll('.studentCheckbox:checked');

                    if(all.length == allChecked.length) {
                        document.getElementById('offSelectAll').checked = true;
                    }

                    updateCountValue();
                });
            });

            updateCountValue();
        }

        function selectAll() {
            document.getElementById('offSelectAll').addEventListener('change', function() {
                selectedIds.clear();
                const isChecked = this.checked;
                const checkboxes = document.querySelectorAll('.studentCheckbox');
    
    
                if(isChecked) {
                    allIds.forEach(id => {
                        selectedIds.add(String(id));
                    })
                    checkboxes.forEach(check => {
                        check.checked = isChecked
                    })
                }else {
                    selectedIds.clear();
                    checkboxes.forEach(check => {
                        check.checked = false;
                    });
                }
    
                updateCountValue();
            });
        }
        
        selectAll();
        bindCheckboxListener();


        // submit
        $(document).on('click', '#countBtn', function() {
            document.getElementById('offLineLoader').style.display = 'block';
            const url_param = new URLSearchParams(window.location.search);
            const subject_id = url_param.get('id');
            const selectedBox = [];

            Array.from(selectedIds).forEach(value => {
                selectedBox.push(parseInt(value));
            });
            
            console.log(selectedBox);

            fetch(`${APP_URL}/api/subject/roster`, {
                method: 'POST',
                headers: {
                    'Accept': 'Application.json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'Application/json'
                },
                body: JSON.stringify({
                    subject: subject_id,
                    ids: selectedBox
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
                        location.reload();
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
                document.getElementById('offLineLoader').style.display = 'none';
            })
        })

</script>


