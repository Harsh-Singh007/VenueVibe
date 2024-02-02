<div class="header">
                <div class="container">
                    <div class="header-top-grids">
                    <div style="background-color:; padding: 20px; text-align: center; color: #fff; font-family: 'Arial', sans-serif; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h1 style="margin: 0; font-size: 36px; letter-spacing: 2px;">
        <a href="index.php" style="color: #fff; text-decoration: none; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">VenueVibe</a>
    </h1>
</div>

                        <div class="top-nav">
                            <nav class="navbar navbar-default">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                                    <nav>
                                        <ul class="nav navbar-nav">
                                            <li class="active"><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About</a></li>
                                            <li><a href="services.php">Services</a></li>
                                            <?php if (strlen($_SESSION['obbsuid']!=0)) {?>
                                            <li class=""><a href="#" class="dropdown-toggle hvr-bounce-to-bottom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="hvr-bounce-to-bottom" href="profile.php">Profile</a></li>
                                                    <li><a class="hvr-bounce-to-bottom" href="booking-history.php">Booking History</a></li>   
                                                     <li><a class="hvr-bounce-to-bottom" href="change-password.php">Change Password</a></li>
                                                    <li><a class="hvr-bounce-to-bottom" href="logout.php">Logout</a></li>        
                                                </ul>
                                            </li> <?php } ?> 

                                            <li><a href="mail.php">Mail Us</a></li>

                                        </ul>
                                    </nav>
                                </div>
                                <!-- /.navbar-collapse -->
                            </nav>
                        </div>
                        <br>
                        <?php if (strlen($_SESSION['obbsuid']==0)) {?>
                        <div class="collapse navbar-collapse nav-wil">
                            <ul style="color: white;">
                                <li style="color: white;"><a href="login.php">Login</a></li>
                                            <li style="color: white;"> <a href="signup.php">Register</a></li>
                                            <li><a href="admin/login.php">Admin</a></li>
                               <?php } ?>
                            </ul>

                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div> 