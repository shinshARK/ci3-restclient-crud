<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
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
        input, textarea, select {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            max-width: 500px;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 15px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .location-group {
            margin-bottom: 10px;
        }
        .location-group button {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Edit Project</h1>
    <form action="<?php echo site_url('proyek/edit/' . $project['id']); ?>" method="post">
        <label for="namaProyek">Project Name:</label>
        <input type="text" name="namaProyek" id="namaProyek" value="<?php echo $project['namaProyek']; ?>" required><br>

        <label for="client">Client:</label>
        <input type="text" name="client" id="client" value="<?php echo $project['client']; ?>" required><br>

        <label for="tglMulai">Start Date:</label>
        <input type="date" name="tglMulai" id="tglMulai" value="<?php echo $project['tglMulai']; ?>" required><br>

        <label for="tglSelesai">End Date:</label>
        <input type="date" name="tglSelesai" id="tglSelesai" value="<?php echo $project['tglSelesai']; ?>" required><br>

        <label for="pimpinanProyek">Project Leader:</label>
        <input type="text" name="pimpinanProyek" id="pimpinanProyek" value="<?php echo $project['pimpinanProyek']; ?>" required><br>

        <label for="keterangan">Description:</label>
        <textarea name="keterangan" id="keterangan"><?php echo $project['keterangan']; ?></textarea><br>

        <div id="location-fields">
            <div class="location-group">
                <label for="lokasiIds">Location:</label>
                <select name="lokasiIds[]" class="location-dropdown">
                    <option value="">Select an option</option>
                </select>
                <button type="button" onclick="addLocationField()">Add Location</button>
            </div>
        </div>
		<br><br>

        <input type="submit" value="Update Project">
    </form>


</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const apiUrl = 'http://localhost:8080/lokasi';
        const locationFieldsContainer = document.getElementById('location-fields');
        let locations = [];

        // Function to fetch data and store it locally
        async function fetchLocations() {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                locations = await response.json();
                populateDropdowns();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Function to populate dropdowns based on current selections
        function populateDropdowns() {
            // Get all dropdowns
            const dropdowns = document.querySelectorAll('.location-dropdown');

            dropdowns.forEach(dropdown => {
                // Clear existing options except for the default one
                dropdown.innerHTML = '<option value="">Select an option</option>';

                // Get currently selected values from all dropdowns
                const selectedValues = Array.from(document.querySelectorAll('.location-dropdown'))
                    .map(d => d.value);

                // Populate dropdown with new options, excluding already selected ones
                locations.forEach(item => {
                    if (!selectedValues.includes(item.id.toString())) {
                        const option = document.createElement('option');
                        option.value = item.id; // Use `id` as the value
                        option.textContent = item.namaLokasi; // Use `namaLokasi` for the display text
                        dropdown.appendChild(option);
                    }
                });
            });
        }

        // Function to add a new location field
        function addLocationField() {
            const newLocationGroup = document.createElement('div');
            newLocationGroup.className = 'location-group';
            newLocationGroup.innerHTML = `
                <label for="lokasiIds">Location:</label>
                <select name="lokasiIds[]" class="location-dropdown">
                    <option value="">Select an option</option>
                </select>
                <button type="button" onclick="removeLocationField(this)">Remove Location</button>
            `;
            locationFieldsContainer.appendChild(newLocationGroup);
            // Populate the new dropdown
            populateDropdowns();
        }

        // Function to remove a location field
        function removeLocationField(button) {
            const locationGroup = button.parentElement;
            locationFieldsContainer.removeChild(locationGroup);
            // Re-populate all dropdowns
            populateDropdowns();
        }

        // Call fetchLocations on page load
        fetchLocations();

        // Make addLocationField and removeLocationField available globally
        window.addLocationField = addLocationField;
        window.removeLocationField = removeLocationField;
    });
</script>

