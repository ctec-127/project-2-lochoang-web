<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Sticky Radio</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <?php

                require_once __DIR__ . "/../db/db_connect.inc.php";
                require_once __DIR__ . "/../functions/functions.inc.php";
                require_once __DIR__ . "/../app/config.inc.php";

                $error_bucket = [];
                $degree_program = null;


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // First insure that all required fields are filled in
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

                    // If we have no errors than we can try and insert the data
                    if (count($error_bucket) == 0) {
                        // Time for some SQL
                        $sql = "INSERT INTO $db_table (first_name,last_name,email,phone,student_id,gpa,degree_program)";
                        $sql .= "VALUES (:first,:last,:email,:phone,:student_id,:gpa,:degree_program)";

                        $stmt = $db->prepare($sql);
                        $stmt->execute(["first" => $first, "last" => $last, "email" => $email, "phone" => $phone, "student_id" => $student_id, "gpa" => $gpa, "degree_program" => $degree_program]);

                        if ($stmt->rowCount() == 0) {
                            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you.</div>';
                        } else {
                            header("Location: display-records.php?message=The record for $first has been created.");
                        }
                    } else {
                        display_error_bucket($error_bucket);
                    }
                }
                //Financial aid
                $financial_aid_yes = true;
                $financial_aid_no = false;

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>