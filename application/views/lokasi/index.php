<!DOCTYPE html>
<html>
<head>
    <title>Locations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
      
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions a {
            margin-right: 10px;
        }
		.navbar {
			background-color: #007bff; /* Navbar background color */
			padding: 10px;
			margin-bottom: 20px;
		}

		.navbar a {
			color: #fff; /* Text color for links */
			text-decoration: none;
			padding: 10px 15px;
			margin-right: 10px;
			border-radius: 4px;
		}

		.navbar a:hover {
			background-color: #0056b3; /* Background color on hover */
		}
		
		
    </style>
</head>
<body>
	<div class="navbar">
        <a href="<?php echo site_url('proyek'); ?>">Projects</a>
        <a href="<?php echo site_url('lokasi'); ?>">Locations</a>
    </div>
    <h1>Locations</h1>
    <a href="<?php echo site_url('lokasi/create'); ?>">Add New Location</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Country</th>
                <th>Province</th>
                <th>City</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($locations)): ?>
                <?php foreach ($locations as $location): ?>
                    <tr>
                        <td><?php echo $location['id']; ?></td>
                        <td><?php echo $location['namaLokasi']; ?></td>
                        <td><?php echo $location['negara']; ?></td>
                        <td><?php echo $location['provinsi']; ?></td>
                        <td><?php echo $location['kota']; ?></td>
                        <td><?php echo $location['createdAt']; ?></td>
                        <td class="actions">
                            <a href="<?php echo site_url('lokasi/edit/' . $location['id']); ?>">Edit</a>
                            <a href="<?php echo site_url('lokasi/delete/' . $location['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No locations found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
