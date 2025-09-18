
 <!-- ID Card Back Layout Only -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
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
</style>
<div class="id back" id="idBack">
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
          <img src="http://hnvs_backend.test/storage/gallery/signatures.png" alt="signature" class="back-signature-img">
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
        <div class="contact-name">EFREN IBAÑEZ</div>
        <div class="contact-number">0935-121-9395</div>
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
