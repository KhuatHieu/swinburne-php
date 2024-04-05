<?php

namespace models;

require_once __DIR__ . '/../db/db.php';

class EOI
{
    public int $eoiNumber;
    public string $status;
    public string $jobRefNumber;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $fullName;
    public ?string $dateOfBirth;
    public ?int $gender;
    public ?string $street;
    public ?string $suburb;
    public ?string $state;
    public ?string $postcode;
    public ?string $email;
    public ?string $phoneNumber;
    public string $skillsCriticalThinking;
    public string $skillsProblemSolving;
    public string $skillsLeadership;
    public string $skillsAdaptability;
    public string $skillsCreativity;
    public string $skillsTimeManagement;
    public ?string $skillsOther;

    private static function newFromRow($row): EOI
    {
        $eoi = new self();

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

    public static function find($eoiNumber): ?EOI
    {
        $mysqli = getMysqli();
        $eoi = null;

        $query = "SELECT * FROM eoi WHERE eoi_number = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $eoiNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $eoi = self::newFromRow($row);
        }

        return $eoi;
    }

    public static function where(array $conditions)
    {
        $mysqli = getMysqli();

        $whereClause = '';
        foreach ($conditions as $key => $value) {
            if (!empty($value)) {
                if ($whereClause !== '') {
                    $whereClause .= " AND ";
                }
                $whereClause .= "$key LIKE '%$value%'";
            }
        }

        $query = "SELECT * FROM eoi";
        if ($whereClause !== '') {
            $query .= " WHERE $whereClause";
        }

        $result = $mysqli->query($query);

        $eoiModels = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eoiModels[] = self::newFromRow($row);
            }
        }

        return $eoiModels;
    }

    public function save(): bool
    {
        if (empty($this->eoiNumber)) {
            $sql = "INSERT INTO eoi (job_ref_number, first_name, last_name, date_of_birth, gender, street, suburb, state, postcode, email, phone_number, skills_critical_thinking, skills_problem_solving, skills_leadership, skills_adaptability, skills_creativity, skills_time_management, skills_other) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $mysqli = getMysqli();
            $statement = $mysqli->prepare($sql);

            $statement->bind_param("ssssssssssssssssss",
                $this->jobRefNumber, $this->firstName, $this->lastName, $this->dateOfBirth, $this->gender, $this->street, $this->suburb, $this->state, $this->postcode, $this->email, $this->phoneNumber, $this->skillsCriticalThinking, $this->skillsProblemSolving, $this->skillsLeadership, $this->skillsAdaptability, $this->skillsCreativity, $this->skillsTimeManagement, $this->skillsOther);
        } else {
            $sql = "UPDATE eoi 
                    SET status = ?, job_ref_number = ?, first_name = ?, last_name = ?, date_of_birth = ?, gender = ?, street = ?, suburb = ?, state = ?, postcode = ?, email = ?, phone_number = ?, skills_critical_thinking = ?, skills_problem_solving = ?, skills_leadership = ?, skills_adaptability = ?, skills_creativity = ?, skills_time_management = ?, skills_other = ? 
                    WHERE eoi_number = ?";

            $mysqli = getMysqli();
            $statement = $mysqli->prepare($sql);

            $statement->bind_param("sssssssssssssssssssi",
                $this->status, $this->jobRefNumber, $this->firstName, $this->lastName, $this->dateOfBirth, $this->gender, $this->street, $this->suburb, $this->state, $this->postcode, $this->email, $this->phoneNumber, $this->skillsCriticalThinking, $this->skillsProblemSolving, $this->skillsLeadership, $this->skillsAdaptability, $this->skillsCreativity, $this->skillsTimeManagement, $this->skillsOther,
                $this->eoiNumber);
        }

        return $statement->execute();
    }

    public function delete(): bool
    {
        $sql = "DELETE FROM eoi WHERE eoi_number = ?";

        $mysqli = getMysqli();
        $statement = $mysqli->prepare($sql);

        $statement->bind_param("s", $this->eoiNumber);

        return $statement->execute();
    }
}
