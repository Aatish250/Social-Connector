<?php
foreach ($_REQUEST as $key => $value) {
    echo htmlspecialchars($key) . ': ' . htmlspecialchars(print_r($value, true)) . "<br>\n";
}

if (!empty($_FILES)) {
    foreach ($_FILES as $key => $file) {
        echo htmlspecialchars($key) . ': ';
        if ($file['error'] === UPLOAD_ERR_OK) {
            echo 'Uploaded file: ' . htmlspecialchars($file['name']) . ' (' . $file['size'] . ' bytes)';
        } else {
            echo 'File upload error code: ' . htmlspecialchars($file['error']);
        }
        echo "<br>\n";
    }
}

echo "Signup process";