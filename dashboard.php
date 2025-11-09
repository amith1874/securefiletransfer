<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Secure File Transfer Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f0f8ff;
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
    }

    header {
      background-color: #1e90ff;
      color: white;
      width: 100%;
      text-align: center;
      padding: 20px 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: fixed;
      top: 0;
      z-index: 1000;
    }

    h1 {
      margin: 0;
      font-size: 28px;
    }

    .sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: white;
      position: fixed;
      height: 100vh;
      padding-top: 80px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar a {
      display: block;
      color: #ecf0f1;
      padding: 15px 20px;
      text-decoration: none;
      border-bottom: 1px solid #34495e;
      transition: all 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #34495e;
      color: #ffffff;
      padding-left: 30px;
    }

    .sidebar a.active {
      background-color: #1e90ff;
      color: white;
    }

    .main-content {
      margin-left: 250px;
      padding: 100px 20px 60px;
      width: calc(100% - 250px);
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .container {
      max-width: 1100px;
      padding: 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 25px;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .icon {
      font-size: 50px;
      color: #1e90ff;
      margin-bottom: 10px;
    }

    h3 {
      color: #333;
      margin-bottom: 10px;
    }

    p {
      color: #555;
      font-size: 14px;
    }

    footer {
      background-color: #1e90ff;
      color: white;
      width: 100%;
      text-align: center;
      padding: 15px 0;
      position: fixed;
      bottom: 0;
      margin-left: 250px;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }
      
      .main-content {
        margin-left: 200px;
        width: calc(100% - 200px);
      }
      
      footer {
        margin-left: 200px;
      }
      
      .container {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding-top: 0;
      }
      
      .main-content {
        margin-left: 0;
        width: 100%;
        padding: 120px 20px 60px;
      }
      
      footer {
        margin-left: 0;
        position: relative;
      }
      
      body {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Secure File Transfer & Monitoring System</h1>
  </header>

  <div class="sidebar">
    <a href="index" class="active">🏠 Home Page</a>
    <a href="login1.php">🔐 Login Page</a>
    <a href="register1.php">📝 Register Page</a>
    <a href="files.php">📤 Upload Files</a>
    <a href="files.php">📨 Sent Files</a>
    <a href="received-files.php">📥 Received Files</a>
    <a href="user-profile.php">👤 User Account Management</a>
    <a href="settings.php">⚙️ Settings</a>
    <a href="help.php">❓ Help & Support</a>
  </div>

  <div class="main-content">
    <div class="container">
      <div class="card">
        <div class="icon">📤</div>
        <h3>Upload & Share Files</h3>
        <p>Upload sensitive files securely and share them with authorized recipients using encrypted channels.</p>
      </div>

      <div class="card">
        <div class="icon">📨</div>
        <h3>Sent Files</h3>
        <p>View all sent files, track delivery status, and confirm whether recipients have accessed them.</p>
      </div>

      <div class="card">
        <div class="icon">📥</div>
        <h3>Received Files</h3>
        <p>Access all files securely shared with you, with integrated decryption and download options.</p>
      </div>

      <div class="card">
        <div class="icon">👤</div>
        <h3>User Profile</h3>
        <p>Manage your account, update credentials, and view system usage insights.</p>
      </div>
    </div>
  </div>

  <footer>
    <p>© 2025 SecureShare</p>
  </footer>

</body>
</html>
