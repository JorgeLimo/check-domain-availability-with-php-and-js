<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Domain Availability Checker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
      padding-top: 40px;
    }
    .main-wrapper {
      max-width: 700px;
      margin: auto;
    }
    .result-img {
      max-width: 250px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <div class="container main-wrapper">
    <h2 class="text-center mb-4">Check Domain Availability</h2>
    
    <div class="row g-3">
      <div class="col-md-6">
        <input type="text" id="dominioData" class="form-control" placeholder="e.g., mydomain">
      </div>
      <div class="col-md-6">
        <select id="ext" class="form-select">
          <option value="com" selected>.com</option>
          <option value="net">.net</option>
          <option value="org">.org</option>
          <option value="info">.info</option>
        </select>
      </div>
    </div>

    <div class="text-center mt-4">
      <button id="getData" class="btn btn-primary">Check</button>
    </div>

    <div id="result" class="mt-4"></div>
  </div>

  <script>
    document.getElementById('getData').addEventListener('click', async () => {
      const name = document.getElementById('dominioData').value.trim();
      const ext = document.getElementById('ext').value;
      const result = document.getElementById('result');

      if (name === "") {
        result.innerHTML = '<div class="alert alert-danger">Please enter a domain name.</div>';
        return;
      }

      result.innerHTML = '<div class="text-center"><img src="https://i.imgur.com/ZKZ8Y5v.gif" width="60" alt="Loading..."></div>';

      try {
        const response = await fetch('searchDomain.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `name=${encodeURIComponent(name)}&domain=${encodeURIComponent(ext)}`
        });

        const data = await response.text();
        const fullDomain = `www.${name}.${ext}`;

        if (data == 1) {
          result.innerHTML = `
            <div class="alert alert-success text-center">
              <h4>✅ Good news! <strong>${fullDomain}</strong> is available.</h4>
              <img src="https://cdn2.iconfinder.com/data/icons/social-buttons-2/512/thumb_up-512.png" class="result-img" />
            </div>
          `;
        } else {
          result.innerHTML = `
            <div class="alert alert-danger text-center">
              <h4>❌ Sorry, <strong>${fullDomain}</strong> is not available.</h4>
              <img src="https://cdn2.iconfinder.com/data/icons/social-buttons-2/512/thumb_down-512.png" class="result-img" />
            </div>
          `;
        }
      } catch (error) {
        result.innerHTML = '<div class="alert alert-danger">Error contacting server. Please try again later.</div>';
        console.error('Error:', error);
      }
    });
  </script>

</body>
</html>
