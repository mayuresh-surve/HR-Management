<?php

session_start();

//initializing variables

$errors = array();

//connect to db

$db = mysqli_connect('localhost: 3307', 'root', '', 'employee') or die("Could not connect to database");

if(isset($_POST['register_user']) == TRUE){
    //registering a user
    if(isset($_POST['cid'])){$cid = mysqli_real_escape_string($db, $_POST['cid']);}
    if(isset($_POST['firstname'])){$firstname = mysqli_real_escape_string($db, $_POST['firstname']);}
    if(isset($_POST['lastname'])){$lastname = mysqli_real_escape_string($db, $_POST['lastname']);}
    if(isset($_POST['email'])){$email = mysqli_real_escape_string($db, $_POST['email']);}
    if(isset($_POST['username'])){$username = mysqli_real_escape_string($db, $_POST['username']);}
    if(isset($_POST['password_1'])){$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);}
    if(isset($_POST['password_2'])){$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);}
    if(isset($_POST['phone_no'])){$phoneno = mysqli_real_escape_string($db, $_POST['phone_no']);}

    //form validation

    if(empty($cid)){array_push($errors, "company name is required");}
    if(empty($firstname)){array_push($errors, "firstname is required");}
    if(empty($lastname)){array_push($errors, "lastname is required");}
    if(empty($email)){array_push($errors, "email is required");}
    if(empty($username)){array_push($errors, "username is required");}
    if(empty($password_1)){array_push($errors, "password is required");}
    if(empty($phoneno)){array_push($errors, "phoneno is required");}
    if((isset($_POST['password_1'])) and (isset($_POST['password_2'])))
    {
        if($password_1!=$password_2){array_push($errors, "Password do not match");}
    }

    //check db for existing email
    if(isset($_POST['email'])){
        $user_check_query = "SELECT * FROM auth WHERE email='$email' or username='$username' LIMIT 1";

        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if($user){
            if($user['email'] === $email){array_push($errors, "Email already taken");}
            if($user['username'] === $username){array_push($errors, "Username already taken");}
        }
    }

    //register a user if no errors

    if(count($errors) == 0){
        $password = md5($password_1); 
        $query = "INSERT INTO auth (com_id, first_name, last_name, email, username, password_1, phone_no) VALUES ('$cid','$firstname', '$lastname', '$email', '$username', '$password', '$phoneno')";
        mysqli_query($db, $query);
        $query1 = "SELECT c_name FROM company WHERE c_id = $cid";
        $results1 = mysqli_query($db, $query1);
        $row1 = mysqli_fetch_assoc($results1);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in!";
        $_SESSION['cname'] = $row1['c_name'];
        $_SESSION['cid'] = $cid;

        header('location: details.php');
    }
}

//login a user

if(isset($_POST['login_user']) == TRUE){
    $username_1 = mysqli_real_escape_string($db, $_POST['username']);
    $login_password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username_1)){array_push($errors, "Username is required");}
    if(empty($login_password)){array_push($errors, "Password is required");}

    if(count($errors) == 0){
        $login_password = md5($login_password);
        $query = "SELECT * FROM auth WHERE username='$username_1' AND password_1='$login_password'";
        $results = mysqli_query($db, $query);
        if(mysqli_num_rows($results)){
            $row = mysqli_fetch_assoc($results);
            $cname = $row['com_id'];
            $query1 = "SELECT c_name FROM company WHERE c_id = $cname";
            $results1 = mysqli_query($db, $query1);
            $row1 = mysqli_fetch_assoc($results1);
            $_SESSION['username'] = $username_1;
            $_SESSION['success'] = "Logged in successfully";
            $_SESSION['cname'] = $row1['c_name'];
            $_SESSION['cid'] = $cname;
            header("location: details.php");
        }
        else{
            array_push($errors, "Wrong username or password, Please try again");
        }
    }
}

