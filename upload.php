<?php
include('encrypt.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $format = $_POST['format'];
    $email = $_POST['email'];
    $filename = basename($_FILES['file']['name']);
    $targetPath = "uploads/" . $filename;

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Validate file type (basic example)
    $allowedTypes = ['jpg', 'png', 'pdf', 'doc', 'txt'];
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($fileExtension, $allowedTypes)) {
        echo "File type not allowed.";
        exit;
    }

    // Create uploads directory if it doesn't exist
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        // Encrypt the file
        if (encryptFile($targetPath)) {
            // Send email
            include('send_email.php');
            if (sendEmail($email, $filename)) {
                echo "File uploaded, encrypted, and shared successfully.";
            } else {
                echo "File uploaded and encrypted, but email failed to send.";
            }
        } else {
            echo "File uploaded but encryption failed.";
        }
    } else {
        echo "File upload failed - cannot move file.";
    }
} else {
    // Handle specific upload errors
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "File too large.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "File upload was incomplete.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No file was selected.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Missing temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Failed to write file to disk.";
                break;
            default:
                echo "File upload failed with error code: " . $_FILES['file']['error'];
        }
    } else {
        echo "Invalid request method or no file uploaded.";
    }
}
?>