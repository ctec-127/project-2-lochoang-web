<?php // Filename: form.inc.php 
?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->

<?php
// Button label logic
if (basename($_SERVER['PHP_SELF']) == 'create-record.php') {
    $button_label = "Save New Record";
} else if (basename($_SERVER['PHP_SELF']) == 'update-record.php') {
    $button_label = "Save Updated Record";
} else if (basename($_SERVER['PHP_SELF']) == 'advanced-search.php') {
    $button_label = "Search...";
}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label class="col-form-label" for="first">First Name</label>
    <input class="form-control" type="text" id="first" name="first" value="<?= isset($first) ? $first : null ?>">
    <br>
    <label class="col-form-label" for="last">Last Name</label>
    <input class="form-control" type="text" id="last" name="last" value="<?= isset($last) ? $last : null ?>">
    <br>
    <label class="col-form-label" for="id">Student ID</label>
    <input class="form-control" type="number" id="id" name="student_id" value="<?= isset($student_id) ? $student_id : null ?>">
    <br>

    <!-- //Degree Program -->
    <label class="col-form-label" for="degreeprogram">Degree Program</label>
    <select class="form-select" aria-label="Default select" id="degreeprogram" name="degreeprogram">
        <option value="Undeclared" <?= $degree_program == "Undeclared" ? "selected" : null ?>>Undeclared </option>
        <option value="AAT Web Development" <?= $degree_program == "AAT Web Development" ? "selected" : null ?>>AAT Web Development </option>
        <option value="AAT Digital Media Arts" <?= $degree_program == "AAT Digital Media Arts" ? "selected" : null ?>>AAT Digital Media Arts </option>
        <option value="BAS Cybersecutity" <?= $degree_program == "BAS Cybersecutity" ? "selected" : null ?>>BAS Cybersecutity </option>
        <option value="ATT Automotive" <?= $degree_program == "ATT Automotive" ? "selected" : null ?>>ATT Automotive </option>
        <option value="AAT Welding Tehcnologies" <?= $degree_program == "AAT Welding Tehcnologies" ? "selected" : null ?>>AAT Welding Tehcnologies </option>
    </select>
    <br>
    <!-- //GPA, Email, Phone -->
    <label class="col-form-label" for="gpa">GPA</label>
    <input class="form-control" type="number" id="gpa" name="gpa" min="0" max="4" step="0.01" value="<?= isset($gpa) ? $gpa : null ?>">
    <br>
    <label class="col-form-label" for="email">Email</label>
    <input class="form-control" type="text" id="email" name="email" value="<?= isset($email) ? $email : null ?>">
    <br>
    <label class="col-form-label" for="phone">Phone</label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?= isset($phone) ? $phone : null ?>">
    <br>
    <br>
    <!-- //graduation -->
    <label class="col-form-label" for="graduation_date">Graduation Date</label>
    <input class="form-control" id="graduation_date" type="date" name="graduation_date" value="<?= isset($graduation_date) ? $graduation_date : null ?>">
    <br>
    <br>
    <!-- //Financial Aid -->
    <p>Financial Aid</p>
    <div class="for-check">
        <input class="form-check-input" type="radio" name="financial_aid" value="1" id="fin_aid_yes" <?= $financial_aid_yes ? 'checked' : null ?>>
        <label class="form-check-label" for="fin_aid_yes">
            Yes
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="financial_aid" value="0" id="fin_aid_no" <?= $financial_aid_no ? 'checked' : null ?>>
        <label class="form-check-label" for="fin_aid_no">
            No
        </label>
    </div>

    <br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;

    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
    <input type="hidden" name="id" value="<?= isset($id) ? $id : null  ?>">
    <br>






</form>