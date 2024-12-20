<?php

require 'dbcon.php';

if (isset($_POST['signUp'])) {

    $email = $_POST['email'];
    $emailAlreadyExists = CheckEmail($con, $email);
    $firstpass = $_POST['password'];
    $confirmpass = $_POST['confirm_password'];

    if ($emailAlreadyExists) {
        header("Location: ../adminside/register.php?error=Email Address Already Exists");
        exit();

    } else if ($firstpass != $confirmpass) {
        header("Location: ../adminside/register.php?error=Password does not match");
        exit();

    } else {
        $firstName = ucwords(strtolower($_POST['first_name']));
        $lastName = ucwords(strtolower($_POST['last_name']));
        $sex = ucwords(strtolower($_POST['sex']));
        $bday = $_POST['dob'];
        $contactnum = $_POST['mobile'];
        $account_status = "Active";
        $mem_status = 1; //unidentified
        $password = $firstpass;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // $query = "INSERT INTO user_credentials (email, password) VALUES (?, ?)";
        // $stmt = $con->prepare($query);
        // $stmt->bind_param("ss", $email, $hashedPassword);
        // $stmt->execute();

        //checks type converts to id
        $val_custype = $_POST['type'];
        if ($val_custype == "student") {
            $customertype_id = 1;
        } else if ($val_custype == "non_student") {
            $customertype_id = 2;
        } else {
            $customertype_id = 0;
        }

        //check for student number if student
        if ($customertype_id == 1) {
            $studentnum = $_POST['student_number'];
        } else {
            $studentnum = "-";
        }

        $custype_verif_id = 1; //pending
        $uid = (TableRowCount("user_information", $con)) + 1;
        $ucredid = (TableRowCount("user_credentials", $con)) + 1;

        $registerquery = "INSERT INTO user_information(userinfo_id, firstname, lastname, sex, bday, student_number, contact_number,email,account_status,memstatus_id,customertype_id,custype_verif_id,account_created)
        VALUES(" . $uid . ",'" . $firstName . "','" . $lastName . "','" . $sex . "','" . $bday . "','" . $studentnum . "','" . $contactnum . "','" . $email . "','" . $account_status . "'," . $mem_status . "," . $customertype_id . "," . $custype_verif_id . ", NOW());";

        $credquery = "INSERT INTO user_credentials(usercred_id, email,password,userinfo_id) VALUES(" . $ucredid . ", '" . $email . "','" . $hashedPassword . "'," . $uid . ");";

        $SuccessRegisterInfo = InsertRecord($registerquery, $con);
        $SuccessRegisterCred = InsertRecord($credquery, $con);

        if ($SuccessRegisterInfo && $SuccessRegisterCred) {
            echo 'Registered and Logged in!';
            // $_SESSION['uid'] = $uid;

            header("Location: ../adminside/index.php?error=Registration Complete! Sign In now!");
            exit();
        } else {
            header("Location: ../adminside/register.php?error=Registration Unsuccessful. Report issue with SSITE.");
            exit();
        }
    }
}

function TableRowCount(string $table, $con)
{
    $query = "SELECT COUNT(*) AS total FROM " . $table;
    $count = 0;

    if ($results = mysqli_query($con, $query)) {
        $row = mysqli_fetch_assoc($results);
        $count = $row['total'];
    }

    return $count;
}

function InsertRecord($query, $con)
{
    if (mysqli_query($con, $query)) {
        echo "New record created successfully";
        return true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
        return false;
    }
}

function CheckEmail($con, $email)
{
    $check_email = "SELECT * FROM user_information WHERE email='$email' AND account_status = 'Active'";
    $results = $con->query($check_email);
    if ($results->num_rows > 0) {
        echo "Email Address already Exists";
        return true;
    } else {
        return false;
    }
    // return False;
}
