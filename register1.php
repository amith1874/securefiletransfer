<?php include('config/db1.php');
// Start session
session_start();

// Initialize variables
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    // Basic validation
    if ($password !== $confirm) {
        $error_message = 'Passwords do not match.';
    } elseif (empty($fullname) || empty($email) || empty($username) || empty($password)) {
        $error_message = 'All fields are required.';
    } else {
        // Check for existing username or email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);
        if ($stmt->rowCount() > 0) {
            $error_message = 'Username or email already exists.';
        } else {
            // Prepare and execute the insert statement
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (:fullname, :email, :username, :password)");
            if ($stmt->execute(['fullname' => $fullname, 'email' => $email, 'username' => $username, 'password' => $hashedPassword])) {
                $success_message = 'Account created successfully!';
                // Clear form fields after successful registration
                $fullname = $email = $username = '';
            } else {
                $error_message = 'Error creating account. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Secure File Transfer & Monitoring</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #007acc;
      --primary-dark: #005c99;
      --primary-light: #66ccff;
      --success: #4caf50;
      --warning: #ff9800;
      --danger: #f44336;
      --light-bg: #dff6ff;
      --light-accent: #b3e5fc;
      --white: #ffffff;
      --text-dark: #004d80;
      --text-light: #666;
      --border: #cce7ff;
      --shadow: 0 8px 24px rgba(0, 128, 255, 0.2);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, var(--light-bg), var(--light-accent));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .register-container {
      display: flex;
      width: 900px;
      max-width: 95%;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--shadow);
      background: var(--white);
    }

    .register-left {
      flex: 1;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: var(--white);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .register-left h1 {
      font-size: 32px;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .register-left p {
      margin-bottom: 25px;
      opacity: 0.9;
      line-height: 1.6;
    }

    .features-list {
      list-style: none;
      margin-top: 20px;
    }

    .features-list li {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }

    .features-list i {
      margin-right: 12px;
      background: rgba(255, 255, 255, 0.2);
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-right {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 600;
      color: var(--primary);
      font-size: 28px;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: var(--text-dark);
      font-weight: 500;
    }

    .input-with-icon {
      position: relative;
    }

    .input-with-icon i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary);
    }

    .register-box input[type="text"],
    .register-box input[type="email"],
    .register-box input[type="password"] {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1px solid var(--border);
      border-radius: 8px;
      background-color: #f8fbff;
      color: var(--text-dark);
      transition: var(--transition);
      font-size: 15px;
    }

    .register-box input:focus {
      border-color: var(--primary-light);
      outline: none;
      background-color: var(--white);
      box-shadow: 0 0 0 3px rgba(0, 122, 204, 0.1);
    }

    .password-strength {
      margin-top: 8px;
      height: 5px;
      border-radius: 5px;
      background: #e0e0e0;
      overflow: hidden;
    }

    .strength-bar {
      height: 100%;
      width: 0;
      transition: var(--transition);
    }

    .strength-weak { background: var(--danger); width: 25%; }
    .strength-fair { background: var(--warning); width: 50%; }
    .strength-good { background: #ffc107; width: 75%; }
    .strength-strong { background: var(--success); width: 100%; }

    .password-requirements {
      margin-top: 8px;
      font-size: 12px;
      color: var(--text-light);
    }

    .requirement {
      display: flex;
      align-items: center;
      margin-bottom: 4px;
    }

    .requirement i {
      margin-right: 6px;
      font-size: 10px;
    }

    .requirement.valid {
      color: var(--success);
    }

    .requirement.invalid {
      color: var(--text-light);
    }

    .register-box button {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 10px;
    }

    .register-box button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 122, 204, 0.3);
    }

    .message {
      text-align: center;
      font-size: 14px;
      margin-bottom: 15px;
      padding: 12px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .success { 
      background-color: rgba(76, 175, 80, 0.1); 
      color: var(--success);
      border: 1px solid rgba(76, 175, 80, 0.3);
    }
    
    .error { 
      background-color: rgba(244, 67, 54, 0.1); 
      color: var(--danger);
      border: 1px solid rgba(244, 67, 54, 0.3);
    }

    .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: var(--text-light);
    }

    .login-link a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .footer {
      text-align: center;
      margin-top: 25px;
      font-size: 12px;
      color: var(--text-light);
    }

    @media (max-width: 768px) {
      .register-container {
        flex-direction: column;
        width: 100%;
      }
      
      .register-left, .register-right {
        padding: 30px 25px;
      }
    }

    /* Animation for success message */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 0.5s ease forwards;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-left">
      <h1>Join Secure Share</h1>
      <p>Create your account to start securely transferring and monitoring files with enterprise-grade encryption.</p>
      
      <ul class="features-list">
        <li><i class="fas fa-shield-alt"></i> Military-grade AES-256 encryption</li>
        <li><i class="fas fa-chart-line"></i> Real-time file activity monitoring</li>
        <li><i class="fas fa-cloud-upload-alt"></i> Secure cloud storage with backups</li>
        <li><i class="fas fa-user-lock"></i> Advanced access controls</li>
        <li><i class="fas fa-history"></i> Full audit trail and version history</li>
      </ul>
    </div>
    
    <div class="register-right">
      <div class="register-box">
        <h2>Create Account</h2>
        
        <?php if ($success_message): ?>
          <div class="message success fade-in">
            <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success_message) ?>
          </div>
        <?php elseif ($error_message): ?>
          <div class="message error fade-in">
            <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error_message) ?>
          </div>
        <?php endif; ?>
        
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" id="registrationForm">
          <div class="form-group">
            <label for="fullname">Full Name</label>
            <div class="input-with-icon">
              <i class="fas fa-user"></i>
              <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($fullname ?? '') ?>" required />
            </div>
          </div>
          
          <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-with-icon">
              <i class="fas fa-envelope"></i>
              <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required />
            </div>
          </div>
          
          <div class="form-group">
            <label for="username">Username</label>
            <div class="input-with-icon">
              <i class="fas fa-at"></i>
              <input type="text" id="username" name="username" value="<?= htmlspecialchars($username ?? '') ?>" required />
            </div>
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-with-icon">
              <i class="fas fa-lock"></i>
              <input type="password" id="password" name="password" required />
            </div>
            <div class="password-strength">
              <div class="strength-bar" id="strengthBar"></div>
            </div>
            <div class="password-requirements" id="passwordRequirements">
              <div class="requirement invalid" id="lengthReq">
                <i class="far fa-circle"></i> At least 8 characters
              </div>
              <div class="requirement invalid" id="capitalReq">
                <i class="far fa-circle"></i> At least one capital letter
              </div>
              <div class="requirement invalid" id="numberReq">
                <i class="far fa-circle"></i> At least one number
              </div>
              <div class="requirement invalid" id="specialReq">
                <i class="far fa-circle"></i> At least one special character
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="confirm">Confirm Password</label>
            <div class="input-with-icon">
              <i class="fas fa-lock"></i>
              <input type="password" id="confirm" name="confirm" required />
            </div>
            <div id="confirmMessage" class="password-requirements"></div>
          </div>
          
          <button type="submit" id="submitBtn">
            <i class="fas fa-user-plus"></i> Create Account
          </button>
        </form>
        
        <div class="login-link">
          Already have an account? <a href="login1.php">Login here</a>
        </div>
        
        <div class="footer">© 2025 SecureX Monitoring | Protecting your data with military-grade security</div>
      </div>
    </div>
  </div>

  <script>
    // Password strength validation function
    function checkPasswordStrength(password) {
      let strength = 0;
      const requirements = {
        length: password.length >= 8,
        capital: /[A-Z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
      };

      // Calculate strength
      if (requirements.length) strength += 25;
      if (requirements.capital) strength += 25;
      if (requirements.number) strength += 25;
      if (requirements.special) strength += 25;

      return { strength, requirements };
    }

    // Update password strength indicator
    function updatePasswordStrength() {
      const password = document.getElementById('password').value;
      const strengthBar = document.getElementById('strengthBar');
      const { strength, requirements } = checkPasswordStrength(password);
      
      // Update strength bar
      strengthBar.className = 'strength-bar';
      if (strength <= 25) {
        strengthBar.classList.add('strength-weak');
      } else if (strength <= 50) {
        strengthBar.classList.add('strength-fair');
      } else if (strength <= 75) {
        strengthBar.classList.add('strength-good');
      } else {
        strengthBar.classList.add('strength-strong');
      }
      
      // Update requirement indicators
      document.getElementById('lengthReq').className = requirements.length ? 
        'requirement valid' : 'requirement invalid';
      document.getElementById('capitalReq').className = requirements.capital ? 
        'requirement valid' : 'requirement invalid';
      document.getElementById('numberReq').className = requirements.number ? 
        'requirement valid' : 'requirement invalid';
      document.getElementById('specialReq').className = requirements.special ? 
        'requirement valid' : 'requirement invalid';
        
      // Update icons
      const requirementsElements = document.querySelectorAll('.requirement');
      requirementsElements.forEach(req => {
        const icon = req.querySelector('i');
        if (req.classList.contains('valid')) {
          icon.className = 'fas fa-check-circle';
        } else {
          icon.className = 'far fa-circle';
        }
      });
    }

    // Check if passwords match
    function checkPasswordMatch() {
      const password = document.getElementById('password').value;
      const confirm = document.getElementById('confirm').value;
      const message = document.getElementById('confirmMessage');
      
      if (confirm === '') {
        message.textContent = '';
        message.className = 'password-requirements';
        return;
      }
      
      if (password === confirm) {
        message.innerHTML = '<i class="fas fa-check-circle" style="color: #4caf50;"></i> Passwords match';
        message.className = 'password-requirements';
        return true;
      } else {
        message.innerHTML = '<i class="fas fa-times-circle" style="color: #f44336;"></i> Passwords do not match';
        message.className = 'password-requirements';
        return false;
      }
    }

    // Form validation
    const form = document.getElementById('registrationForm');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm');
    const submitBtn = document.getElementById('submitBtn');

    // Add event listeners
    passwordInput.addEventListener('input', updatePasswordStrength);
    passwordInput.addEventListener('input', checkPasswordMatch);
    confirmInput.addEventListener('input', checkPasswordMatch);

    form.addEventListener('submit', function(e) {
      const password = passwordInput.value;
      const confirm = confirmInput.value;
      const { strength, requirements } = checkPasswordStrength(password);

      // Check if passwords match
      if (!checkPasswordMatch()) {
        e.preventDefault();
        return;
      }

      // Check password strength
      if (strength < 100) {
        e.preventDefault();
        alert(
          'Password must meet all security requirements:\n' +
          '- At least 8 characters\n' +
          '- At least one capital letter\n' +
          '- At least one number\n' +
          '- At least one special character'
        );
        return;
      }
    });

    // Add real-time validation for all fields
    const inputs = document.querySelectorAll('input[required]');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value === '') {
          this.style.borderColor = '#f44336';
        } else {
          this.style.borderColor = '#cce7ff';
        }
      });
    });
  </script>
</body>
</html>