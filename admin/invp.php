<?php
session_start();
include_once 'function.php';

$ID = $_GET['id'];

$loan_status = $_GET['loan_status'];

$custmomer_id = $_GET['customer_id'];



//`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
$get_organicsass = mysqli_query($connect,"SELECT * FROM `reference` where reference_name = '$ID' ") or die(mysqli_error($connect));
while($get_valueas = mysqli_fetch_array($get_organicsass)) 
{

$name = $get_valueas['name'];

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
<div class="container">
<div class="row">
<div class="col-xs-6" style="float:left;">
<h1>
<a href="#">
<img src="../public/front/image/kyc.png" width="150">

</a>
</h1>
<h2><?php echo $ID; ?> - <?php echo $name; ?></h2>
</div>

</div>

<table class="table table-bordered">
<thead>
<tr>
<th>
<h4># </h4>
</th>
<th style="width:10%;">
<h4>Date </h4>
</th>
<th>
<h4>Full Name </h4>
</th>
<th>
<h4>Emp Type </h4>
</th>
<th>
<h4>Pan / Aadhar</h4>
</th>
<th>
<h4>Dob</h4>
</th>
<th>
<h4>Add</h4>
</th>
<th>
<h4>mobile /Email</h4>
</th>
<th>
<h4>Loan amount</h4>
</th>'
<th>
<h4>Loan type</h4>

</th>
<th>

<h4>Bank Name</h4>
</th>
<?php
if($loan_status == 'cancelled'){
?>
<th>
<h4>cancelled reason </h4>

</th>
<?php
}
?>

</tr>
</thead>
    <tbody>
        <?php
        if($loan_status == ''){
        //  echo "SELECT * FROM `apply_from` where referedby = '$ID' and idd = '$custmomer_id' ";
        $get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where referedby = '$ID' and idd = '$custmomer_id' ") or die(mysqli_error());     
        }else{

        $get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where referedby = '$ID' and loan_status = '$loan_status' and idd = '$custmomer_id' ") or die(mysqli_error());
        }
        
        if(!empty($loan_status))
        {
        $get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where referedby = '$ID' ") or die(mysqli_error());  
        }
        
        
        
        if(!empty($ID))
        {
        $get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where idd = '$custmomer_id' ") or die(mysqli_error());  
        }
        
        
        
         
         
        //   if($ID == '' || $loan_status=='')
        //  {         
        // $get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where loan_status = '$loan_status' and idd = '$custmomer_id' ") or die(mysqli_error());
        //  }
        
        
        
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
  $reason=$get_value['reason'];
  $bank_name=$get_value['bank_name'];


        
        ?>
           <tr>
                 <td><?php echo $sno; ?></td>
        <td><?php echo date('d-m-Y',strtotime($adate)); ?></td>
            <td class="text-right"><?php echo $full_name; ?> - KYCC<?php echo $product_id; ?> </td>
               <td class="text-right"><?php echo $employment_type; ?> </td>
                  <td class="text-right"><?php echo $pan; ?><br><?php echo $aadhar_no; ?> </td>
            <td class="text-right"><?php echo date('d-m-Y',strtotime($dob)); ?> </td>
                <td class="text-right"><?php echo $state; ?><br><?php echo $pin_code; ?> </td>
                   <td class="text-right"><?php echo $mobile_no; ?><br><?php echo $email; ?> </td>
                      <td class="text-right"><?php echo $loan_amount; ?></td>
                         <td class="text-right"><?php echo $loan_type; ?></td>
                                <td class="text-right"><?php echo $bank_name; ?></td>
                     <?php
if($loan_status == 'cancelled'){
?>    
                           <td class="text-right"><?php echo $reason; ?></td>
                           
 <?php
}
?>
        </tr>
        <?php
        }
        ?>
        
      
       
       
        
       
       
      
   
      
         

    </tbody>
</table>

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