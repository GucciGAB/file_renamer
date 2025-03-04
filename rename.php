<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_FILES['files'])) {
        echo "No files uploaded.";
        exit;
    }

    $uploadDir = 'uploads/' . date('Y-m-d') . '/'; // Organize by date
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $files = $_FILES['files'];
    $prefix = isset($_POST['prefix']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['prefix']) : 'File';
    $startNumber = isset($_POST['start_number']) ? intval($_POST['start_number']) : 1;

    $uploadedFiles = [];

    foreach ($files['tmp_name'] as $index => $tmpName) {
        if ($files['error'][$index] == 0) {
            $originalName = $files['name'][$index];
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);

            // Extract number from filename if present
            preg_match('/\d+/', $originalName, $matches);
            $pageNum = isset($matches[0]) ? intval($matches[0]) : $startNumber++;

            $newFileName = sprintf("%s%03d.%s", $prefix, $pageNum, $ext);
            $filePath = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $filePath)) {
                $uploadedFiles[$pageNum] = $filePath;
            } else {
                echo "Error uploading file: $originalName <br>";
            }
        }
    }

    // Sort files by page number
    ksort($uploadedFiles);

    echo "<h3>Files Uploaded Successfully</h3>";
    foreach ($uploadedFiles as $file) {
        echo "<a href='$file' download>" . basename($file) . "</a><br>";
        
    }
}
?>
<br>

<a href="index.php">Go Back</a>
