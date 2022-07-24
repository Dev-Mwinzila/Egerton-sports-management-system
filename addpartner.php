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


$PartnerName=$_POST['PartnerName'];
$CreationDate= date('y-m-d');
$Sport=$_POST['Sport'];
$Beneficiary=$_POST['Beneficiary'];
$Status=1;

$Logo=$_FILES["img1"]["name"];

move_uploaded_file($_FILES["img1"]["tmp_name"],"img/PartnerLogo/".$_FILES["img1"]["name"]);


$sql="INSERT INTO partners(PartnerName,Status,Sport,Beneficiary,Logo,CreationDate) VALUES(:PartnerName,:Status,:Sport,:Beneficiary,:Logo,:CreationDate)";

$query = $dbh->prepare($sql);
$query->bindParam(':PartnerName',$PartnerName,PDO::PARAM_STR);
$query->bindParam(':Status',$Status,PDO::PARAM_STR);
$query->bindParam(':Sport',$Sport,PDO::PARAM_STR);
$query->bindParam(':Beneficiary',$Beneficiary,PDO::PARAM_STR);
$query->bindParam(':Logo',$Logo,PDO::PARAM_STR);
$query->bindParam(':CreationDate',$CreationDate,PDO::PARAM_STR);



$query->execute();

// print_r($query);
// exit();


$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Partner Added successfully";
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
	
	<title>EUSports  | Partnered Sponsors</title>

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
					
						<h2 class="page-title">Add Partners</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Details</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();" enctype="multipart/form-data">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Partner Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="PartnerName" id="	PartnerName" required>
												</div>
											</div>
										
							
											<div class="form-group">
												<label class="col-sm-4 control-label"> Sponsored Sports</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="Sport" id="sport" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Beneficiary Team</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="Beneficiary" id="Beneficiary" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
			<div class="form-group">
				 <div class="col-sm-12">
				   <h4 style="margin-right: 3"><b>Partner Image</b></h4>
                 </div>
            </div>


       <div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
</div>
											<div class="hr-dashed"></div>
						
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
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