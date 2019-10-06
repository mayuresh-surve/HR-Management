<?php

session_start();

if(isset($_SESSION['username']) == FALSE){
    $_SESSION['msg'] = "You must log in 1st to view this page";
    header("location: login.php");
};

if(isset($_GET['logout']) == TRUE){
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['cname']);
    unset($_SESSION['cid']);    
    header("location: login.php");
}
$db = mysqli_connect('localhost: 3307', 'root', '', 'employee') or die("Could not connect to database");
$cid = $_SESSION['cid'];
$query = "SELECT * FROM emp WHERE com_id=$cid";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRMWorkForce</title>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/detail.css">
    <link rel="stylesheet" href="style/footer.css">
</head>
<body>
    <?php if(isset($_SESSION['success']) == TRUE): ?>
    <?php endif ?>
    <!--Navbar starts-->
    <nav id="top">
        <div class="container">
            <div class="nav-header">
                <a class="nav-logo" href="#">
                    <img class="img-responsive" src="img/logo.png" alt="logo">
                </a>
            </div>
            <div id="myNavbar" class="navbar-collapse collapse">
                <ul class="nav-right nav navbar-nav">
                    <li class="home">
                        <a class="rgstr parallelogram" href="#">
                            <div class="text">Home</div>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['username']) == FALSE) : ?>
                        <li class="register">
                            <a class="rgstr parallelogram" href="register.php">
                                <div class="text">Register</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <li class="login">
                        <a class="rgstr parallelogram active" href="details.php">
                            <div class="text">
                                <?php if(isset($_SESSION['username']) == TRUE) : ?>
                                    Welcome <strong><?php echo $_SESSION['username']; ?></strong>
                                <?php else: ?>
                                    Login
                                <?php endif ?>
                            </div>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['username']) == TRUE) : ?>
                        <li class="logout">
                            <a class="rgstr parallelogram" href="details.php?logout='TRUE'">
                                <div class="text">Logout</div>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--Introduction-->
    <section class="container btm-marg60">
        <div class="row">
            <div class="column1 contentText">
                <h1 class="centerText">Welcome to <strong><?php echo $_SESSION['cname']; ?></strong> </h1>
                <p>Control your Emoloyee Workforce at single location.</p>
            </div>
        </div>
        <div class="row">
            <div class="column1 addButton">
                <button class="add-button" name="add_new_emp" onclick="window.location.href='employee.php'">Update Employee</button>
            </div>
        </div>
        <?php if(isset($_SESSION['msg']) == TRUE):; ?>
        <div class="row">
            <div class="column1 centerText">
                <p class="action_msg"><?php echo $_SESSION['msg']; ?></p>
                <?php unset($_SESSION['msg']); ?>
            </div>
        </div>
        <?php endif ?>
        <div class="row">
            <div class="column1 emp-table">
                <table align="center">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                    <?php while($rows=mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><a href="editemp.php?var=<?php echo $rows['e_id']?>"><?php echo $rows['e_name'] ?></a></td>
                        <td><?php echo $rows['email'] ?></td>
                        <td><?php echo $rows['phone_no'] ?></td>
                        <td><?php echo $rows['gender'] ?></td>
                        <td><button class="del-button" name="add_new_emp" onclick="window.location.href='server.php?del=<?php echo $rows['e_id'];?>'">Delete</button></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </section>
    <!--footer starts-->
    <footer>
        <div class="footer-main" style="background-image: url(img/footer.jpg); background-size: cover">
            <section class="footer-info">
                <div class="container">
                    <div class="row upper-footer">
                        <div class="links">
                            <div class="footer-col">
                                <h3>About us</h3>
                                <div class="footer-center-text">
                                    <p class="footer-about">
                                        PHRM was built to serve the employee 
                                        scheduling and communication needs of
                                        businesses across a wide range of 
                                        industries.We make managing sales force 
                                        easy for all industries having sales 
                                        team on field such as Corporate,MNC’s, 
                                        Healthcare organizations, Telecom, Logistics, Technology, Event and many, 
                                        many other types of businesses.We can 
                                        help make employee management, communication,  
                                        and collaboration easier for you and your team.
                                    </p>
                                </div>
                            </div>
                            <div class="footer-col">
                                <h3>Follow Us On</h3>
                                <div class="social-link">
                                    <a class="social-btn" href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a class="social-btn" href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a class="social-btn" href="#">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a class="social-btn" href="#">
                                        <i class="fab fa-youtube"></i>
                                    </a>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row lower-footer">
                        <div class="copyright">
                            <p>© HRMWorkForce All rights reserved</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </footer>
    <script src="JS/general.js"></script>
</body>
</html>