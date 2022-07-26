<?php
//error_reporting(0);
if(isset($_POST['signup']))
{
$Name=$_POST['Name'];
$RegNo=$_POST['RegNo']; 
$Course=$_POST['Course'];
$Gender=$_POST['Gender'];
$phone=$_POST['phone'];


$sql1="SELECT * from students where RegNo=:RegNo";
$query = $dbh->prepare($sql1);
$query->bindParam(':RegNo',$RegNo,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

// print_r($results);
// exit();
if($query->rowCount() > 0){

  echo "<script>alert('Registration Number Already registerd');</script>";
}
else{

$sql="INSERT INTO students(RegNo,Name,Gender, Course, phone) VALUES(:RegNo,:Name,:Gender,:Course,:phone)";
$query = $dbh->prepare($sql);
$query->bindParam(':RegNo',$RegNo,PDO::PARAM_STR);
$query->bindParam(':Name',$Name,PDO::PARAM_STR);
$query->bindParam(':Gender',$Gender,PDO::PARAM_STR);
$query->bindParam(':Course',$Course,PDO::PARAM_STR);
$query->bindParam(':phone',$phone,PDO::PARAM_STR);

$query->execute();
echo "<script>alert('Registration successfull);</script>";
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}}

?>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">EUSports Registration form</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">


              <form  method="post"  name="signup" onSubmit="return valid(); ">
                <div class="form-group">
                  <input type="text" class="form-control" name="Name" id="name" placeholder="Full Name" required="required" pattern="^[A-Za-z][A-Za-z0-9!@#$%^&* ]*$">
                </div>
                 <div class="form-group">
                  <input type="text" class="form-control" name="RegNo" id="RegNo" placeholder="Registration Number" maxlength="20" required="required">
                  <span id="RegNo" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Course" placeholder="Course" maxlength="40" required="required">
                  <span id="idno" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="phone" placeholder="Phone Number" maxlength="15" required="required">
                  <span id="idno" style="font-size:12px;"></span> 
                </div>

 <div class="form-group">
   <select class="form-control" name="Gender" placeholder="Gender">
          <option value="Male">Male</option>
           <option value="FeMale">female</option>
      </select>
    </div>
                  <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block" onclick="return valid()">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>