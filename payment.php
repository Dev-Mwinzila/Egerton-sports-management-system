<?php
if(isset($_POST['mpesa']))
{ 

$Idno=$_SESSION['Idno'];
$query="SELECT ContactNo from tbluser where Idno=:Idno";
$query= $dbh -> prepare($query);
$query-> bindParam(':Idno', $Idno, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$phone=$results->ContactNo;

$consumer_key='';
$consumer_secret='';
$headers=['ContentType:application/json;charset=utf8'];
$access_token_url='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$curl=curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl,CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $consumer_key.'#'.$consumer_secret);
$result=curl_exec($curl);
$status=curl_getinfo($ch,CURLINFO_HTTP_CODE);
$result=json_decode($result);
$access_token=$result->access_token;
curl_close($curl);


//initiate transaction

$initiate_url='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  $businessShortCode = " ";
    $passKey = " ";
    $timestamp = date('YmdGis');
    $password = base64_encode($businessShortCode.$passKey.$timestamp);
    $Amount = '1';
    $partyA = "254701237958";//paying phone number
    $callBackUrl = "https://cptmsproject.epizy.com/carrental/payment/callbacl_url.php";
    //the mpesa response can be saved in database from thiS URL
    $accReff = "Park001";
    $transDesc = "Paymnet for CPTMS ";

$stkHeader=['Content-Type:application/json','Authorization:Bearer '.$access_token];

 $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkHeader);

 $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $businessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $partyA,
    'PartyB' => $businessShortCode,
    'PhoneNumber' => $partyA,
    'CallBackURL' => $callBackUrl,
    'AccountReference' => $accReff,
    'TransactionDesc' => $transDesc
  );
$data_string=json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response=curl_exec($curl);
echo $curl_response;






echo "<script type='text/javascript'> window.location = 'my-booking.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}



?>

<div class="modal fade" id="paymentform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Payment</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="PhoneNumber" placeholder="PhoneNumber*">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Amount" placeholder="Amount*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="payment" value="confirm payment" class="btn btn-block">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
      </div> 
    </div>
  </div>
</div>