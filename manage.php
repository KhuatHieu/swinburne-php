<?php

require_once __DIR__ . '/models/EOI.php';
require_once __DIR__ . '/helpers/request.php';

$statuses = require_once __DIR__ . '/const/status.php';

use models\EOI;

$sJobRefNum = $sFirstName = $sLastName = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sJobRefNum = valueFromGet('job_ref_number');
    $sFirstName = valueFromGet('first_name');
    $sLastName = valueFromGet('last_name');

    $eois = EOI::where([
        'job_ref_number' => strtolower($sJobRefNum ?? ''),
        'first_name' => strtolower($sFirstName ?? ''),
        'last_name' => strtolower($sLastName ?? '')
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eoi = EOI::find(valueFromPost('eoiNumber'));

    switch (valueFromPost('_action')) {
        case 'updateStatus':
            $eoi->status = valueFromPost('status');
            $eoi->save();
            break;
        case 'delete':
            $eoi->delete();
            break;
        case 'deleteBatchByJobRefNum':
            EOI::deleteBatchByJobRefNum(valueFromPost('jobRefNum'));
            break;
    }

    echo "<meta http-equiv='refresh' content='0'>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Màu xám nhạt */
        }

        .navbar {
            background-color: #343a40; /* Màu navbar */
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
    <div class="p-2">
        <a class="navbar-brand ms-3" href="./">Home</a>
        <a class="navbar-brand" href="./manage.php">Manager</a>
    </div>
</nav>

<div>
    <div class="d-flex flex-row">
        <form action="" method="get" class="input-group w-50 mt-3 mb-3">
            <select class="form-select" name="job_ref_number">
                <option value="" <?php echo ($sJobRefNum === '') ? 'selected' : ''; ?>>Job Reference Number</option>
                <option value="FE024" <?php echo ($sJobRefNum === 'FE024') ? 'selected' : ''; ?>>FE024</option>
                <option value="BE024" <?php echo ($sJobRefNum === 'BE024') ? 'selected' : ''; ?>>BE024</option>
            </select>

            <input type="text" class="form-control" name="first_name"
                   value="<?php echo $sFirstName ?>" placeholder="First name">
            <input type="text" class="form-control" name="last_name"
                   value="<?php echo $sLastName ?>" placeholder="Last name">

            <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                     viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.397l3.861 3.861a1 1 0 0 0 1.415-1.414l-3.86-3.86zM2 6.5a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0z"/>
                </svg>
            </button>
        </form>
        <div class="dropdown mt-3 mb-3 ms-auto">
            <form action="" method="post">
                <input type="hidden" name="_action" value="deleteBatchByJobRefNum">
                <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Quick delete EOIs
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button type="submit" class="dropdown-item" name="jobRefNum" value="FE024">FE024</button>
                    </li>
                    <li>
                        <button type="submit" class="dropdown-item" name="jobRefNum" value="BE024">BE024</button>
                    </li>
                </ul>
            </form>
        </div>

    </div>

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Job Ref Number</th>
            <th scope="col">Full Name</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Gender</th>
            <th scope="col">Street</th>
            <th scope="col">Suburb</th>
            <th scope="col">Postcode</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody id="dataBody">
        <?php
        foreach ($eois ?? [] as $index => $eoi) {
            $gender = $eoi->gender == 1 ? 'Male' : 'Female';
            $rowNumber = $index + 1;
            echo <<<HTML
        <tr>
            <th scope='row'>{$rowNumber}</th>
            <td>{$eoi->jobRefNumber}</td>
            <td>{$eoi->fullName}</td>
            <td>{$eoi->dateOfBirth}</td>
            <td>{$gender}</td>
            <td>{$eoi->street}</td>
            <td>{$eoi->suburb}</td>
            <td>{$eoi->postcode}</td>
            <td>{$eoi->email}</td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="_action" value="updateStatus">
                    <input type="hidden" name="eoiNumber" value="{$eoi->eoiNumber}">
                    <select name="status" onchange="this.form.submit()">
HTML;
            foreach ($statuses as $status) {
                $selected = $eoi->status === $status ? ' selected' : '';
                echo "<option value='{$status}'{$selected}>{$status}</option>";
            }
            echo <<<HTML
                    </select>
                </form>
            </td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="_action" value="delete">
                    <input type="hidden" name="eoiNumber" value="{$eoi->eoiNumber}">
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
HTML;
        }
        ?>
        </tbody>

    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
