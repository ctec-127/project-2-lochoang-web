<?php
// First insure that all required fields are filled in
if (isset($_POST["ID"])) {
    $id = $_POST["id"];
}
//First insure that all required fields are filled in
if (empty($_POST["first"])) {
    array_push($error_bucket, "<p>A first name is required.</p>");
} else {
    $first = $_POST["first"];
}
if (empty($_POST["last"])) {
    array_push($error_bucket, "<p>A last name is required.</p>");
} else {
    $last = $_POST["last"];
}
if (empty($_POST["student_id"])) {
    array_push($error_bucket, "<p>A student ID is required.</p>");
} else {
    $student_id = intval($_POST["student_id"]);
}

$degree_program = $_POST["degreeprogram"];

$gpa = $_POST["gpa"];
if (empty($_POST["gpa"])) {
    $gpa = 0;
} else {
    $gpa = floatval($_POST["gpa"]);
}

if (empty($_POST["email"])) {
    array_push($error_bucket, "<p>An email address is required.</p>");
} else {
    $email = $_POST["email"];
}
if (empty($_POST["phone"])) {
    array_push($error_bucket, "<p>A phone number is required.</p>");
} else {
    $phone = $_POST["phone"];
}
//Financial aid
$financial_aid_yes = true;
$financial_aid_no = false;


if (isset($_POST["financial_aid"])) {
    if ($_POST["financial_aid"] == '1') {
        $financial_aid = $_POST["financial_aid"];
        $financial_aid_yes = true;
        $financial_aid_no = false;
    } else {
        $financial_aid = $_POST["financial_aid"];
        $financial_aid_yes = false;
        $financial_aid_no = true;
    }
} else {
    echo '<div class="alert alert-warning">Please select a value for Financial Aid</div>';
}
