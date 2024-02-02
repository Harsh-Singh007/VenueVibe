<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $uid=$_SESSION['obbsuid'];
    $AName=$_POST['fname'];
    $mobno=$_POST['mobno']; 
 
  $sql="update tbluser set FullName=:name,MobileNumber=:mobno where ID=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$AName,PDO::PARAM_STR);
     $query->bindParam(':mobno',$mobno,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

        echo '<script>alert("Profile has been updated")</script>';
echo "<script>window.location.href ='profile.php'</script>";

     

  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Banquet Booking System | User Profile</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 


</head>
<body>
	<!-- banner -->
	<div class="banner jarallax">
		<div class="agileinfo-dot">
			<?php include_once('includes/header.php');?>
			<div class="wthree-heading">
				<h2>Profile</h2>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- contact -->
	<div class="contact">
		<div class="container">
			<div class="agile-contact-form">
				
				<div class="col-md-6 contact-form-right">
					<div class="contact-form-top">
						<h3>User Profile </h3>
					</div>
					<div class="agileinfo-contact-form-grid">
						<form method="post">
							 <?php
$uid=$_SESSION['obbsuid'];
$sql="SELECT * from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?><div class="form-group row">
                                                <label class="col-form-label col-md-4">Full Name:</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php  echo $row->FullName;?>" name="fname" required="true" class="form-control" >
                                    </div></div>
                                                <div class="form-group row">
                                    <label class="col-form-label col-md-4">Mobile Number</label>
                                    <div class="col-md-12">
                                        <input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+" value="<?php  echo $row->MobileNumber;?>">
                                    </div>
                                </div>
                                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4">Email Address</label>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control" value="<?php  echo $row->Email;?>" name="email" required="true" readonly title="Email can't be edit">
                                    </div>
                                </div>
                                                <div class="form-group row">
                                    <label class="col-form-label col-md-4">Registration Date</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php  echo $row->RegDate;?>" class="form-control" name="password" readonly="true">
                                    </div>
                                </div><?php $cnt=$cnt+1;}} ?>
                                              <br>
                                                <div class="tp">
                                                    
                                                     <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                                </div>
                                            </form>

					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
			
		
		</div>
	</div>
	<!-- //contact -->
	<?php include_once('includes/footer.php');?>
	<!-- jarallax -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/modernizr.custom.js"></script>

</body>	
</html><?php }  ?>