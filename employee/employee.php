<?php include('server.php');
if(isset($_SESSION['username']) == FALSE){
    $_SESSION['msg'] = "You must log in 1st to view this page";
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRMWorkForce</title>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/employee.css">
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
    <section class="container btm-marg60">
        <div class="row">
            <div class="column2 empForm">
                <h1 class="registerHeader">New Employee</h1>
                <form action="employee.php" method="post">
                    <?php include('errors.php') ?>
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Full name*" name="fullname" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email*" name="email" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-phone"></i>
                        <input type="tel" placeholder="Phone number*" name="phone_no" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-map-marker-alt"></i>   
                        <input type="text" placeholder="Address*" name="address" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-university"></i>
                        <input type="text" placeholder="Qualification*" name="qualification" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="date" value="2018-12-06" name="dob" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-venus-mars"></i>
                        <input list="gender" placeholder="Gender*" name="gender" required>
                        <datalist id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </datalist>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-building"></i>
                        <input list="department" placeholder="Department*" name="department" required>
                        <datalist id="department">
                        <?php
                            $query = "SELECT * FROM department";
                            $results = mysqli_query($db, $query);
                            while($row1 = mysqli_fetch_array($results)):; ?>
                                <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
                            <?php endwhile;?>
                        </datalist>
                    </div>
                    <button type="submit" class="btn" name="add_employee">Add Employee</button>
                </form>
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