<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Màu xám nhạt */
        }
        .navbar {
            background-color: #343a40; /* Màu navbar */
        }
        .navbar-brand {
            color: #ffffff; /* Màu chữ navbar */
        }
        .navbar-text {
            color: #ffffff; /* Màu chữ navbar */
        }

        .input-group {
            width: 35%; /* Kích thước của ô tìm kiếm */
            margin: 20px auto; /* Canh giữa ô tìm kiếm */
            float: left; /* Dịch về bên phải */
        }

        #searchInput {
            border-radius: 5px; /* Bo góc của ô tìm kiếm */
        }

        .btn {
            border-radius: 5px; /* Bo góc của nút */
        }

        .search-input input[type="text"] {
            width: calc(100% - 35px); /* Độ rộng của ô tìm kiếm trừ đi kích thước của icon lúp */
        }

    </style>
</head>
<body class="p-3 mb-2 bg-secondary-subtle text-secondary-emphasis">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <span class="navbar-text">
                Navbar text with an inline element
            </span>
        </div>
    </div>
</nav>

<div class="table-container">

    <div class="input-group mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
        <button class="btn btn-outline-secondary" type="button" id="clearSearchInput">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.146 3.146a.5.5 0 0 1 .708 0L8 7.293l4.146-4.147a.5.5 0 0 1 .708.708L8.707 8l4.147 4.146a.5.5 0 0 1-.708.708L8 8.707l-4.146 4.147a.5.5 0 0 1-.708-.708L7.293 8 3.146 3.854a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        <button class="btn btn-outline-secondary" type="button" id="searchButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.397l3.861 3.861a1 1 0 0 0 1.415-1.414l-3.86-3.86zM2 6.5a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0z"/>
            </svg>
        </button>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Job Ref Number</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Gender</th>
            <th scope="col">Street</th>
            <th scope="col">Suburb</th>
            <th scope="col">Postcode</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Skills</th>
            <th scope="col">Actions</th> <!-- Thêm cột Actions -->
        </tr>
        </thead>
        <tbody id="dataBody">
        <!-- Dữ liệu sẽ được thêm vào đây -->
        <?php
        // Một mảng chứa dữ liệu mẫu
        $data = [
            ["jobRefNumber" => "001", "firstName" => "John", "lastName" => "Doe", "dateOfBirth" => "1990-01-01", "gender" => "Male", "street" => "123 Main St", "suburb" => "Anytown", "postcode" => "12345", "email" => "john@example.com", "phoneNumber" => "123-456-7890", "skills" => "Programming, Design"],
            ["jobRefNumber" => "002", "firstName" => "Jane", "lastName" => "Smith", "dateOfBirth" => "1985-05-05", "gender" => "Female", "street" => "456 Oak St", "suburb" => "Othertown", "postcode" => "54321", "email" => "jane@example.com", "phoneNumber" => "987-654-3210", "skills" => "Marketing, Writing"],
            ["jobRefNumber" => "003", "firstName" => "Alice", "lastName" => "Johnson", "dateOfBirth" => "1988-12-15", "gender" => "Female", "street" => "789 Elm St", "suburb" => "Smalltown", "postcode" => "67890", "email" => "alice@example.com", "phoneNumber" => "234-567-8901", "skills" => "Data Analysis, Research"],
            ["jobRefNumber" => "004", "firstName" => "Bob", "lastName" => "Williams", "dateOfBirth" => "1992-09-20", "gender" => "Male", "street" => "1011 Pine St", "suburb" => "Hometown", "postcode" => "13579", "email" => "bob@example.com", "phoneNumber" => "345-678-9012", "skills" => "Customer Service, Communication"]
        ];

        foreach ($data as $index => $item) {
            echo "<tr>";
            echo "<th scope='row'>" . ($index + 1) . "</th>";
            echo "<td>" . $item['jobRefNumber'] . "</td>";
            echo "<td>" . $item['firstName'] . "</td>";
            echo "<td>" . $item['lastName'] . "</td>";
            echo "<td>" . $item['dateOfBirth'] . "</td>";
            echo "<td>" . $item['gender'] . "</td>";
            echo "<td>" . $item['street'] . "</td>";
            echo "<td>" . $item['suburb'] . "</td>";
            echo "<td>" . $item['postcode'] . "</td>";
            echo "<td>" . $item['email'] . "</td>";
            echo "<td>" . $item['phoneNumber'] . "</td>";
            echo "<td>" . $item['skills'] . "</td>";
            echo "<td>";
            echo "<div class='dropdown'>";
            echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton_" . $index . "' data-bs-toggle='dropdown' aria-expanded='false'>Actions</button>";
            echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton_" . $index . "'>";
            echo "<li><a class='dropdown-item' href='#' onclick='changeStatus(" . $index . ", \"Delete\")'>Delete</a></li>";
            echo "<li><button class='dropdown-item' onclick='openEditModal(" . $index . ")'>Update</button></li>";
            echo "</ul>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }

        ?>

        <?php foreach ($data as $index => $item) { ?>
            <div id="editModal_<?php echo $index; ?>" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel_<?php echo $index; ?>">Edit Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form fields for editing -->
                            <input type="hidden" id="editIndex_<?php echo $index; ?>" value="<?php echo $index; ?>">
                            <div class="mb-3">
                                <label for="editJobRefNumber_<?php echo $index; ?>" class="form-label">Job Ref Number</label>
                                <input type="text" class="form-control" id="editJobRefNumber_<?php echo $index; ?>" value="<?php echo $item['jobRefNumber']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="editFirstName_<?php echo $index; ?>" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="editFirstName_<?php echo $index; ?>" value="<?php echo $item['firstName']; ?>">
                            </div>
                            <!-- Add other fields for editing here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveChanges(<?php echo $index; ?>)">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function openEditModal(index) {
        $('#editModal_' + index).modal('show');
    }

    function saveChanges(index) {
        const newData = {
            jobRefNumber: document.getElementById('editJobRefNumber').value,
            firstName: document.getElementById('editFirstName').value,
            // Add other fields here
        };
        const data = <?php echo json_encode($data); ?>;
        data[index] = newData;
        renderData(data);
        const modalId = 'editModal_' + index;
        $('#' + modalId).modal('hide');
    }

    document.getElementById('searchInput').addEventListener('input', search);
    document.getElementById('clearSearchInput').addEventListener('click', function() {
        document.getElementById('searchInput').value='';
        search();
    });

    function search() {
        const searchText = document.getElementById('searchInput').value.toLowerCase();
        const filteredData = <?php echo json_encode($data); ?>.filter(item => {
            return (
                item.jobRefNumber.toLowerCase().includes(searchText) ||
                item.firstName.toLowerCase().includes(searchText) ||
                item.lastName.toLowerCase().includes(searchText) ||
                item.dateOfBirth.toLowerCase().includes(searchText) ||
                item.gender.toLowerCase().includes(searchText) ||
                item.street.toLowerCase().includes(searchText) ||
                item.suburb.toLowerCase().includes(searchText) ||
                item.postcode.toLowerCase().includes(searchText) ||
                item.email.toLowerCase().includes(searchText) ||
                item.phoneNumber.toLowerCase().includes(searchText) ||
                item.skills.toLowerCase().includes(searchText) ||
                item.status.toLowerCase().includes(searchText)
            );
        });
        renderData(filteredData);
    }

    function renderData(data) {
        const tableBody = document.getElementById('dataBody');
        tableBody.innerHTML = '';

        data.forEach((item, index) => {
            const row = `
            <tr>
                <th scope="row">${index + 1}</th>
                <td>${item.jobRefNumber}</td>
                <td>${item.firstName}</td>
                <td>${item.lastName}</td>
                <td>${item.dateOfBirth}</td>
                <td>${item.gender}</td>
                <td>${item.street}</td>
                <td>${item.suburb}</td>
                <td>${item.postcode}</td>
                <td>${item.email}</td>
                <td>${item.phoneNumber}</td>
                <td>${item.skills}</td>

            </tr>
        `;
            tableBody.innerHTML += row;
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
