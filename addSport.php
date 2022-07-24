<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{


$SportName=$_POST['SportName'];
$Players=$_POST['players'];
$Hours=$_POST['hours'];
$CreationDate= date('y-m-d');
$Description=$_POST['description'];
;
	
$sql="INSERT INTO tblbrands(SportName,CreationDate,Players,Hours,Description) VALUES(:SportName,:CreationDate,:Players,:Hours,:Description)";

$query = $dbh->prepare($sql);
$query->bindParam(':SportName',$SportName,PDO::PARAM_STR);
$query->bindParam(':Players',$Players,PDO::PARAM_STR);
$query->bindParam(':Hours',$Hours,PDO::PARAM_STR);
$query->bindParam(':Description',$Description,PDO::PARAM_STR);
$query->bindParam(':CreationDate',$CreationDate,PDO::PARAM_STR);

$query->execute();

$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Sport Added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>EUSports  | Create Sport</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	
	<link rel="stylesheet" href="css/fileinput.min.css">

	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Add New Sport</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Sport Details</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();" enctype="multipart/form-data">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Sport Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="SportName" id="SportName" required>
												</div>
											</div>
										
											<div class="form-group">
												<label class="col-sm-4 control-label">Involved Players</label>
												<div class="col-sm-8">
													<input type="number" class="form-control" name="players" id="players" required min="1">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Description</label>
												<div class="col-sm-8">
													<input type="textarea" class="form-control" name="description" id="description" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">PlayTime Hours</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="hours" id="hours" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
										<!-- 	
										<div class="form-group">
<div class="col-sm-12">
<h4><b>Upload Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Image 2<span style="color:red">*</span><input type="file" name="img2" required>
</div>
</div>
		 -->						
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Add Sport</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<?php } ?>