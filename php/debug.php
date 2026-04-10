<?php
// Print all $_GET, $_POST, and $_FILES info for debugging

echo "<pre>";
echo "GET:\n";
print_r($_GET);

echo "\nPOST:\n";
print_r($_POST);

echo "\nFILES:\n";
print_r($_FILES);
echo "</pre>";