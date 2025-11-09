<?php
session_start();

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'imgoingofftillmay5';
$db_name = 'securetransfer';

// Create a new database connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate inputs
    if (empty($username) || empty($password)) {
        $login_error = 'Please enter both username and password.';
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Fetch the hashed password from the database
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            
            // Verify the password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user'] = $username;
                header('Location: dashboard.php');
                exit();
            } else {
                $login_error = 'Invalid username or password.';
            }
        } else {
            $login_error = 'Invalid username or password.';
        }
        
        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Secure File Transfer Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      color: #fff;
    }
    
    .container {
      display: flex;
      max-width: 1000px;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .features-section {
      flex: 1;
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .features-section h1 {
      font-size: 28px;
      margin-bottom: 20px;
      font-weight: 600;
    }
    
    .features-list {
      list-style: none;
      margin-bottom: 30px;
    }
    
    .features-list li {
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      font-size: 14px;
    }
    
    .features-list li:before {
      content: "✓";
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 20px;
      height: 20px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      margin-right: 10px;
      font-size: 12px;
    }
    
    .divider {
      height: 1px;
      background-color: rgba(255, 255, 255, 0.3);
      margin: 25px 0;
    }
    
    .login-section {
      flex: 1;
      padding: 40px;
      color: #333;
    }
    
    .login-section h2 {
      font-size: 24px;
      margin-bottom: 30px;
      color: #2a5298;
      font-weight: 600;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      font-size: 14px;
    }
    
    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      transition: border-color 0.3s;
    }
    
    .form-group input:focus {
      outline: none;
      border-color: #2a5298;
      box-shadow: 0 0 0 2px rgba(42, 82, 152, 0.2);
    }
    
    .password-requirements {
      margin-top: 5px;
      font-size: 12px;
      color: #666;
    }
    
    .login-button {
      width: 100%;
      padding: 14px;
      background: linear-gradient(to right, #2a5298, #1e3c72);
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }
    
    .login-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(42, 82, 152, 0.4);
    }
    
    .error-message {
      background-color: #ffe6e6;
      color: #d63031;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
      text-align: center;
      border-left: 4px solid #d63031;
    }
    
    .footer {
      text-align: center;
      margin-top: 25px;
      font-size: 12px;
      color: #777;
    }
    
    .register-link {
      text-align: center;
      margin-top: 20px;
    }
    
    .register-link a {
      color: #2a5298;
      text-decoration: none;
      font-weight: 500;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      
      .features-section {
        padding: 30px;
      }
      
      .login-section {
        padding: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="features-section">
      <h1>Secure File Transfer</h1>
      <p style="margin-bottom: 25px; font-size: 14px; opacity: 0.9;">
        Access your account to securely transfer and monitor files with enterprise-grade encryption.
      </p>
      
      <ul class="features-list">
        <li>Military-grade AES-256 encryption</li>
        <li>Real-time file activity monitoring</li>
        <li>Secure cloud storage with backups</li>
        <li>Advanced access controls</li>
        <li>Full audit trail and version history</li>
      </ul>
      
      <div class="divider"></div>
      
      <p style="font-size: 12px; opacity: 0.8;">
        Trusted by organizations worldwide for secure data exchange.
      </p>
    </div>
    
    <div class="login-section">
      <h2>Login to Your Account</h2>
      
      <?php if ($login_error): ?>
        <div class="error-message"><?= htmlspecialchars($login_error) ?></div>
      <?php endif; ?>
      
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" autocomplete="username" required />
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" autocomplete="current-password" required />
          <div class="password-requirements">Password must meet security requirements</div>
        </div>
        
        <button type="submit" class="login-button">Login</button>
      </form>
      
      <div class="register-link">
        <p>Don't have an account? <a href="register1.php">Register here</a></p>
      </div>
      
      <div class="footer">© 2025 SecureX Systems. All rights reserved.</div>
    </div>
  </div>
</body>
</html>