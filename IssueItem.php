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


$RegNo=$_POST['RegNo'];
$ItemId=$_POST['Item'];
$Count=$_POST['ItemCount'];
$timeIssued= date('y-m-d');
$Status=1;
;

$sql1="SELECT Count from sportitems where id=:ItemId";
$query = $dbh->prepare($sql1);
$query->bindParam(':ItemId',$ItemId,PDO::PARAM_STR);
$query->execute();

$row = $query->fetch();
$StockCount=$row[0];

if ($Count > $StockCount) {
  	$error="Items Available in Store: $StockCount";

	} else {
	$sql="INSERT INTO borroweditem(RegNo,ItemId,Count,timeIssued,Status) VALUES(:RegNo,:ItemId,:Count,:timeIssued,:Status)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':RegNo',$RegNo,PDO::PARAM_STR);
		$query->bindParam(':ItemId',$ItemId,PDO::PARAM_STR);
		$query->bindParam(':timeIssued',$timeIssued,PDO::PARAM_STR);
		$query->bindParam(':Status',$Status,PDO::PARAM_STR);
		$query->bindParam(':Count',$Count,PDO::PARAM_STR);

	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{

			$sql1="SELECT Count from sportitems where id=:ItemId";
			$query = $dbh->prepare($sql1);
			$query->bindParam(':ItemId',$ItemId,PDO::PARAM_STR);
			$query->execute();
			$row = $query->fetch();
			
			$StockCount2=$row[0];
			$NewCount=$StockCount2-$Count;

			$sql2="UPDATE sportitems set Count=:NewCount where id=:ItemId";
			$query = $dbh->prepare($sql2);
			$query->bindParam(':ItemId',$ItemId,PDO::PARAM_STR);
			$query->bindParam(':NewCount',$NewCount,PDO::PARAM_STR);
			$query->execute();

				echo "<script>alert('Item Issued Succesfully');</script>";
				echo "<script type='text/javascript'> document.location = 'IssueItem.php'; </script>";

		    $msg="Sport Item Succesfully issued";
     }else 
{
$error="Something went wrong. Please try again";
}
   
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
	
	<title>EUSports  | Issue Sport</title>

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
					
						<h2 class="page-title">Issue Sport Item</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Sport Details</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();" enctype="multipart/form-data">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
									
	<div class="form-group">
		<label class="col-sm-4 control-label">Reg. Number</label>
		<div class="col-sm-8">
        <select class="form-control" name="RegNo">
          <option ></option>
<?php $sql = "SELECT * from  students";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
 
<option value="<?php echo htmlentities($result->RegNo);?>"><?php echo htmlentities($result->RegNo);?></option>
<?php }} ?>
      </select>
     </div>
</div>

	<div class="form-group">
		<label class="col-sm-4 control-label">Sport Item</label>
		<div class="col-sm-8">
        <select class="form-control" name="Item">
          <option>Item</option>
<?php $sql = "SELECT * from  sportitems";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>  
 
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->ItemName);?></option>
<?php }} ?>
      </select>
     </div>
</div>

											<div class="form-group">
												<label class="col-sm-4 control-label">Count</label>
												<div class="col-sm-8">
													<input type="number" class="form-control" name="ItemCount" id="ItemCount" min="1" required>
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