//adding new employee
if(isset($_POST['add_employee']) == TRUE){
    //user input
    if(isset($_POST['fullname'])){$fullname = mysqli_real_escape_string($db, $_POST['fullname']);}
    if(isset($_POST['email'])){$email = mysqli_real_escape_string($db, $_POST['email']);}
    if(isset($_POST['phone_no'])){$phoneno = mysqli_real_escape_string($db, $_POST['phone_no']);}
    if(isset($_POST['address'])){$address = mysqli_real_escape_string($db, $_POST['address']);}
    if(isset($_POST['qualification'])){$qualification = mysqli_real_escape_string($db, $_POST['qualification']);}
    if(isset($_POST['dob'])){$dob = mysqli_real_escape_string($db, $_POST['dob']);}
    if(isset($_POST['gender'])){$gender = mysqli_real_escape_string($db, $_POST['gender']);}
    if(isset($_POST['department'])){$department = mysqli_real_escape_string($db, $_POST['department']);}
    $cid = $_SESSION['cid'];

    //check for empty box
    if(empty($fullname)){array_push($errors, "Full Name is required");}
    if(empty($email)){array_push($errors, "Email is required");}
    if(empty($phoneno)){array_push($errors, "Phone number is required");}
    if(empty($address)){array_push($errors, "Address is required");}
    if(empty($qualification)){array_push($errors, "Qualification is required");}
    if(empty($dob)){array_push($errors, "Birth Datae is required");}
    if(empty($gender)){array_push($errors, "Gender is required");}
    if(empty($department)){array_push($errors, "Department is required");}

    //adding new employee
    if(count($errors) == 0){
        $query = "INSERT INTO emp (com_id, dep_id, e_name, email, phone_no, address, qualification, dob, gender) VALUES ('$cid', '$department', '$fullname', '$email', '$phoneno', '$address', '$qualification', '$dob', '$gender')";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "Employee Added Successfully";
        header('location: details.php');
    }
}

//deleting an employee
if(isset($_GET['del']) == TRUE){
    $e_id = $_GET['del'];

    if(count($errors) == 0){
        $query = "DELETE FROM emp WHERE e_id=$e_id";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "Employee Deleted";
        header('location: details.php');
    }
}

//updating employee information
if(isset($_POST['update_employee']) == TRUE){
    //user input
    if(isset($_POST['fullname'])){$fullname = mysqli_real_escape_string($db, $_POST['fullname']);}
    if(isset($_POST['email'])){$email = mysqli_real_escape_string($db, $_POST['email']);}
    if(isset($_POST['phone_no'])){$phoneno = mysqli_real_escape_string($db, $_POST['phone_no']);}
    if(isset($_POST['address'])){$address = mysqli_real_escape_string($db, $_POST['address']);}
    if(isset($_POST['qualification'])){$qualification = mysqli_real_escape_string($db, $_POST['qualification']);}
    if(isset($_POST['dob'])){$dob = mysqli_real_escape_string($db, $_POST['dob']);}
    if(isset($_POST['gender'])){$gender = mysqli_real_escape_string($db, $_POST['gender']);}
    $e_id = $_GET['var'];

    //check for empty box
    if(empty($fullname)){array_push($errors, "Full Name is required");}
    if(empty($email)){array_push($errors, "Email is required");}
    if(empty($phoneno)){array_push($errors, "Phone number is required");}
    if(empty($address)){array_push($errors, "Address is required");}
    if(empty($qualification)){array_push($errors, "Qualification is required");}
    if(empty($dob)){array_push($errors, "Birth Datae is required");}
    if(empty($gender)){array_push($errors, "Gender is required");}

    //updating employee information
    if(count($errors) == 0){
        $query = "UPDATE emp SET e_name='$fullname',email='$email',phone_no='$phoneno',address='$address',qualification='$qualification',dob='$dob',gender='$gender' WHERE e_id=$e_id ";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "Employee Information Updated";
        header('location: details.php');
    }
}
?>