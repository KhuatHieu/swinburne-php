<?php

include 'helpers/request.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    die(404);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jobRefNumber = fromPost('jobRefNumber');
    $firstName = fromPost('firstName');
    $lastName = fromPost('lastName');
    $dateOfBirth = fromPost('dateOfBirth');
    $gender = fromPost('gender');
    $street = fromPost('street');
    $suburb = fromPost('suburb');
    $state = fromPost('state');
    $postcode = fromPost('postcode');
    $email = fromPost('email');
    $phoneNumber = fromPost('phoneNumber');
    $skillsCriticalThinking = fromPost('skillsCriticalThinking');
    $skillsProblemSolving = fromPost('skillsProblemSolving');
    $skillsLeadership = fromPost('skillsLeadership');
    $skillsAdaptability = fromPost('skillsAdaptability');
    $skillsCreativity = fromPost('skillsCreativity');
    $skillsTimeManagement = fromPost('skillsTimeManagement');
    $skillsOther = fromPost('skillsOther');

    $sql = "INSERT INTO eoi (job_ref_number, first_name, last_name, date_of_birth, gender, street, suburb, state, postcode, email, phone_number, skills_critical_thinking, skills_problem_solving, skills_leadership, skills_adaptability, skills_creativity, skills_time_management, skills_other) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $statement = getMysqli()->prepare($sql);

    $statement->bind_param("ssssssssssssssssss", $jobRefNumber, $firstName, $lastName, $dateOfBirth, $gender, $street, $suburb, $state, $postcode, $email, $phoneNumber, $skillsCriticalThinking, $skillsProblemSolving, $skillsLeadership, $skillsAdaptability, $skillsCreativity, $skillsTimeManagement, $skillsOther);

    $result = $statement->execute();

    $statement->close();
}
