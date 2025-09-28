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
      width: 65px;
      height: 65px;
      z-index: 2;
    }

    .qr-code img {
      width: 100%;
      height: 100%;
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
  </style>
</head>
<body>
    <div class="id-card">
      <div class="watermark-logo">
        <img src="http://hnvs_backend.test/storage/gallery/hnvsbg.png" alt="Background Logo" />
      </div>
      <div class="logo-school"></div>

      <div class="header">
        <img src="http://hnvs_backend.test/storage/gallery/hnvslogo.png" alt="Logo" />
        <div class="school-info">
          <div class="school-name">HILONGOS NATIONAL <br /><span>VOCATIONAL SCHOOL</span></div>
          <div class="school-level">SENIOR HIGH <br> SCHOOL DEPARTMENT</div>
          <div class="school-id">SCHOOL ID: 303374</div>
        </div>
      </div>

      <div class="lrn">
        <div class="lrn-label">LRN</div>
        <div class="lrn-bar" id="student-lrn">123456789812</div>
      </div>

      <div class="photo">
        <img id="student-photo" src="http://hnvs_backend.test/storage/gallery/bayot.png" alt="Photo" />
      </div>

      <div class="signature">
        <img id="student-signature" src="http://hnvs_backend.test/storage/gallery/signatures.png" alt="Signature" />
      </div>

      <div class="bottom-container">
        <div class="left-box">
          <div class="name">
            <div class="last-name" id="student-lastname">VILLAHERMOSA</div>
            <div class="first-name">
              <span id="student-firstname">APPLE MARIE</span>
              <span class="middle-name" id="student-middlename">M.</span>
            </div>
          </div>
          <div class="info">
            <div class="dob">Date of Birth:</div>
            <div class="dob-num" id="student-dob">12/15/2003</div>
            <div class="address">Address:</div>
            <div class="brgy-address" id="student-address">Marangog, Hilongos</div>
          </div>
        </div>
      </div>

      <div class="qr-code">
        <img id="student-qr" src="http://hnvs_backend.test/storage/gallery/QR.png" alt="QR" />
      </div>

      <div class="track">
        <div class="strand" id="student-strand">
          SCIENCE, TECHNOLOGY, ENGINEERING, & MATHEMATICS (STEM)
        </div>
        <div class="doorway-word">Doorway:</div>
        <div class="doorway" id="student-doorway">
          DRIVING NC II AND AUTOMOTIVE SERVICING NC I
        </div>
      </div>
    </div>
</body>
</html>


<script>
const APP_URL = "http://backend.test";
const studentId = new URLSearchParams(window.location.search).get("id");
const token = localStorage.getItem('token'); 

fetch(`${APP_URL}/api/showstudentid/${studentId}`, {
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
    }
})
.then(res => {
    if (!res.ok) throw new Error("HTTP " + res.status);
    return res.json();
})
.then(student => {
    document.getElementById("student-lrn").innerText = student.lrn ?? "-";
    document.getElementById("student-lastname").innerText = student.lastname ?? "-";
    document.getElementById("student-firstname").innerText = student.firstname ?? "-";
    document.getElementById("student-middlename").innerText = student.middlename ?? "-";
    document.getElementById("student-dob").innerText = student.birthdate ?? "-";
    document.getElementById("student-address").innerText = student.address ?? "-";
    document.getElementById("student-strand").innerText = student.strand ?? "-";
    document.getElementById("student-doorway").innerText = student.doorway ?? "-";
    document.getElementById("student-photo").src = student.photo ?? "http://hnvs_backend.test/storage/gallery/bayot.png";
    document.getElementById("student-signature").src = student.signature ?? "http://hnvs_backend.test/storage/gallery/signatures.png";
    document.getElementById("student-qr").src = student.qr_code ?? "http://hnvs_backend.test/storage/gallery/QR.png";
})
.catch(err => {
    console.error("Error:", err);
});
</script>
