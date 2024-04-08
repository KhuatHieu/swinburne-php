<?php

require_once __DIR__ . '/../helpers/request.php';
require_once __DIR__ . '/../helpers/validate.php';
require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../models/EOI.php';

use models\EOI;

function validateRequests(): void
{
    validate('jobRefNumber', function ($v) {
        return !empty($_POST["jobRefNumber"]);
    }, "You must select Job Reference Number");

    validate('firstName', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 20;
    }, "First name must exist and would only contains 20 characters at most");

    validate('lastName', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 20;
    }, "Last name must exist and would only contains 20 characters at most");

    validate('dateOfBirth', function ($v) {
        if (empty(valueFromPost('dateOfBirth'))) {
            return false;
        }
        $userAge = date("Y") - date("Y", strtotime($v));

        return $userAge >= 15 && $userAge <= 80;
    }, "Date of birth must be entered and Age must be between 15 and 80");

    validate('gender', function ($v) {
        return !empty($v);
    }, "A gender must be selected");

    validate('street', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 40;
    }, "Street must exist and would only contains 40 characters at most");

    validate('suburb', function ($v) {
        return strlen($v) > 0 && strlen($v) <= 40;
    }, "Suburb/town must exist and would only contains 40 characters at most");

    validate('state', function ($v) {
        return in_array($v, ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"]);
    }, "State must be one of VIC, NSW, QLD, NT, WA, SA, TAS or ACT");

    validate('postcode', function ($postcode) {
        function isValidPostcodeForState($postcode, $state): bool
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

    validate('email', function ($v) {
        return filter_var($v, FILTER_VALIDATE_EMAIL);
    }, "Email must be valid");

    validate('phoneNumber', function ($v) {
        if (preg_match('/[^0-9+]/', $v)) return false;

        $phoneNumber = preg_replace('/[^0-9+]/', '', $v);

        return strlen($phoneNumber) >= 8 && strlen($phoneNumber) <= 12;
    }, "Phone must exist and number must be valid");

    validate('skillsOther', function () {
        if (existsFromPost('skillsOtherCheckbox')) {
            return !empty(valueFromPost('skillsOther'));
        } else {
            return true;
        }
    }, "You must enter other skills if checked checkbox");

    beginValidates();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Location: ../../");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    validateRequests();

    $eoi = new EOI();

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

    if ($eoi->save()) {
        unset($_SESSION["old"]);
        unset($_SESSION["errors"]);
        $_SESSION["successfully"] = true;
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
}

