<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<h2>Search Results</h2>';
    $sql = "SELECT * FROM $db_table WHERE ";

    $data = [];
    if (!empty($_POST["first"])) {
        array_push($data, "first_name LIKE {$db->quote($_POST["first"] . '%')}");
    }

    if (!empty($_POST["last"])) {
        array_push($data, "last_name LIKE {$db->quote($_POST["last"] . '%')}");
    }

    //Student id
    if (!empty($_POST["student_id"])) {
        array_push($data, "student_id = {$_POST["student_id"]}");
    }

    // GPA
    if (!empty($_POST["gpa"])) {
        array_push($data, "gpa = {$_POST["gpa"]}");
    }

    // Financial aid
    array_push($data, "financial_aid = {$_POST["financial_aid"]}");

    //degree program
    array_push($data, "degree_program = {$db->quote($_POST["degreeprogram"])}");

    $sql = $sql . implode(" and ", $data);
    echo $sql;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    display_record_table($results);
} else {
    echo '<div class="alert alert-info">';
    echo '<h2>Search results will appear here</h2>';
    // echo '/div';
}
