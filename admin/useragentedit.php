<?php 
session_start();
require("config.php");

if (!isset($_SESSION['auser'])) {
    header("location:index.php");
}

$msg = "";

if (isset($_POST['update'])) {
    $uid = $_GET['id'];
    $newUtype = $_POST['utype'];

    $sql = "UPDATE user SET utype = '{$newUtype}' WHERE uid = {$uid}";
    $result = mysqli_query($con, $sql);

    if ($result == true) {
        $msg = "<p class='alert alert-success'>Agent Change To User Successfully</p>";
        header("Location:useragent.php?msg=$msg");
        exit();
    } else {
        $msg = "<p class='alert alert-warning'>Not Updated</p>";
        header("Location:useragent.php?msg=$msg");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Real Estate</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
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
								<h3 class="page-title">Agent</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Agent</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h2 class="card-title">Change User Type</h2>
								</div>
								<?php 
								if (isset($_GET['id'])) {
                                    $uid = $_GET['id'];
                                    $sql = "SELECT * FROM user WHERE uid = {$uid}";
                                    $result = mysqli_query($con, $sql);
                                
                                    if ($row = mysqli_fetch_row($result)) {
                                        // Display the form for updating user information
                                        ?>
                                        <!DOCTYPE html>
                                        <html lang="en">
                                        <head>
                                            <!-- Include your head content here -->
                                        </head>
                                        <body>
                                            <form method="post">
								<div class="card-body">
										<div class="row">
											<div class="col-xl-12">
												<h5 class="card-title">Change User Type</h5>
												
												<?php echo $msg; ?>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">User Id</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="fid" value="<?php echo $row['0']; ?>" disabled>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">User type</label>
													<div class="col-lg-9">
                                                        <select class="form-control" name="utype" required="">
                                                            <option value="user" <?php echo ($row['5'] === 'user') ? 'selected' : ''; ?>>User</option>
                                                            <option value="agent" <?php echo ($row['5'] === 'agent') ? 'selected' : ''; ?>>Agent</option>
                                                        </select>
                                                        <small>Select the new utype.</small>
                                                    </div>
												</div>
												
											</div>
										</div>
										<div class="text-left">
											<input type="submit" class="btn btn-primary"  value="Submit" name="update" style="margin-left:200px;">
										</div>
									</form>
                                        </body>
                                        </html>
                                        <?php
                                    } else {
                                        $msg = "<p class='alert alert-warning'>User not found</p>";
                                        header("Location:useragent.php?msg=$msg");
                                        exit();
                                    }
                                } else {
                                    $msg = "<p class='alert alert-warning'>Invalid request</p>";
                                    header("Location:useragent.php?msg=$msg");
                                    exit();
                                }
                                
                                mysqli_close($con); ?>
								</div>
								
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
			<!-- /Page Wrapper -->
		<!-- /Main Wrapper -->
		<script src="assets/plugins/tinymce/tinymce.min.js"></script>
		<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
    </body>

</html>