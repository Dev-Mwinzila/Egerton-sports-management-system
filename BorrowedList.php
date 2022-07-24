<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['del']))
	{
$del=intval($_GET['del']);
$Status="0";
$sql = "UPDATE borroweditem SET Status=:Status WHERE  id=:del";
$query = $dbh->prepare($sql);
$query -> bindParam(':Status',$Status, PDO::PARAM_STR);
$query-> bindParam(':del',$del, PDO::PARAM_STR);
$query -> execute();

$msg="Cleared";
}

	if (isset($_REQUEST['lol'])) {
	$lol=intval($_GET['lol']);
	$Status="3";
	$sql = "UPDATE borroweditem SET Status=:Status WHERE  id=:lol";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':Status',$Status, PDO::PARAM_STR);
	$query-> bindParam(':lol',$lol, PDO::PARAM_STR);
	$query -> execute();

	$msg="Item Added To Lost Item Records";
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
	
	<title>EUSports Purchase Requests  </title>

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

						<h2 class="page-title">Issued Sports Equipment</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">EUSports Equipment</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Student Name</th>
											<th>Reg No</th>
											<th>Equipment</th>
										<th>Date Issued</th>
											<th>Count</th>
											<th>Cost</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Student Name</th>
										<th>Reg No</th>
											<th>Equipment</th>
											<th>Date Issued</th>
											<th>Count</th>
											<th>Cost</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

<?php 
$sql = "SELECT borroweditem.*, students.Name, students.RegNo, sportitems.ItemName, sportitems.Cost, sportitems.Description as bid  from borroweditem join students on borroweditem.RegNo=students.RegNo join sportitems on borroweditem.ItemId=sportitems.id where borroweditem.Status=1";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
<tr>
	<td><?php echo htmlentities($cnt);?></td>
	<td><?php echo htmlentities($result->Name);?></td>
	<td><?php echo htmlentities($result->RegNo);?></td>
	<td><?php echo htmlentities($result->ItemName);?></td>
		<td><?php echo htmlentities($result->timeIssued);?></td>
	<td><?php echo htmlentities($result->Count);?></td>
     <td><?php echo htmlentities($result->Cost);?></td>
    
	<td><?php 
if($result->Status==1){
	echo "Borrowed";
}elseif($result->Status==0){
	echo "Cleared";
}else{
	echo "Lost";
}
?>
</td>

<td><a href="ClearStudent.php?id=<?php echo $result->id;?>">Edit</a>&nbsp;&nbsp;
<a href="BorrowedList.php?del=<?php echo $result->id;?>" onclick="return confirm('Clear Record');">Clear</i></a></td>
<td><a href="BorrowedList.php?lol=<?php echo $result->id; ?>" onclick="return confirm('Confirm Item Is Lost');">Lost</a> </td>




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
