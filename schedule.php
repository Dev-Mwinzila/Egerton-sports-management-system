<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['wlogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {

$HomeTeam=$_POST['HomeTeamId'];
$AwayTeam=$_POST['AwayTeamId'];
$KickOff =$_POST['KickOff'];
$fieldId=$_POST['fieldId'];
$bookingdate=date('y-m-d');
$BookingNumber=mt_rand(100000, 999999);
$Status=1;
$FieldStatus=0;

$sql="INSERT INTO tblbooking(BookingNumber,Status, bookingdate,HomeTeam,AwayTeam,fieldId,KickOff) VALUES(:BookingNumber,:Status,:bookingdate,:HomeTeam,:AwayTeam,:fieldId,:KickOff)";

$query = $dbh->prepare($sql);
$query->bindParam(':BookingNumber',$BookingNumber,PDO::PARAM_STR);
$query->bindParam(':Status',$Status,PDO::PARAM_STR);
$query->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
$query->bindParam(':HomeTeam',$HomeTeam,PDO::PARAM_STR);
$query->bindParam(':AwayTeam',$AwayTeam,PDO::PARAM_STR);
$query->bindParam(':fieldId',$fieldId,PDO::PARAM_STR);
$query->bindParam(':KickOff',$KickOff,PDO::PARAM_STR);
$query->execute();
// ANGALIA ID NO AVAILABILITY

$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="SUCCESSFully Scheduling";
}
else 
{
$error="Something went wrong. Check Item Name";
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
	
	<title>EUSports| Add Schedule Matches</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
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
					
						<h2 class="page-title">Schedule Matches</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Details</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<div class="col-sm-4">
        <select class="form-control" name="HomeTeamId">
        	<label>Home Team</label>
          <option>Home Team</option>
<?php $sql = "SELECT * from  team";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
 
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TeamName);?></option>
<?php }} ?>
      </select> 
     </div>

<div class="col-sm-4">
        <select class="form-control" name="AwayTeamId">
          <option >Away Team</option>
<?php $sql = "SELECT * from  team";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
 
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->TeamName);?></option>
<?php }} ?>
      </select>
     </div>

</div>
											
<div class="hr-dashed"></div>

<div class="form-group">
<label class="col-sm-2 control-label">Kick Off<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="date" name="KickOff" class="form-control" required  min="date()"> 
</div>

<div class="form-group">

<div class="col-sm-4">
        <select class="form-control" name="fieldId">
          <option >Field</option>
<?php $sql = "SELECT * from  field";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
 
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->FieldName);?></option>
<?php }} ?>
      </select>
     </div>

</div>


<div class="hr-dashed"></div>



								
</div>
</div>
</div>
</div>

<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
	<button class="btn btn-default" type="reset">Cancel</button>
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
