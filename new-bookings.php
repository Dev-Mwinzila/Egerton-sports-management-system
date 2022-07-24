<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

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
	
	<title>CPTMS | New Bookings   </title>

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

						<h2 class="page-title">New Bookings</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Bookings Info</div>
							<div class="panel-body">

								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
										<th>Booking Code</th>
											<th>Park Name</th>
											<th>Car No</th>
											<th>Owners ID</th>
											<th>Owners Name</th>
											<th>Phone</th>
											<th>Time from</th>
											<th>Time to</th>
											<th>Status</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Booking Code</th>
											<th>Park Name</th>
											<th>Car No</th>
											<th>Owners ID</th>
											<th>Owners Name</th>
											<th>Phone</th>
											<th>Time from</th>
											<th>Time to</th>
											<th>Status</th>
										</tr>
									</tfoot>
									<tbody>

									<?php 
$status=0;
$sql = "SELECT * from tblbooking left join tblusers on tblbooking.EmailId=tblusers.EmailId left join tblbrands on tblbooking.pid=tblbrands.id ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
// print_r($idno);
// exit();


$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->BookingNumber);?></td>
											<td><?php echo htmlentities($result->ParkName);?></td>
											<td><?php echo htmlentities($result->carno);?></td>
											<td><?php echo htmlentities($result->Idno);?></td>
											<td><?php echo htmlentities($result->FullName);?></td>
											<td><?php echo htmlentities($result->ContactNo);?></td>
											<td><?php echo htmlentities($result->FromDate);?></td>
											<td><?php echo htmlentities($result->ToDate);?></td>
											
							<td><?php 
if($result->status==1)
{
echo htmlentities('booked');
}elseif ($result->status==2) {
echo htmlentities('left');
}
 else{
 	echo htmlentities('Locked');
 }
										?></td>
											
										<td> 


<a href="bookig-details.php?bid=<?php echo htmlentities($result->BookingNumber);?>"> View</a>

</td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

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
