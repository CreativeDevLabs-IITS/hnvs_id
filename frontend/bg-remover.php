<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form id="bgRemoveForm" enctype="multipart/form-data">
  <input type="file" id="imageInput" name="image" accept="image/*" required>
  <button type="submit">Remove Background</button>
</form>

<img id="resultImg" style="margin-top:20px; max-width:300px;" />

<!-- Ito ang download button -->
<a id="downloadLink" style="display:none;" download="no-bg.png">Download Result</a>

<script>
document.getElementById('bgRemoveForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const fileInput = document.getElementById('imageInput');
  const file = fileInput.files[0];
  const formData = new FormData();
  formData.append('image', file);

  try {
    const res = await fetch('http://hnvs.system.test/api/remove-bg', {
      method: 'POST',
      body: formData
    });

    const contentType = res.headers.get('Content-Type') || '';

    if (!res.ok || !contentType.includes('image')) {
      const errorText = await res.text(); // <-- Safe na dito kasi hindi mo pa na-read ang body
      console.error('❌ Error Response:', errorText);
      alert('❌ Failed to remove background. Check console for details.');
      return;
    }

    const blob = await res.blob(); // <-- Basahin lang ang blob kung sure na image ang laman
    const objectURL = URL.createObjectURL(blob);

    const resultImg = document.getElementById('resultImg');
    resultImg.src = objectURL;

    const downloadLink = document.getElementById('downloadLink');
    downloadLink.href = objectURL;
    downloadLink.style.display = 'inline-block';
    downloadLink.textContent = '⬇️ Download Image';

  } catch (err) {
    console.error('⚠️ Fetch Error:', err);
    alert('⚠️ Something went wrong.');
  }
});

</script>


</body>
</html>