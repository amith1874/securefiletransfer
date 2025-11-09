<?php
// ----------------------
// Database Connection
// ----------------------
$host = "localhost";
$db   = "securetransfer";     // Change to your DB
$user = "root";     // Change to your DB user
$pass = "imgoingofftillmay5"; // Change to your DB password

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Upload folder
$uploadDir = "uploads/";

// ----------------------
// Handle File Upload
// ----------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_file'])) {
    $file = $_FILES['upload_file'];
    $fileName = basename($file['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO uploaded_files (file_name) VALUES (?)");
        $stmt->bind_param("s", $fileName);
        $stmt->execute();
        $stmt->close();
        $uploadMessage = "✅ File uploaded successfully!";
    } else {
        $uploadMessage = "❌ Failed to upload file!";
    }
}

// ----------------------
// Fetch Files for Dropdown
// ----------------------
$files = [];
$result = $conn->query("SELECT file_name FROM uploaded_files ORDER BY uploaded_at DESC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $files[] = $row['file_name'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            height: 100vh;
            padding-top: 20px;
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

        .sidebar h3 {
            color: #ecf0f1;
            padding: 20px 20px 10px;
            margin: 0;
            font-size: 18px;
            border-bottom: 1px solid #34495e;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        input, select, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0077cc;
        }

        .upload-message {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .file-list {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .file-list ul {
            list-style-type: none;
            padding: 0;
        }

        .file-list li {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .file-list li:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            
            .main {
                margin-left: 200px;
                width: calc(100% - 200px);
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main {
                margin-left: 0;
                width: 100%;
            }
            
            body {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Navigation</h3>
        <a href="dashboard.php">🏠 Back to Dashboard</a>
        <a href="#" class="active">📁 Uploaded Files</a>
        <a href="sent-files.php">📨 Sent Files</a>
        <a href="received-files.php">📥 Received Files</a>
        <a href="user-profile.php">👤 User Profile</a>
        <a href="settings.php">⚙️ Settings</a>
    </div>

    <div class="main">
        <h2>Upload a New File</h2>
        <?php if(isset($uploadMessage)): ?>
            <div class="upload-message <?php echo strpos($uploadMessage, '✅') !== false ? 'success' : 'error'; ?>">
                <?php echo $uploadMessage; ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="upload_file" required>
            <button type="submit">Upload File</button>
        </form>

        <h2>Share an Uploaded File</h2>
        <?php if(empty($files)) {
            echo "<p>⚠️ No files available to share.</p>";
        } else { ?>
        <form action="send_email.php" method="POST">
            <label for="filename">Select a file to share:</label>
            <select name="filename" id="filename" required>
                <option value="">-- Select File --</option>
                <?php foreach($files as $file) {
                    echo "<option value=\"$file\">$file</option>";
                } ?>
            </select>

            <label for="email">Recipient Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter recipient email" required>

            <button type="submit">Share File</button>
        </form>
        <?php } ?>

        <div class="file-list">
            <h3>All Uploaded Files:</h3>
            <?php if(empty($files)): ?>
                <p>No files uploaded yet.</p>
            <?php else: ?>
                <ul>
                    <?php foreach($files as $file) { 
                        echo "<li>📄 $file</li>"; 
                    } ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
