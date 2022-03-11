<?php

require_once __DIR__ . "/../db/db_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "inc/shared/form_check.inc.php";

    $id = $_POST["id"];

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        $sql = "UPDATE $db_table SET first_name = :first, last_name = :last, emaiL = :email, phone=:phone, gpa = :gpa, degree_program = :degree_program, financial_aid = :financial_aid, graduation_date = :graduation_date";
        $sql .= " WHERE id = :id LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute(["first" => $first, "last" => $last, "email" => $email, "phone" => $phone, "gpa" => $gpa, "degree_program" => $degree_program, "financial_aid" => $financial_aid, "id" => $id, "graduation_date" => $graduation_date]);

        if ($stmt->rowCount() <= 1) {
            header("Location: display-records.php?message=The record for $first has been created.");
        }
    } else {
        display_error_bucket($error_bucket);
    }
}


$sql = "SELECT * FROM $db_table WHERE ID=:id";

$stmt = $db->prepare($sql);
$stmt->execute(["id" => $id]);

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    $first = $row->first_name;
    $last = $row->last_name;
    $degree_program = $row->degree_program;
    $student_id = $row->student_id;
    $gpa = $row->gpa;
    $email = $row->email;
    $phone = $row->phone;
    $graduation_date = $row->graduation_date;
    // Get the value 1 or 0 for Financial Aid
    $financial_aid = $row->financial_aid;
    if ($financial_aid == 1) {

        $financial_aid_yes = true;
        $financial_aid_no = false;
    } elseif ($financial_aid == 0) {

        $financial_aid_yes = false;
        $financial_aid_no = true;
    }
}
