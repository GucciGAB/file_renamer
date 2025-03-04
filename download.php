<?php
session_start();

if (!isset($_SESSION['renamedFiles']) || empty($_SESSION['renamedFiles'])) {
    die("No files available for download.");
}

// Set headers to trigger multiple downloads
foreach ($_SESSION['renamedFiles'] as $file) {
    if (file_exists($file)) {
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
        readfile($file);
        flush();
    }
}
?>
