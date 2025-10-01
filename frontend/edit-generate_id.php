<?php include 'partials/_head.php' ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css" />
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- Notyf CSS & JS (kung wala pa) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
    body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            }

            .id-card {
            width: 204px;
            height: 324px;
            background: #B8D3E6;
            position: relative;
            color: white;
            overflow: hidden;
            }

            .watermark-logo {
            position: absolute;
            top: 39%;
            left: 84%;
            transform: translate(-50%, -50%);
            opacity: 0.5;
            z-index: 0;
            width: 250px;
            height: auto;
            }

            .watermark-logo img {
            width: 100%;
            height: auto;
            }

            .header {
            position: absolute;
            top: 8px;
            left: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1;
            }

            .header img {
            height: 43px;
            width: auto;
            margin-bottom: 2px;
            }

            .school-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.2;
            text-align: center;
            color: black;
            margin-left: 2px;
            }

            .school-name {
            font-size: 6px;
            font-weight: 700;
            margin-bottom:2px;
            }

            .school-level {
            font-size: 7.5px;
            font-weight: bold;
            margin-bottom:2px;
            line-height: 1;
            }

            .school-id {
            font-weight: bold;
            font-size: 6px;
            }

            .lrn {
            position: absolute;
            top: 0;
            right: 0;
            width: 28px;
            height: 70%;
            background: #012b60;
            }

            .lrn-bar {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 0;
            margin-top:35px;
            margin-left:5px;
            }

            .lrn-label {
            position: absolute;
            top: 10px;
            right: 5px;
            font-weight: bold;
            font-size: 10px;
            color: #ffffffff;
            z-index: 3;
            }

            .photo {
            position: absolute;
            
            left: 63%;
            transform: translateX(-50%);
            width: 150px;
            height: 190px;
            border-radius: 5px;
            /* z-index: ; para sure nasa ibabaw */
            }

            .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
            }


            .signature {
            position: absolute;
            top: 100px; /* mas mataas */
            left: 0px;
            height: 80px;
            z-index: 3;
            }


            .signature img {
            height: 100%;
            }

            .bottom-container {
            position: absolute;
            bottom: 50px;
            left: 0;
            width: 100%;
            height: 90px;
            background: #012b60;
            display: flex;
            align-items: flex-start;
            padding: 10px;
            box-sizing: border-box;
            z-index: 1;
            }

            .left-box {
            display: flex;
            flex-direction: column;
            color: white;
            gap:8px;
            }

            .name {
            font-weight: 700;
            line-height: 1;
            }

            .last-name {
            font-size: 14px;
            }

            .first-name {
            font-size: 11px;
            }

            .name h2 {
            font-size: 11px;
            font-weight: 400;
            line-height: 1.3;
            }

            .info {
            line-height: 1;
            color: white;
            margin-top: 0px;
            font-weight: bold;
            }

            .dob {
            font-size: 7px;
            }

            .dob-num {
            font-size: 10px;
            }

            .address {
            margin-top:5px;
            font-size: 7px;
            }

            .brgy-address {
            font-size: 10px;
            }

            .qr-code {
            position: absolute;
            right: 10px;
            bottom: 60px;
            width: 70px;
            height: 70px;
            z-index: 2;
            background-color: #fff; /* ✅ White background */
            padding: 2px; /* space sa loob */
        
            box-shadow: 0 0 3px rgba(0,0,0,0.2); /* optional, para lumutang ng konti */
            }

            .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* para sure sakto yung QR */
            }

            .track {
            position: absolute;
            bottom: 0px;
            width: 100%;
            background: white;
            z-index: 2;
            padding: 2px 6px;
            height: 50px;
            font-weight: bold;
            color: black;
            }

            .strand {
            display: flex;
            justify-content: center;
            text-align: center;
            font-size: 8px;
            
            }

            .doorway-word {
            display: flex;
            justify-content: center;
            text-align: center;
            font-size: 6px;
            }

            .doorway {
            display: flex;
            justify-content: center;
            text-align: center;
            font-size: 8px;
            }

            /* baack css */

            .id.back {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            background: none;
            box-shadow: none;
            border-radius: 0;
            padding: 0;
            height: 324px;
            width: 204px;
        }
        .id-card-back {
            height: 300px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            display: flex;
            font-size: 9px;
            position: relative;
            overflow: hidden;
        }
        .left-bar {
            width: 38px;
            color: white;
            display: flex;
            flex-direction: column;
            font-weight: bold;
            font-size: 7px;
        }
        .back-top {
            padding: 12px 8px 5px 8px;
            gap: 5px;
        }
        .left-content { width: 25%; }
        .right-content {
            width: 75%;
            flex: 1;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 0.8px;
        }
        .top-text {
            text-align: center;
            font-size: 7px;
        }
        .top-text b {
            font-size: 7px;
        }
        .back-signature {
            position: relative;
            text-align: center;
            margin: 18px 0 4px 0;
            font-size: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            min-height: 0px;
        }
        .signature-img-wrap {
            position: absolute;
            top: -11px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin: 0;
            z-index: 2;
        }
        .back-signature-img {
            width: 85px;
            height: 45px;
            object-fit: contain;
            display: block;
        }
        .signature-name {
            font-weight: bold;
            font-size: 7px;
        }
        .director {
            font-size: 7px;
            margin-top: -5px;
        }
        .reminders {
            text-align: center;
            font-size: 7px;
            line-height: 1.2;
        }
        .reminders b { font-size: 6px; }
        .contact 
        { 
            text-align: center; 
            font-size: 7px; 
            margin-top: 6px; 
            line-height: 1.2;
        }
        .contact_1 {
            text-align: center;
            font-size: 6px;
            margin-top: 5px;
            font-weight: bold;
        }
        .contact_1 b {
            font-size: 7px;
        }
        .contact-name {
            font-weight: bold;
            font-size: 10px;
            margin-top: 2px;
        }
        .contact-number {
            font-size: 9px;
            font-weight:bold;
            margin-bottom: 4px;
        }
        .qr-box {
            background: black;
            color: white;
            font-size: 7px;
            text-align: center;
            padding: 4px 2px;
            margin-top: 1px;
            font-weight: bold;
        }
        .facebook-footer {
            background: #000000;
            color: #fff;
            font-size: 7px;
            text-align: center;
            padding: 5px 0 5px 0;
            letter-spacing: 0.5px;
            width: 204px;
            font-family: inherit;
        }
        .year-strip { width: auto; background-color: white; font-family: "Montserrat", sans-serif; }
        .year-strip table { border-collapse: collapse; table-layout: fixed; }
        td { text-align: center; vertical-align: middle; padding: 0; }
        .rotated-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-orientation: mixed;
            display: inline-block;
            font-size: 7px;
            line-height: 1;
        }
        .year-cell, .semester-cell {
            background-color: #000;
            color: white;
            border: 1px solid #333;
            width: 20px;
            height: 94px;
        }
        .word-school-year {
            background-color: #000;
            color: white;
            border: 1px solid #333;
            width: 20px;
            height: 90px;
        }
        .first-cell, .second-cell {
            background-color: white;
            color: black;
            border: 1px solid #333;
            width: 20px;
            height: 90px;
        }
        .empty-cell {
            background-color: white;
            border: 1px solid #333;
            width: 15px;
            height: 90px;
        }
        @media print {
            html, body {
                zoom: 1.03;
                padding: 0;
                margin: 0;
            }

            body * {
                visibility: hidden;
            }

            .id.back, .id.back * {
                visibility: visible;
            }

            .id.back {
                position: absolute;
                top: 0;
                left: 0;
                background: white;
            }

            @page {
                margin: 0;
                size: auto;
            }

            .year-cell, .semester-cell,
            .rotated-text {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .first-cell .rotated-text,
            .second-cell .rotated-text {
                background-color: white !important;
                color: black !important;
            }
            }
            .switch-btn {
        background: linear-gradient(90deg, #5420B5 60%, #7B3FF2 100%);
        color: #fff;
        border: none;
        outline: none;
        padding: 10px 28px;
        margin: 0 8px;
        border-radius: 24px;
        font-size: 15px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(84,32,181,0.08);
        transition: background 0.2s, transform 0.2s;
        }

        .switch-btn:hover, .switch-btn.active {
            background: linear-gradient(90deg, #2b2a2c 60%, #212122 100%);
            transform: translateY(-2px) scale(1.04);
        }
</style>
<style>
  .editable-photo:hover {
    border: 3px dashed #007bff;
    border-radius: 8px;
    box-sizing: border-box;
    cursor: pointer;
  }
  .editable-signature:hover {
    border: 3px dashed #28a745;
    border-radius: 8px;
    box-sizing: border-box;
    cursor: pointer;
  }
</style>
    <div style="height: auto; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3 breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 14px;">Edit Generate ID</li>
                        <li class="breadcrumb-item" style="font-size: 14px;"><a href="teachers.php" class="text-decoration-none text-dark">Editor</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-4 mt-2">Edit Generate ID</div>
                </div>
                <div style="width:100%; display:flex; flex-direction:column; align-items:center; margin-top:20px;">
                    <div style="margin-bottom: 20px;">
                      <button id="showFront" class="switch-btn active">Front</button>
                      <button id="showBack" class="switch-btn">Back</button>
                      <button id="editBtn" class="switch-btn">Edit</button>
                      <button id="saveBtn" class="switch-btn">Save</button>
                      <button id="printBtn" class="switch-btn">Print</button>
                    </div>
                    <div style="display: flex; gap: 20px; margin-bottom: 10px;">
                          <div id="fontSizeControls" style="display:none;">
                            <label for="nameFontSize" style="font-weight:bold;">Name Font Size:</label>
                            <input type="range" id="nameFontSize" min="16" max="48" value="24" style="vertical-align:middle;">
                            <span id="fontSizeValue">24</span>px
                          </div>
                          <div id="firstNameFontSizeControls" style="display:none;">
                            <label for="firstNameFontSize" style="font-weight:bold;">First Name Font Size:</label>
                            <input type="range" id="firstNameFontSize" min="10" max="30" value="13" style="vertical-align:middle;">
                            <span id="firstNameFontSizeValue">13</span>px
                          </div>
                    </div>
              </div>
<!-- Id Cards Side by Side -->
<div style="display: flex; justify-content: center; gap: 20px; margin-top: 5px;">

  <!-- ID FRONT -->
  <div class="id-card" id="idFront" style="display: block;">
    <div class="watermark-logo">
      <img src="gear.png" alt="Background Logo" />
    </div>

    <div class="logo-school"></div>

    <div class="header">
      <img src="logo.png" alt="Logo" />
      <div class="school-info">
        <div class="school-name">HILONGOS NATIONAL <br /><span>VOCATIONAL SCHOOL</span></div>
        <div class="school-level">SENIOR HIGH <br> SCHOOL DEPARTMENT</div>
        <div class="school-id">SCHOOL ID: 303374</div>
      </div>
    </div>

  <!-- imong HTML code nimo diri -->
    <div class="lrn">
      <div class="lrn-label">LRN</div>
      <div class="lrn-bar" id="lrn-bar"></div>
    </div>

    <div class="photo" id="photoDrop">
      <img id="student-photo" src="bakla.png" alt="Photo" />
      <input type="file" id="photoInput" accept="image/*" style="display:none;" />
    </div>

    <div class="signature" id="signatureDrop">
      <img id="student-signature" src="signatura.png" alt="Signature" />
      <input type="file" id="signatureInput" accept="image/*" style="display:none;" />
    </div>

    <div class="bottom-container">
      <div class="left-box">
        <div class="name">
          <div class="last-name" id="last-name"></div>
          <div class="first-name" id="first-name">
            <span class="middle-name" id="middle-name"></span>
          </div>
        </div>
        <div class="info">
          <div class="dob">Date of Birth:</div>
          <div class="dob-num" id="dob-num"></div>
          <div class="address">Address:</div>
          <div class="brgy-address" id="brgy-address"></div>
        </div>
      </div>
    </div>
  <div class="qr-code">
    <img id="student-qr" src="" alt="QR" />
  </div>
    <div class="track">
      <div class="strand">
        SCIENCE, TECHNOLOGY, ENGINEERING, & MATHEMATICS (STEM)
      </div>
      <div class="doorway-word">Doorway:</div>
      <div class="doorway">DRIVING NC II AND AUTOMOTIVE SERVICING NC I</div>
    </div>
  </div>

  <!-- ID BACK -->
  <div class="id back" id="idBack" style="display: none;">
    <div class="id-card-back back-top">
      <div class="left-content">
        <div class="left-bar year-strip">
          <table id="schoolYearTable">
            <tr>
              <td class="word-school-year"></td>
              <td class="year-cell"><div class="rotated-text">2024-2025</div></td>
              <td class="empty-cell"></td>
              <td class="empty-cell"></td>
            </tr>
            <tr>
              <td class="word-school-year"><div class="rotated-text">SCHOOL YEAR</div></td>
              <td class="year-cell"><div class="rotated-text">2023-2024</div></td>
              <td class="empty-cell"></td>
              <td class="empty-cell"></td>
            </tr>
            <tr>
              <td class="word-school-year"></td>
              <td class="semester-cell"><div class="rotated-text">Semester</div></td>
              <td class="first-cell"><div class="rotated-text">First</div></td>
              <td class="second-cell"><div class="rotated-text">Second</div></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="right-content">
        <div class="top-text">
          This is to certify that the person whose<br>
          picture and signature appear herein<br>
          is a bonafide student of <b>Hilongos<br>
          National Vocaational School.</b>
        </div>

        <div class="back-signature">
          <div class="signature-img-wrap">
            <img src="" alt="signature" class="back-signature-img">
          </div>
          <div class="signature-name">RICHARD A. GABISON PhD, DPA</div>
          <div class="director">School Principal IV</div>
        </div>

        <div class="reminders">
          <b>IMPORTANT REMINDERS</b><br>
          Always wear this ID while inside<br>
          the school campus.<br>
          <b>Do not forget your<br>STUDENT LRN NUMBER.</b>
        </div>

        <div class="contact_1">
          If lost and found, please surrender<br>
          this ID to the<br><b>
          HNVS SHS OFFICE,</b><br>
          Hilongos National Vocational School <br>RV Fulache St. Hilongos, Leyte
        </div>

        <div class="contact">
          <b>In case of emergency,<br>please contact</b>
          <div class="contact-name" id="ename">EFREN IBAÑEZ</div>
          <div class="contact-number" id="cnumber">0935-121-9395</div>
        </div>

        <div class="qr-box">
          PLEASE SCAN THE QR<br>
          CODE AT THE FRONT<br>
          FOR MORE VALIDATION &<br>
          CONTACT INFORMATION.
        </div>
      </div>
    </div>
    <div class="facebook-footer back-bottom">
      https://www.hnvs.edu.ph.com/
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<?php include 'partials/_logout.php' ?>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const idFront = document.getElementById('idFront');
    const idBack = document.getElementById('idBack');
    const frontBtn = document.getElementById('showFront');
    const backBtn = document.getElementById('showBack');

    // Show Front
    frontBtn.addEventListener('click', () => {
      idFront.style.display = 'block';
      idBack.style.display = 'none';
      frontBtn.classList.add('active');
      backBtn.classList.remove('active');
    });

    // Show Back
    backBtn.addEventListener('click', () => {
      idFront.style.display = 'none';
      idBack.style.display = 'block';
      backBtn.classList.add('active');
      frontBtn.classList.remove('active');
    });
  });
</script>
<script>
const params = new URLSearchParams(window.location.search);
const studentId = params.get('id') || 1;

// fetch student info
fetch(`http://backend.test/api/showstudentid/${studentId}`, {
  method: 'GET',
  headers: {
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + localStorage.getItem('token')
  }
})
.then(res => res.json())
.then(data => {
  document.getElementById('lrn-bar').textContent = data.lrn;
  document.getElementById('last-name').textContent  = data.lastname;
  document.getElementById('first-name').firstChild.textContent = data.firstname + ' ';
  document.getElementById('middle-name').textContent = data.middlename ? data.middlename.charAt(0) + '.' : '';
  document.getElementById('dob-num').textContent   = data.birthdate;
  document.getElementById('cnumber').textContent   = data.emergency_contact;
  document.getElementById('brgy-address').textContent = `${data.barangay}, ${data.municipality}`;
  document.getElementById('student-photo').src = data.image || "bakla.png";
  document.getElementById('student-signature').src = data.signature || "signatura.png";
  if (data.qr_path) {
      document.getElementById('student-qr').src = data.qr_path;
  } else {
      document.getElementById('student-qr').src = ''; 
  }

  // --- Restore photo position & size ---
  if (data.photo_position) {
    try {
      const pos = JSON.parse(data.photo_position);
      const photo = document.getElementById('student-photo');
      photo.style.position = 'absolute';
      photo.style.left = pos.left + 'px';
      photo.style.top = pos.top + 'px';
      photo.style.width = pos.width + 'px';
      photo.style.height = pos.height + 'px';
    } catch (e) {
      console.error('Invalid photo_position JSON:', e);
    }
  }

  // --- Restore signature position & size ---
  if (data.signature_position) {
    try {
      const pos = JSON.parse(data.signature_position);
      const signature = document.getElementById('student-signature');
      signature.style.position = 'absolute';
      signature.style.left = pos.left + 'px';
      signature.style.top = pos.top + 'px';
      signature.style.width = pos.width + 'px';
      signature.style.height = pos.height + 'px';
    } catch (e) {
      console.error('Invalid signature_position JSON:', e);
    }
  }
});
let editMode = false;
let selectedImage = null;
let selectedSignature = null;

function makeDraggable(el) {
  let isDragging = false;
  let offsetX, offsetY;
  let sizeW = el.offsetWidth;
  let sizeH = el.offsetHeight;

  el.ondragstart = () => false;

  el.addEventListener("mousedown", (e) => {
    if (!editMode) return;
    isDragging = true;
    offsetX = e.clientX - el.offsetLeft;
    offsetY = e.clientY - el.offsetTop;
    el.style.position = "absolute";
    el.style.zIndex = 1000;
    el.style.cursor = "move";
  });

  document.addEventListener("mousemove", (e) => {
    if (!isDragging) return;
    el.style.left = (e.clientX - offsetX) + "px";
    el.style.top = (e.clientY - offsetY) + "px";
  });

  document.addEventListener("mouseup", () => {
    isDragging = false;
    if (editMode) el.style.cursor = "pointer";
  });

  el.addEventListener("wheel", (e) => {
    if (!editMode) return;
    e.preventDefault();
    if (e.deltaY < 0) { sizeW += 10; sizeH += 10; } 
    else { sizeW -= 10; sizeH -= 10; }
    if (sizeW < 30) sizeW = 30;
    if (sizeH < 30) sizeH = 30;
    el.style.width = sizeW + "px";
    el.style.height = sizeH + "px";
  });
}

document.getElementById('editBtn').addEventListener('click', () => {
  editMode = true;

  const photo = document.getElementById('student-photo');
  const signature = document.getElementById('student-signature');

  if (photo) {
    photo.classList.add("editable-photo");
    makeDraggable(photo);
  }

  if (signature) {
    signature.classList.add("editable-signature");
    makeDraggable(signature);
  }
});

// ================= PHOTO =================
document.getElementById('photoInput').addEventListener('change', function() {
  if (editMode && this.files && this.files[0]) {
    selectedImage = this.files[0];
    document.getElementById('student-photo').src = URL.createObjectURL(this.files[0]);
  }
});
const photoDrop = document.getElementById('photoDrop');
photoDrop.addEventListener('dragover', (e) => {
  if (!editMode) return;
  e.preventDefault();
  photoDrop.classList.add('dragover');
});
photoDrop.addEventListener('dragleave', () => {
  if (!editMode) return;
  photoDrop.classList.remove('dragover');
});
photoDrop.addEventListener('drop', (e) => {
  if (!editMode) return;
  e.preventDefault();
  photoDrop.classList.remove('dragover');
  if (e.dataTransfer.files && e.dataTransfer.files[0]) {
    selectedImage = e.dataTransfer.files[0];
    document.getElementById('student-photo').src = URL.createObjectURL(selectedImage);
  }
});
  
// ================= SIGNATURE =================
document.getElementById('signatureInput').addEventListener('change', function() {
  if (editMode && this.files && this.files[0]) {
    selectedSignature = this.files[0];
    document.getElementById('student-signature').src = URL.createObjectURL(this.files[0]);
  }
});

const signatureDrop = document.getElementById('signatureDrop');
signatureDrop.addEventListener('dragover', (e) => {
  if (!editMode) return;
  e.preventDefault();
  signatureDrop.classList.add('dragover');
});
signatureDrop.addEventListener('dragleave', () => {
  if (!editMode) return;
  signatureDrop.classList.remove('dragover');
});
signatureDrop.addEventListener('drop', (e) => {
  if (!editMode) return;
  e.preventDefault();
  signatureDrop.classList.remove('dragover');
  if (e.dataTransfer.files && e.dataTransfer.files[0]) {
    selectedSignature = e.dataTransfer.files[0];
    document.getElementById('student-signature').src = URL.createObjectURL(selectedSignature);
  }
});
const notyf = new Notyf({
    position: { x: 'right', y: 'top' },
    duration: 3000, 
    ripple: true,   
    dismissible: true 
});

document.getElementById('saveBtn').addEventListener('click', function () {
  const formData = new FormData();
  formData.append('student_id', studentId);

  const photo = document.getElementById('student-photo');
  const signature = document.getElementById('student-signature');

  formData.append('photo_position', JSON.stringify({
    left: photo.offsetLeft,
    top: photo.offsetTop,
    width: photo.offsetWidth,
    height: photo.offsetHeight
  }));
  formData.append('signature_position', JSON.stringify({
    left: signature.offsetLeft,
    top: signature.offsetTop,
    width: signature.offsetWidth,
    height: signature.offsetHeight
  }));

  if (selectedImage) formData.append('image', selectedImage);
  if (selectedSignature) formData.append('signature', selectedSignature);

  fetch(`http://backend.test/api/save-generated-id`, {
    method: "POST",
    headers: {
      "Authorization": "Bearer " + localStorage.getItem("token"),
      "Accept": "application/json"
    },
    body: formData
  })
  .then(res => res.json())
  .then(res => {
    notyf.success("Generated ID saved successfully!");
    editMode = false; 
  })
  .catch(err => {
    console.error("Save error:", err);
    notyf.error("Failed to save Generated ID.");
  });
});

</script>

