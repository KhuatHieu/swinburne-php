<?php

// Include helpers, MySQLi connection and models
require_once __DIR__ . '/../helpers/request.php';
require_once __DIR__ . '/../helpers/validate.php';
require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../models/EOI.php';

use models\EOI;

/**
 * Validates the incoming requests from a form submission
 * Ensures that all required fields values meet certain criteria
 * Otherwise, send user back to input form with errors
 */
function validateRequests()
{
    // User must select jobRefNumber
    validate('jobRefNumber', function ($v) {
        return !empty($_POST["jobRefNumber"]);
    }, "You must select Job Reference Number");

    // User must enter firstName, firstName length must <= 20
    // and must only contain alpha-characters
    validate('firstName', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 20 && preg_match('/^[a-zA-Z]+$/', $v);
    }, "First name must exist and contain only letters with a maximum length of 20 characters");

    // User must enter lastName, lastName length must <= 20
    // and must only contain alpha-characters
    validate('lastName', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 20 && preg_match('/^[a-zA-Z]+$/', $v);
    }, "Last name must exist and contain only letters with a maximum length of 20 characters");

    // User must enter dateOfBirth, and Age of user must be between 15 and 80
    validate('dateOfBirth', function ($v) {
        $dateOfBirth = valueFromPost('dateOfBirth');
        if (empty($dateOfBirth)) {
            return false;
        }

        $userAge = date("Y") - date("Y", strtotime($v));

        return $userAge >= 15 && $userAge <= 80;
    }, "Date of birth must be entered and Age must be between 15 and 80");

    // User must select a gender
    validate('gender', function ($v) {
        return !empty($v);
    }, "A gender must be selected");

    // Street must exist and must not longer than 80 characters
    validate('street', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 80;
    }, "Street and would only contains 80 characters at most");

    // Suburb/town must exist and must not longer than 80 characters
    validate('suburb', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 80;
    }, "Suburb/town and would only contains 80 characters at most");

    // State must be one of VIC, NSW, QLD, NT, WA, SA, TAS or ACT
    validate('state', function ($v) {
        return in_array($v, ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"]);
    }, "State must be one of VIC, NSW, QLD, NT, WA, SA, TAS or ACT");

    // Postcode must be valid for the selected state
    validate('postcode', function ($postcode) {
        function isValidPostcodeForState($postcode, $state)
        {
            $validPostcodes = [
                'VIC' => ['3', '8'],
                'NSW' => ['1', '2'],
                'QLD' => ['4', '9'],
                'NT' => ['08', '09'],
                'WA' => ['6'],
                'SA' => ['5'],
                'TAS' => ['7'],
                'ACT' => ['02']
            ];

            if (!array_key_exists($state, $validPostcodes)) {
                return false;
            }

            return in_array(substr($postcode, 0, 1), $validPostcodes[$state], true)
                || in_array(substr($postcode, 0, 2), $validPostcodes[$state], true);
        }

        return strlen($postcode) === 4
            && isValidPostcodeForState($postcode, valueFromPost('state'));
    }, "Postcode must be valid");

    // Email must be valid
    validate('email', function ($v) {
        return filter_var($v, FILTER_VALIDATE_EMAIL);
    }, "Email must be valid");

    // Phone must exist and be a valid number between 8 and 12 digits
    validate('phoneNumber', function ($v) {
        if (preg_match('/[^0-9+]/', $v)) return false;

        $phoneNumber = preg_replace('/[^0-9+]/', '', $v);

        return strlen($phoneNumber) >= 8 && strlen($phoneNumber) <= 12;
    }, "Phone must exist and number must be valid");

    // Other skills must be entered if the checkbox is checked
    validate('skillsOther', function () {
        if (existsFromPost('skillsOtherCheckbox')) {
            // If 'skillsOtherCheckbox' exists, check if 'skillsOther' is set and not empty
            if (isset($_POST['skillsOther']) && $_POST['skillsOther'] !== '') {
                return true;
            } else {
                return false;
            }
        } else {
            // If 'skillsOtherCheckbox' doesn't exist, return true
            return true;
        }

    }, "You must enter other skills if checked checkbox");

    // Begin the validation process
    // Redirect user back and show errors if found any
    beginValidates();
}

// Redirect if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Location: ../../");
    exit();
}

// Process form submission if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Start a session
    session_start();

    // Validate form inputs
    validateRequests();

    // Create a new instance of EOI (Expression of Interest)
    $eoi = new EOI();

    // Assign values from POST data to EOI object properties
    $eoi->jobRefNumber = valueFromPost('jobRefNumber');
    $eoi->firstName = valueFromPost('firstName');
    $eoi->lastName = valueFromPost('lastName');
    $eoi->dateOfBirth = valueFromPost('dateOfBirth');
    $eoi->gender = valueFromPost('gender') == 'male' ? 1 : 0;
    $eoi->street = valueFromPost('street');
    $eoi->suburb = valueFromPost('suburb');
    $eoi->state = valueFromPost('state');
    $eoi->postcode = valueFromPost('postcode');
    $eoi->email = valueFromPost('email');
    $eoi->phoneNumber = valueFromPost('phoneNumber');
    $eoi->skillsCriticalThinking = (int)existsFromPost('skillsCriticalThinking');
    $eoi->skillsProblemSolving = (int)existsFromPost('skillsProblemSolving');
    $eoi->skillsLeadership = (int)existsFromPost('skillsLeadership');
    $eoi->skillsAdaptability = (int)existsFromPost('skillsAdaptability');
    $eoi->skillsCreativity = (int)existsFromPost('skillsCreativity');
    $eoi->skillsTimeManagement = (int)existsFromPost('skillsTimeManagement');
    $eoi->skillsOther = valueFromPost('skillsOther');

    // Save the EOI data to the database
    if ($eoi->save()) {
        // Clear old session data and set a success flag
        unset($_SESSION["old"]);
        unset($_SESSION["errors"]);
        $_SESSION["successfully"] = true;
    }

    // Redirect back to the previous page after form submission
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>
