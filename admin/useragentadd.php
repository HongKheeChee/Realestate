

<?php
session_start();
require("config.php");
////code
 
if(!isset($_SESSION['auser']))
{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>LM Homes | Admin</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/datatables/select.bootstrap4.min.css">
		<link rel="stylesheet" href="assets/plugins/datatables/buttons.bootstrap4.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
		
		
			<!-- Header -->
				<?php include("header.php"); ?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Add Agent</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Add Agent</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add Agent Below</h4> <br>
									
									<?php 
										if(isset($_GET['msg']))	
										echo $_GET['msg'];	
									?>
								</div>
								<div class="card-body">

									


                                <?php 
                                    include("config.php");
                                    $error="";
                                    $msg="";
                                    if(isset($_REQUEST['reg']))
                                    {
                                        $name=$_REQUEST['name'];
                                        $email=$_REQUEST['email'];
                                        $phone=$_REQUEST['phone'];
                                        $pass=$_REQUEST['pass'];
                                        $utype=$_REQUEST['utype'];
                                        
                                        $uimage=$_FILES['uimage']['name'];
                                        $temp_name1 = $_FILES['uimage']['tmp_name'];
                                        $pass= sha1($pass);
                                        
                                        // Set 'utype' based on the radio button selection
                                        $utype = isset($_POST['utype']) ? $_POST['utype'] : 'user';
                                        
                                        $query = "SELECT * FROM user where uemail='$email'";
                                        $res=mysqli_query($con, $query);
                                        $num=mysqli_num_rows($res);
                                        
                                        if($num == 1)
                                        {
                                            $error = "<p class='alert alert-warning'>Email Id already Exist</p> ";
                                        }
                                        else
                                        {
                                            
                                            if(!empty($name) && !empty($email) && !empty($phone) && !empty($pass) && !empty($uimage))
                                            {
                                                
                                                $sql="INSERT INTO user (uname,uemail,uphone,upass,utype,uimage) VALUES ('$name','$email','$phone','$pass','$utype','$uimage')";
                                                $result=mysqli_query($con, $sql);
                                                move_uploaded_file($temp_name1,"../admin/user/$uimage");
                                                if($result){
                                                    $msg = "<p class='alert alert-success'>Register Successfully</p> ";
                                                }
                                                else{
                                                    $error = "<p class='alert alert-warning'>Register Not Successfully</p> ";
                                                }
                                            }else{
                                                $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
                                            }
                                        }
                                        
                                    }
                                ?>
                                <!DOCTYPE html>
                                <html lang="en">
                                <head>
                                <!-- Required meta tags -->
                                <meta charset="utf-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                                <!-- Meta Tags -->
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <link rel="shortcut icon" href="../images/favicon.ico">

                                <!--	Fonts
                                    ========================================================-->
                                <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
                                <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

                                <!--	Css Link
                                    ========================================================-->
                                <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
                                <link rel="stylesheet" type="text/css" href="../css/bootstrap-slider.css">
                                <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
                                <link rel="stylesheet" type="text/css" href="../css/layerslider.css">
                                <link rel="stylesheet" type="text/css" href="../css/color.css">
                                <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
                                <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
                                <link rel="stylesheet" type="text/css" href="../fonts/flaticon/flaticon.css">
                                <link rel="stylesheet" type="text/css" href="../css/style.css">
                                <link rel="stylesheet" type="text/css" href="../css/login.css">

                                <!--	Title
                                    =========================================================-->
                                <title>Real Estate PHP</title>
                                </head>
                                <body>

                                <!--	Page Loader
                                =============================================================--> 
                                <div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
                                    <div class="d-flex justify-content-center y-middle position-relative">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    </div>
                                </div>

								
								<?php echo $error; ?><?php echo $msg; ?>
								<!-- Form -->
								<form method="post" enctype="multipart/form-data">
									<div class="form-group">
										<input type="text"  name="name" class="form-control" placeholder="New Agent Name*">
									</div>
									<div class="form-group">
										<input type="email"  name="email" class="form-control" placeholder="New Agent Email*">
									</div>
									<div class="form-group">
										<input type="text"  name="phone" class="form-control" placeholder="New Agent Phone*" maxlength="10">
									</div>
									<div class="form-group">
										<input type="password" name="pass"  class="form-control" placeholder="New Agent Password*">
									</div>

									 <div class="form-check-inline">
									  <label class="form-check-label">
										
									  </label>
									</div>
									<div class="form-check-inline">
									  <label class="form-check-label">
										<input type="radio" class="form-check-input" name="utype" value="agent"checked>Agent
									  </label>
									</div>
									
									
									<div class="form-group">
										<label class="col-form-label"><b>User Image</b></label>
										<input class="form-control" name="uimage" type="file">
									</div>
									
									<button class="btn btn-success" name="reg" value="Register" type="submit">Register</button>
									
								</form>
								
								
								
								<!-- Social Login -->
								<!-- <div class="social-login">
									<span>Register with</span>
									<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
									<a href="#" class="google"><i class="fab fa-google"></i></a>
									<a href="#" class="facebook"><i class="fab fa-twitter"></i></a>
									<a href="#" class="google"><i class="fab fa-instagram"></i></a>
								</div> -->
								<!-- /Social Login -->
								
								
								
							
                
	<!--	login  -->
        
       
		<!--	Footer   start-->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div>
<!-- Wrapper End --> 

<!--	Js Link
============================================================--> 
<script src="../js/jquery.min.js"></script> 
<!--jQuery Layer Slider --> 
<script src="../js/greensock.js"></script> 
<script src="../js/layerslider.transitions.js"></script> 
<script src="../js/layerslider.kreaturamedia.jquery.js"></script> 
<!--jQuery Layer Slider --> 
<script src="../js/popper.min.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/owl.carousel.min.js"></script> 
<script src="../js/tmpl.js"></script> 
<script src="../js/jquery.dependClass-0.1.js"></script> 
<script src="../js/draggable-0.1.js"></script> 
<script src="../js/jquery.slider.js"></script> 
<script src="../js/wow.js"></script> 
<script src="../js/custom.js"></script>
</body>
</html>



		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
		<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
		
		<script src="assets/plugins/datatables/dataTables.select.min.js"></script>
		
		<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
		<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
		<script src="assets/plugins/datatables/buttons.flash.min.js"></script>
		<script src="assets/plugins/datatables/buttons.print.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>
</html>
