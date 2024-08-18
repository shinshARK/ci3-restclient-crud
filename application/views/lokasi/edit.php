<!DOCTYPE html>
<html>
<head>
    <title>Edit Location</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Location</h1>
    <form action="<?php echo site_url('lokasi/edit/' . $location['id']); ?>" method="post">
        <label for="namaLokasi">Location Name:</label>
        <input type="text" name="namaLokasi" id="namaLokasi" value="<?php echo $location['namaLokasi']; ?>" required><br>

        <label for="negara">Country:</label>
        <input type="text" name="negara" id="negara" value="<?php echo $location['negara']; ?>" required><br>

        <label for="provinsi">Province:</label>
        <input type="text" name="provinsi" id="provinsi" value="<?php echo $location['provinsi']; ?>" required><br>

        <label for="kota">City:</label>
        <input type="text" name="kota" id="kota" value="<?php echo $location['kota']; ?>" required><br>

        <input type="submit" value="Update Location">
    </form>
</body>
</html>
