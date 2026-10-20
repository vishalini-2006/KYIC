<?php
session_start();
include_once 'function.php';
$ID = $_GET['id'];

$get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where idd = '$ID' ") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_organic)) 
{
$sno++;
$product_id = $get_value['idd'];
$full_name = $get_value['full_name'];
$employment_type = $get_value['employment_type'];
$pan = $get_value['pan'];
$dob = $get_value['dob'];
$state = $get_value['state'];
$pin_code = $get_value['pin_code'];
$mobile_no = $get_value['mobile_no'];
$email = $get_value['email'];
$aadhar_no = $get_value['aadhar_no'];
$gender = $get_value['gender'];

$city = $get_value['city'];

$loan_amount = $get_value['loan_amount'];
 $referedby = $get_value['referedby'];
 $loan_type=$get_value['loan_type'];
  $adate=$get_value['adate'];
   $specially_abled=$get_value['specially_abled'];
                               $prop_type=$get_value['prop_type'];
                               $net_income=$get_value['net_income'];
                               $itr_availability=$get_value['itr_availability'];
                               $itr_years=$get_value['itr_years'];
                               $gst_availability=$get_value['gst_availability'];
                               $bank_name=$get_value['bank_name'];
                               $employee_name=$get_value['employee_name'];
                               $employee_number=$get_value['employee_number'];
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Loan Application</title>
<link rel="stylesheet" href="bootstrap.css">
<style>
@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
body, h1, h2, h3, h4, h5, h6{
font-family: sans-serif;
}
</style>
</head>
<body>
<div class="container" style="margin-left:20%;">
<div class="row">
<div class="col-xs-6" style="float:left;">
<h1>
<a href="#">
<img src="../public/front/image/kyc.png" width="150"style="margin-left: 153px;
">

</a>
</h1>
<h2 style="margin-left: 100px;">Loan Application</h2>
</div>

</div>
<div class="col-xs-6">
<table class="table table-bordered" style="width: 89%;
    height: 828px;
    margin-left: -35px;
    margin-top: 129px;">
<thead>
<tr>
<th>
<h4># </h4>
</th>
<th>
<h4>Description</h4>
</th>

</tr>
</thead>
    <tbody>
            
      
        
             <tr>
        <td>Customer id</td>
            <td class="text-right">KYCC<?php echo $product_id; $aadhar_no ?> </td>
        
        </tr>
             
      <tr>
        <td>Full Name</td>
            <td class="text-right"><?php echo $full_name; ?> </td>
        
        </tr>
           <tr>
        <td>Mobile no</td>
            <td class="text-right"><?php echo $mobile_no; ?> </td>
        
        </tr>
        
       
               <tr>
        <td>Loan Amount</td>
            <td class="text-right"><?php echo $loan_amount; ?> </td>
        
        </tr>

        <tr>
        <td>Property Type</td>
            <td class="text-right"><?php echo $prop_type; ?> </td>
        
        </tr>
       

    </tbody>
</table>
</div>
<br>

</div>
<style type="text/css">
	.table {
    width: 100%;
    margin-bottom: 0px;
}
</style>
</body>
</html>