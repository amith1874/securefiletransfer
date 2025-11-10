<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Secure Sharing Dashboard</title>
  <style>
    :root {
      --primary-color: #0288d1;
      --accent-color: #b3e5fc;
      --text-dark: #004d80;
      --text-light: #ffffff;
      --bg-light: #f0faff;
      --bg-white: #ffffff;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      --radius: 8px;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to bottom right, var(--bg-light), var(--accent-color));
      color: var(--text-dark);
    }

    .header0 {
      display: flex;
      align-items: center;
      padding: 20px 60px;
      background-color: var(--bg-white);
      box-shadow: var(--shadow);
    }

    .img1 img {
      height: 80px;
      width: 80px;
      margin-right: 20px;
      border-radius: 50%;
    }

    .title1 {
      font-size: 32px;
      font-weight: bold;
      color: var(--primary-color);
    }

    .regboard1 {
      display: flex;
      justify-content: space-between;
      padding: 20px 100px;
      flex-wrap: wrap;
    }

    .frame1, .frame11 {
      display: flex;
      gap: 12px;
    }

    button {
      height: 40px;
      width: 120px;
      border-radius: var(--radius);
      font-weight: bold;
      cursor: pointer;
      border: 1px solid #ccc;
      transition: all 0.3s ease;
    }

    .button1 {
      background-color: var(--primary-color);
      color: var(--text-light);
      border-color: #01579b;
    }

    .button1:hover {
      background-color: #0277bd;
    }

    .button11 {
      background-color: var(--accent-color);
      color: var(--text-dark);
    }

    .button11:hover {
      background-color: #81d4fa;
    }

    .button12 {
      background-color: #e1f5fe;
      color: var(--text-dark);
    }

    .button12:hover {
      background-color: #b3e5fc;
    }

    .button13 {
      background-color: #e0f7fa;
      color: #00796b;
    }

    .button13:hover {
      background-color: #b2ebf2;
    }

    .page1 {
      padding: 40px 100px;
      background-color: var(--bg-light);
    }

    .pagetitle1 {
      font-size: 30px;
      font-weight: bold;
      color: var(--primary-color);
      text-align: center;
      margin-bottom: 10px;
    }

    .pagedescrpt1 {
      font-size: 18px;
      color: #546e7a;
      text-align: center;
      margin-bottom: 40px;
    }

    .header11 {
      background-color: var(--bg-white);
      margin: 30px auto;
      padding: 20px;
      border-radius: var(--radius);
      width: 80%;
      box-shadow: var(--shadow);
      text-align: center;
    }

    .pagehead1 {
      font-size: 26px;
      font-weight: bold;
      color: var(--primary-color);
      margin-bottom: 10px;
    }

    .subtitle1 {
      font-size: 18px;
      color: #607d8b;
    }

    .down1 {
      text-align: center;
      margin: 20px 0;
    }

    @media (max-width: 768px) {
      .regboard1 {
        flex-direction: column;
        align-items: center;
      }

      .header0 {
        flex-direction: column;
        align-items: center;
      }

      .title1 {
        margin-top: 10px;
        text-align: center;
      }

      .page1 {
        padding: 20px;
      }

      .header11 {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="header0">
    <div class="img1">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRh5pgKO78jXX7jnQl1ALCVMmAkURlfdu1Lww&s" alt="Secure Shield">
    </div>
    <p class="title1">Secure Share</p>
  </div>

  <div class="regboard1">
    <div class="frame1">
      <button class="button12" onclick="document.location='login1.php'">Login</button>
      <button class="button1" onclick="document.location='register1.php'">Register</button>
    </div>
    <div class="frame11">
      <button class="button1">Home</button>
      <button class="button13">Dashboard</button>
     
    </div>
  </div>

  <div class="page1">
    <p class="pagetitle1">Secure File Exchange & Monitoring System</p>
    <p class="pagedescrpt1">Upload, encrypt, share, and monitor your files with enterprise-grade security and real-time tracking</p>

    <div class="header11">
      <p class="pagehead1">AES-256 Encryption</p>
      <p class="subtitle1">Military-grade encryption for all files</p>
    </div>

    <div class="header11">
      <p class="pagehead1">Real-Time Monitoring</p>
      <p class="subtitle1">Track all file activities and user actions</p>
    </div>

    <div class="header11">
      <p class="pagehead1">Secure Sharing</p>
      <p class="subtitle1">Share files with granular permissions</p>
    </div>

    <div class="header11">
      <p class="pagehead1">Enterprise Ready</p>
      <p class="subtitle1">Scalable architecture with admin controls</p>
    </div>

    <div class="down1">
      <button class="button1" onclick="document.location='register1.php'">Get Started</button>
    </div>

    <div class="down1">
      <button class="button11" onclick="document.location='learnmore1.php'">Learn More</button>
    </div>
  </div>

</body>
</html>
