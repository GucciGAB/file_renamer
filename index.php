<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Rename Multiple Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        form {
            display: inline-block;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
        }
    </style>
</head>

<body>
    <h2>Upload and Rename Multiple Files</h2>
    <form action="rename.php" method="post" enctype="multipart/form-data">
        <label for="prefix">Filename Prefix:</label>
        <input type="text" name="prefix" id="prefix" value="File">

        <label for="start_number">Start Number:</label>
        <input type="number" name="start_number" id="start_number" value="1">

        <input type="file" name="files[]" multiple>
        <button type="submit">Upload</button>
    </form>

</body>

</html>