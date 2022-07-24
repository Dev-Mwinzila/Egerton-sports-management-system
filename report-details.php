<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);

$status="left";
$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();
  echo "<script>alert('Booking Successfully Cancelled');</script>";
echo "<script type='text/javascript'> document.location = 'canceled-bookings.php; </script>";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Booking Successfully Confirmed');</script>";
echo "<script type='text/javascript'> document.location = 'confirmed-bookings.php'; </script>";
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
	
	<title>CPATMS | New Bookings   </title>
<script type="text/javascript">  
      function printDiv(){
var t=new Date();
var divContents=document.getElementById("row").innerHTML;
var a= window.open('', '','height=500, width=500');
a.document.write('<html>');
a.document.write('<link rel="stylesheet" href="css/print.css" type="text/css" >');
//a.document.write(t);
a.document.write(divContents);
a.document.write('</body></html>');
setTimeOut(function(){ a.print();},1000);
a.document.close();
      }
    </script>
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

						<h2 class="page-title">Booking Details</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default" id="row">
	<div class="panel-heading">Bookings Info
	<div style="float: right;color: black;"><?php $currentDateTime=date('y-m-d H:i:s');
 ?>
 	<?php echo htmlentities($currentDateTime);?><br></div>
 </div>
							<div class="panel-body">


<div id="print">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Booking No</th>
											<th>Car No</th>
											
											<th>Email</th>
											<th>Contact</th>
											<th>Booked from</th>
											<th>To</th>
											<th>Status</th>
											<th>Cash Paid</th>
										</tr>
									</thead>
<?php 
$id2=intval($_GET['bid']);
session_start();
$_SESSION['parkid']=$id2;

$sql2="SELECT * from tblbrands WHERE tblbrands.id=:id2";
$query=$dbh->prepare($sql2);
$query -> bindParam(':id2',$id2, PDO::PARAM_STR);
$query->execute();
$results2=$query->fetchAll(PDO::FETCH_OBJ);

foreach ($results2 as $result) {
$ParkName=$result->ParkName;
$booked=$result->booked;
$PricePerDay=$result->PricePerDay;
}
?>  

<h3 style="text-align:center; color:black"><?php echo htmlentities($ParkName);?>  Park Report <br>
<?php echo htmlentities($booked);?>  booked lots <br>

<?php echo htmlentities($PricePerDay);?>  /per day <br>
 
</h3>
 

<form action="park-report.php" method="POST">
	<div style="float: right;"><label>search from:<input type="date" name="fromdate"></label>
 	<label>To Date:<input type="date" name="todate"></label>

 	<a href="report-details.php?bid=<?php echo htmlentities($result->id);?>"></a>

 	 <input type="submit" value="View Report" name="report" placeholder="bid=<?php echo htmlentities($result->id);?>"></div>
</form>
									<tbody>


									<?php

$id=intval($_GET['bid']);

$sql = "SELECT tblusers.FullName,tblusers.EmailId,tblusers.Idno,
tblusers.ContactNo,
  tblbrands.ParkName,tblbrands.Location,tblbrands.PricePerDay,
tblbrands.lots,tblbrands.booked, tblbooking.BookingNumber,tblbooking.carno,tblbooking.FromDate,tblbooking.ToDate,tblbooking.status, tblbooking.pid from tblbooking join tblbrands on tblbrands.id=tblbooking.pid join tblusers on tblusers.EmailId=tblbooking.EmailId where tblbooking.pid=:id && tblbrands.id=:id";



$query = $dbh -> prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	
			?>	
	
		<tr>
		<td><?php echo htmlentities($cnt);?></td>
		<td><?php echo htmlentities($result->BookingNumber);?></td>
		<td><?php echo htmlentities($result->carno);?></td>
		<td><?php echo htmlentities($result->EmailId);?></td>
		<td><?php echo htmlentities($result->ContactNo);?></td>
		<td><?php echo htmlentities($result->FromDate);?></td>
		<td><?php echo htmlentities($result->ToDate);?></td>
		<td><?php 
if($result->Status==1)
{
echo htmlentities('left');
} else if ($result->Status==0) {
echo htmlentities('booked');
}
 else{
 	echo htmlentities('Held');
 }
										?></td>
<td><?php echo htmlentities($result->PricePerDay);?></td>



					</tr>
					<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
		
							</div>
						</div>

					

					</div>
				</div>
						<form method="post">
	   <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="printDiv()" style="cursor: pointer;"  />
	</form>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<!-- 	<script src="js/jquery.dataTables.min.js"></script>
 -->	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
<?php } ?>
