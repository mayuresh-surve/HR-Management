<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/footer.css">
</head>
<body>
    <nav id="top">
        <div class="container">
            <div class="nav-header">
                <a href="#">
                    <img src="img/logo.png" alt="logo">
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
                            <a class="rgstr parallelogram active" href="register.php">
                                <div class="text">Register</div>
                            </a>
                        </li>
                    <?php endif ?>
                    <li class="login">
                        <a class="rgstr parallelogram" href="details.php">
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
        <!--Introduction-->
        <div class="row">
            <div class="column1 contentText">
                <h1 class="centerText">5 Minutes Deployment!</h1>
                <p>Complete HRM software to use in 5 Minutes.</p>
            </div>
        </div>
        <!--Registration Form-->
        <div class="row">
            <div class="column2">
                <div class="column21 registrationImage">
                    <img class="imageResponsive" src="img/registration-image.png">
                </div>
            </div>
            <div class="column2 registerBox" onmouseover="loginBoxHandler()">
                <h1 class="registerHeader">Register</h1>
                <form action="register.php" method="post">
                    <?php include('errors.php') ?>
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="First name*" name="firstname" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Last name*" name="lastname" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Email*" name="email" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username*" name="username" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                            <i class="fas fa-unlock"></i>
                            <input type="password" placeholder="Password*" name="password_1" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Confirm Password*"name="password_2" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                            <i class="fas fa-phone"></i>
                            <input type="tel" placeholder="Phone number*" name="phone_no" autocomplete="off" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-building"></i>
                        <input list="company" placeholder="Company Name* " name="cid" autocomplete="off" required>
                        <datalist id="company">
                            <?php
                            $query = "SELECT * FROM company";
                            $results = mysqli_query($db, $query);
                            while($row1 = mysqli_fetch_array($results)):; ?>
                                <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
                            <?php endwhile;?>
                        </datalist>
                    </div>
                    <button type="submit" class="btn" name="register_user">Sign up</button>
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