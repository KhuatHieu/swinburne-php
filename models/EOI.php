<?php

namespace models;

// Include database connection
require_once __DIR__ . '/../db/db.php';

class EOI
{
    public $eoiNumber;
    public $status;
    public $jobRefNumber;
    public $firstName;
    public $lastName;
    public $fullName;
    public $dateOfBirth;
    public $gender;
    public $street;
    public $suburb;
    public $state;
    public $postcode;
    public $email;
    public $phoneNumber;
    public $skillsCriticalThinking;
    public $skillsProblemSolving;
    public $skillsLeadership;
    public $skillsAdaptability;
    public $skillsCreativity;
    public $skillsTimeManagement;
    public $skillsOther;

    // Create a new EOI instance from a database row
    private static function newFromRow($row)
    {
        $eoi = new self();

        // Set EOI object properties from database row
        $eoi->eoiNumber = $row['eoi_number'];
        $eoi->status = $row['status'];
        $eoi->jobRefNumber = $row['job_ref_number'];
        $eoi->firstName = $row['first_name'];
        $eoi->lastName = $row['last_name'];
        $eoi->fullName = $eoi->firstName . ' ' . $eoi->lastName;
        $eoi->dateOfBirth = $row['date_of_birth'];
        $eoi->gender = $row['gender'];
        $eoi->street = $row['street'];
        $eoi->suburb = $row['suburb'];
        $eoi->state = $row['state'];
        $eoi->postcode = $row['postcode'];
        $eoi->email = $row['email'];
        $eoi->phoneNumber = $row['phone_number'];
        $eoi->skillsCriticalThinking = $row['skills_critical_thinking'];
        $eoi->skillsProblemSolving = $row['skills_problem_solving'];
        $eoi->skillsLeadership = $row['skills_leadership'];
        $eoi->skillsAdaptability = $row['skills_adaptability'];
        $eoi->skillsCreativity = $row['skills_creativity'];
        $eoi->skillsTimeManagement = $row['skills_time_management'];
        $eoi->skillsOther = $row['skills_other'];

        return $eoi;
    }

    // Find an EOI by its number
    public static function find($eoiNumber)
    {
        $mysqli = getMysqli();
        $eoi = null;

        // Prepare and execute SELECT query to find EOI by number
        $query = "SELECT * FROM eoi WHERE eoi_number = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $eoiNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        // If EOI found, create and return EOI object
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $eoi = self::newFromRow($row);
        }

        return $eoi;
    }

    // Find EOIs based on conditions
    public static function where(array $conditions)
    {
        $mysqli = getMysqli();

        // Construct WHERE clause based on conditions
        $whereClause = '';
        foreach ($conditions as $key => $value) {
            if (!empty($value)) {
                if ($whereClause !== '') {
                    $whereClause .= " AND ";
                }
                $whereClause .= "$key LIKE '%$value%'";
            }
        }

        // Construct and execute SELECT query
        $query = "SELECT * FROM eoi";
        if ($whereClause !== '') {
            $query .= " WHERE $whereClause";
        }
        $result = $mysqli->query($query);

        // Create and return array of EOI objects from query results
        $eoiModels = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eoiModels[] = self::newFromRow($row);
            }
        }

        return $eoiModels;
    }

    // Save the EOI object to the database
    public function save()
    {
        // Determine whether to perform an INSERT or UPDATE operation based on presence of eoiNumber
        if (empty($this->eoiNumber)) {
            // Prepare INSERT query
            $sql = "INSERT INTO eoi (job_ref_number, first_name, last_name, date_of_birth, gender, street, suburb, state, postcode, email, phone_number, skills_critical_thinking, skills_problem_solving, skills_leadership, skills_adaptability, skills_creativity, skills_time_management, skills_other) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Establish database connection and prepare statement
            $mysqli = getMysqli();
            $statement = $mysqli->prepare($sql);

            // Bind parameters and execute statement for INSERT
            $statement->bind_param("ssssssssssssssssss",
                $this->jobRefNumber, $this->firstName, $this->lastName, $this->dateOfBirth, $this->gender, $this->street, $this->suburb, $this->state, $this->postcode, $this->email, $this->phoneNumber, $this->skillsCriticalThinking, $this->skillsProblemSolving, $this->skillsLeadership, $this->skillsAdaptability, $this->skillsCreativity, $this->skillsTimeManagement, $this->skillsOther);
        } else {
            // Prepare UPDATE query
            $sql = "UPDATE eoi 
                    SET status = ?, job_ref_number = ?, first_name = ?, last_name = ?, date_of_birth = ?, gender = ?, street = ?, suburb = ?, state = ?, postcode = ?, email = ?, phone_number = ?, skills_critical_thinking = ?, skills_problem_solving = ?, skills_leadership = ?, skills_adaptability = ?, skills_creativity = ?, skills_time_management = ?, skills_other = ? 
                    WHERE eoi_number = ?";

            // Establish database connection and prepare statement
            $mysqli = getMysqli();
            $statement = $mysqli->prepare($sql);

            // Bind parameters and execute statement for UPDATE
            $statement->bind_param("sssssssssssssssssssi",
                $this->status, $this->jobRefNumber, $this->firstName, $this->lastName, $this->dateOfBirth, $this->gender, $this->street, $this->suburb, $this->state, $this->postcode, $this->email, $this->phoneNumber, $this->skillsCriticalThinking, $this->skillsProblemSolving, $this->skillsLeadership, $this->skillsAdaptability, $this->skillsCreativity, $this->skillsTimeManagement, $this->skillsOther,
                $this->eoiNumber);
        }

        // Execute statement and return operation result
        return $statement->execute();
    }

    // Delete the EOI from the database
    public function delete()
    {
        // Prepare DELETE query
        $sql = "DELETE FROM eoi WHERE eoi_number = ?";

        // Establish database connection and prepare statement
        $mysqli = getMysqli();
        $statement = $mysqli->prepare($sql);

        // Bind parameters and execute statement for DELETE
        $statement->bind_param("i", $this->eoiNumber);

        // Execute statement and return operation result
        return $statement->execute();
    }

    // Delete multiple EOIs by job reference number
    public static function deleteBatchByJobRefNum($jobRefNum)
    {
        // Prepare DELETE query
        $sql = "DELETE FROM eoi WHERE job_ref_number = ?";

        // Establish database connection and prepare statement
        $mysqli = getMysqli();
        $statement = $mysqli->prepare($sql);

        // Bind parameters and execute statement for DELETE
        $statement->bind_param("s", $jobRefNum);

        // Execute statement and return operation result
        return $statement->execute();
    }
}
?>
