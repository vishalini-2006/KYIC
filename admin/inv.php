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


<style>
table, th, td
{
    border:1px solid black;
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
<table class="table " style="width: 89%;
    height: 828px;
    margin-left:-100px;">
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
                <td>
                    Referred By
                </td>
                <td class="text-right"><?php echo $referedby; ?> </td>
            </tr>
           <tr>
        <td>Date</td>
            <td class="text-right"><?php echo date('d-m-Y',strtotime($adate)); ?> </td>
        
        </tr>
        
             <tr>
        <td>Customer id</td>
            <td class="text-right">KYCC<?php echo $product_id; $aadhar_no ?> </td>
        
        </tr>
        
           <tr>
            <td>Bank Name</td>
            <td class="text-right"><?php echo $bank_name; ?> </td>
        </tr>
                 <tr style="font-weight:bolder;">
        <td>Loan Amount</td>
            <td class="text-right"><?php echo $loan_amount; ?> </td>
        
        </tr>
        <tr style="font-weight:bolder;">
        <td>Net Income</td>
            <td class="text-right"><?php echo $net_income; ?> </td>
        
        </tr>
        <tr>
        <td>Loan Type</td>
            <td class="text-right"><?php echo $loan_type; ?> </td>
        
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
        <td>Aadhar no</td>
            <td class="text-right"><?php echo $aadhar_no; ?> </td>
        
        </tr>
          <tr>
        <td>Pan card</td>
            <td class="text-right"><?php echo $pan; ?> </td>
        
        </tr>
           <tr>
        <td>Date of Birth</td>
            <td class="text-right"><?php echo date('d-m-Y',strtotime($dob)); ?> </td>
        
        </tr>
            <tr>
        <td>Email</td>
            <td class="text-right"><?php echo $email; ?> </td>
        
        </tr>
             <tr>
        <td>Gender</td>
            <td class="text-right"><?php echo $gender; ?> </td>
        
        </tr>
         <tr>
        <td>District</td>
            <td class="text-right"><?php echo $state; ?> </td>
        
        </tr>
          
           <tr>
        <td>Pincode</td>
            <td class="text-right"><?php echo $pin_code; ?> </td>
        
        </tr>
     
        <tr>
            <td>Employee Name</td>
            <td class="text-right"><?php echo $employee_name; ?> </td>
            
        </tr>
        <tr>
            <td>
                Employee Number
            </td>
            <td class="text-right"><?php echo $employee_number; ?> </td>

        </tr>
            <tr>
        <td>Village</td>
            <td class="text-right"><?php echo $city; ?> </td>
        
        </tr>
        
           
          <tr>
        <td>Employment Type</td>
            <td class="text-right"><?php echo $employment_type; ?> </td>
        
        </tr>
        </tr>
       
        <tr>
        <td>Specially Abled</td>
            <td class="text-right"><?php echo $specially_abled; ?> </td>
        
        </tr>
        <tr>
        <td>Property Type</td>
            <td class="text-right"><?php echo $prop_type; ?> </td>
        
        </tr>
        
        <tr>
        <td>ITR Availability</td>
            <td class="text-right"><?php echo $itr_availability; ?> </td>
        
        </tr>
        <tr>
        <td>No of Years(ITR)</td>
            <td class="text-right"><?php echo $itr_years; ?> </td>
        
        </tr>
        <tr>
        <td>GST Availability</td>
            <td class="text-right"><?php echo $gst_availability; ?> </td>
        
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