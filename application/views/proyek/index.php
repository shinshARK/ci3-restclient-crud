<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
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
        .locations ul {
            list-style-type: none;
            padding: 0;
        }
        .locations li {
            padding: 4px 0;
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
    <h1>Projects</h1>
    <a href="<?php echo site_url('proyek/create'); ?>">Add New Project</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Client</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Leader</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Locations</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo $project['id']; ?></td>
                        <td><?php echo $project['namaProyek']; ?></td>
                        <td><?php echo $project['client']; ?></td>
                        <td><?php echo $project['tglMulai']; ?></td>
                        <td><?php echo $project['tglSelesai']; ?></td>
                        <td><?php echo $project['pimpinanProyek']; ?></td>
                        <td><?php echo $project['keterangan']; ?></td>
                        <td><?php echo $project['createdAt']; ?></td>
                        <td class="locations">
                            <?php if (!empty($project['lokasis'])): ?>
                                <ul>
                                    <?php foreach ($project['lokasis'] as $location): ?>
                                        <li><?php echo $location['namaLokasi']; ?> (<?php echo $location['negara']; ?>, <?php echo $location['provinsi']; ?>, <?php echo $location['kota']; ?>)</li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                No locations available
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="<?php echo site_url('proyek/edit/' . $project['id']); ?>">Edit</a>
                            <a href="<?php echo site_url('proyek/delete/' . $project['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No projects found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
