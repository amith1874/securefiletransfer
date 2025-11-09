<?php
function encryptFile($filePath) {
    $data = file_get_contents($filePath);
    $key = 'secretkey1234567'; // 16-byte key for AES-128
    $encrypted = openssl_encrypt($data, 'AES-128-ECB', $key);
    file_put_contents($filePath, $encrypted);
}
?>


