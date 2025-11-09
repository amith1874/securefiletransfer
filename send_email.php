
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$uploadDir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['filename']) || empty($_POST['filename'])) die("⚠️ No file selected!");
    if (!isset($_POST['email']) || empty($_POST['email'])) die("⚠️ Recipient email is required!");

    $selectedFile = basename($_POST['filename']);
    $recipientEmail = $_POST['email'];
    $filePath = $uploadDir . $selectedFile;

    if (!file_exists($filePath)) die("⚠️ File not found: $filePath");

    $mail = new PHPMailer(true);

    try {
        ob_clean(); // Prevent corruption

        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'amithacneeraj@gmail.com'; // Your Gmail
        $mail->Password   = 'cowguhfiyltdeegv';   // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email headers
        $mail->setFrom('amithacneeraj@gmail.com', 'Secure File Transfer');
        $mail->addAddress($recipientEmail);
        $mail->addReplyTo('kamarudcruz@gmail.com', 'Secure File Transfer');

        // Attach file
        $mail->addAttachment($filePath, $selectedFile);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Secure File Transfer - File Attached';
        $mail->Body    = 'The requested file <b>' . htmlspecialchars($selectedFile) . '</b> is attached.';
        $mail->AltBody = 'The requested file ' . $selectedFile . ' is attached.';

        $mail->send();
        echo "<b>✅ File sent successfully to $recipientEmail!</b>";

    } catch (Exception $e) {
        echo "<b>❌ Email could not be sent.</b><br>Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "⚠️ Invalid request method.";
}