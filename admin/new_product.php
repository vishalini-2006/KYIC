<?php



session_start();
include_once 'function.php';
// add Details
//`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, `mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`SELECT * FROM `apply_from` WHERE 1
if ($_POST['add'] == 'Create') {

 $full_name     = $_POST['full_name'];
 $employment_type     = $_POST['employment_type'];
 $pan     = $_POST['pan'];
 $dob     = $_POST['dob'];
 $state     = $_POST['state'];
 $pin_code     = $_POST['pin_code'];
 $mobile_no     = $_POST['mobile_no'];
 $email     = $_POST['email'];
 $aadhar_no     = $_POST['aadhar_no'];
 $gender     = $_POST['gender'];
 $city     = $_POST['city'];
 $loan_amount     = $_POST['loan_amount'];
 $referedby     = $_POST['referedby'];
 $loan_type =$_POST['loan_type'];
 $specially_abled=$_POST['specially_abled'];
 $prop_type=$_POST['prop_type'];
 $net_income=$_POST['net_income'];
 $itr_availability=$_POST['itr_availability'];
 $itr_years=$_POST['itr_years'];
 $gst_availability=$_POST['gst_availability'];


mysqli_query($connect,"INSERT into apply_from (`full_name`,`referedby`,`employment_type`,`pan`,`dob`,`state`,`pin_code`,`mobile_no`,`email`,`aadhar_no`,`gender`,`city`,`loan_amount`,`loan_type`,`specially_abled`,`prop_type`,`net_income`,`itr_availability`,`itr_years`,`gst_availability`) 
values ('$full_name','$referedby','$employment_type','$pan','$dob','$state','$pin_code','$mobile_no','$email','$aadhar_no','$gender','$city','$loan_amount','$loan_type','$specially_abled','$prop_type','$net_income','$itr_availability','$itr_years','$gst_availability')") or die(mysqli_error());



echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'product.php?msg=added&action=list'</script>";
}
// Edit
if ($_POST['update_page'] == 'Update') {


//`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, `mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`SELECT * FROM `apply_from` WHERE 1
$newsid = $_POST['idd'];

    $full_name     = $_POST['full_name'];
      $employment_type     = $_POST['employment_type'];
        $pan     = $_POST['pan'];
          $dob     = $_POST['dob'];
            $state     = $_POST['state'];
              $pin_code     = $_POST['pin_code'];
                $mobile_no     = $_POST['mobile_no'];
                  $email     = $_POST['email'];
                   $aadhar_no     = $_POST['aadhar_no'];
                    $gender     = $_POST['gender'];
                     $city     = $_POST['city'];
                          $loan_amount     = $_POST['loan_amount'];
     $referedby     = $_POST['referedby'];
     $loan_type =$_POST['loan_type'];
      $specially_abled=$_POST['specially_abled'];
                               $prop_type=$_POST['prop_type'];
                               $net_income=$_POST['net_income'];
                               $itr_availability=$_POST['itr_availability'];
                               $itr_years=$_POST['itr_years'];
                               $gst_availability=$_POST['gst_availability'];


mysqli_query($connect,"UPDATE apply_from SET `full_name` = '$full_name',`referedby` = '$referedby',`employment_type` = '$employment_type',`pan` = '$pan',`dob` = '$dob',`state` = '$state',
`pin_code` = '$pin_code',`mobile_no` = '$mobile_no',`email` = '$email',`aadhar_no` = '$aadhar_no',`gender` = '$gender', `city` = '$city', `loan_amount` = '$loan_amount' ,`specially_abled`='$specially_abled',
`prop_type`='$prop_type',`net_income`='$net_income',`itr_availability`='$itr_availability',`itr_years`='$itr_years',`gst_availability`='$gst_availability'
where idd = '$newsid'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'product.php?msg=updated&action=list'</script>";
}
//`product_id`, `product_img`, `product_price`, `product_HI`, `product_DI`, `product_TI`, `product_cycle`, `product_Des`SELECT * FROM `product` WHERE 1
if ($_POST['updateadd'] == 'Submit') {


//`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, `mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`SELECT * FROM `apply_from` WHERE 1
$newsid = $_POST['idd'];


     $loan_status =$_POST['loan_status'];
     
     $bank_id1 =$_POST['bank_details'];
    


mysqli_query($connect,"UPDATE apply_from SET `bank_details` = '$bank_id1'  where idd = '$newsid'") or die(mysqli_error());


mysqli_query($connect,"UPDATE apply_from SET `loan_status` = '$loan_status'  where idd = '$newsid'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";

if($loan_status == 'Case login'){
echo "<script type='text/javascript'>window.location = 'caselogin.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Questioned documents examination (QDE)'){
 echo "<script type='text/javascript'>window.location = 'qde.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Probability of Default Examination (PDE)'){
 echo "<script type='text/javascript'>window.location = 'pde.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Credit appraisal'){
 echo "<script type='text/javascript'>window.location = 'creditappraisal.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Financial sanction'){
 echo "<script type='text/javascript'>window.location = 'financial.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Final sanction'){
 echo "<script type='text/javascript'>window.location = 'final.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Legal/Tech clearance'){
 echo "<script type='text/javascript'>window.location = 'legal.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Loan docket creation'){
 echo "<script type='text/javascript'>window.location = 'local.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Disbursement'){
 echo "<script type='text/javascript'>window.location = 'disbursement.php?msg=updated&action=list'</script>";
}elseif($loan_status == 'Loan Account Number Generation'){
 echo "<script type='text/javascript'>window.location = 'loannumber.php?msg=updated&action=list'</script>";
}else{
   echo "<script type='text/javascript'>window.location = 'cancelledloans.php'</script>";
  
}


}




if ($_GET['action'] == 'delete') {
$id  = $_GET['nwsevnt_id'];
$sql = "DELETE FROM apply_from WHERE idd = $id;";
$query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
echo "<script type='text/javascript'>window.location = 'product.php?msg=deleted&action=list'</script>";
}

if ($_GET['action'] == 'cancelled') {
$id  = $_GET['nwsevnt_id'];


mysqli_query($connect,"UPDATE apply_from SET `loan_status` = 'cancelled'  where idd = '$id'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'product.php?msg=updated&action=list'</script>";

}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ta" xml:lang="ta">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>Service Reg | 
      <?php echo $site_title; ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <link rel="stylesheet" href="assets/font-awesome/font-awesome.min.css"> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/customer.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <style type="text/css">
      .dt-buttons {
        display: none;
      }
    </style>
    <script type="text/javascript">
      function delete_menu(idurl)
      {
        go_on = confirm("Are you sure ? ");
        if(go_on)
        {
          document.location.href=idurl;
        }
      }
    </script>
  </head>
  <!-- END HEAD -->
  <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
      <!-- BEGIN HEADER -->
      <?php include("header.php");?>
      <!-- END HEADER -->
      <!-- BEGIN HEADER & CONTENT DIVIDER -->
      <div class="clearfix"> 
      </div>
      <!-- END HEADER & CONTENT DIVIDER -->
      <!-- BEGIN CONTAINER -->
      <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php include("menu.php");?>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
          <!-- BEGIN CONTENT BODY -->
          <div class="page-content">
            <!-- END THEME PANEL -->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
              <ul class="page-breadcrumb">
                <li>
                  <a href="index.php">Home
                  </a>
                  <i class="fa fa-circle">
                  </i>
                </li>
                <li>
                  <span>Product
                  </span>
                </li>
              </ul>
              <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                  <i class="icon-calendar">
                  </i>&nbsp;
                  <span class="thin uppercase hidden-xs">
                  </span>&nbsp;
                  <i class="fa fa-angle-down">
                  </i>
                </div>
              </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <?php
//`product_id`, `product_img`, `product_price`, `product_HI`, `product_DI`, `product_TI`, `product_cycle`, `product_Des`SELECT * FROM `product` WHERE 1
if(isset($_GET['action']) =='' || $_GET['action'] == 'list') {
    //`newsid`, `newsdate`, `newshead`, `newscontent`, `newsimg1`, `newsimg2`SELECT * FROM `news` WHERE 1
?>
            <br>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>Loan Application
                    </div>
                    <div class="actions">
                      <a href="?action=add" class="btn btn-default btn-sm">
                        <i class="fa fa-plus">
                        </i> Add 
                      </a>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <?php 
                    // pageStatus($status); 
                    ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr class="">
                            <th> S.NO 
                          </th>
                            <th>
                                Bank Name
                            </th>
                            <th>CIBIL Score</th>
                            <th>DBT Eligible</th>
                            <th>DBP Eligible</th>
                            <th>Obligations</th>
                            <th>Business Stability</th>
                            
                            <th>Loan Type</th>
                            
                            <th>View</th>
                            <!--<th>Self Employee</th>-->
                            <!--<th>Daily wages</th>-->
                            <!--<th>Property Type</th>-->
                            <!--<th>BM Level Loan</th>-->
                            <!--<th>Business Proof</th>-->
                            <!--<th>Daily Wages</th>-->
                            <!--<th>Sale Deed Value</th>-->
                            <!--<th>CIBIL Enquiries</th>-->
                            <!--<th>How many  Enquiries eligible </th>-->
                            <!--<th>Recent ITR</th>-->
                            <!--<th>Recent Sale Deed</th>-->
                            <!--<th>Age of the Property</th>-->
                            <!--<th>SRO EC 1987 to till date</th>-->
                            
                          
                           
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;
//`newform_id`, `bank_name`, `app_cibl_score`, `dbt_eligible`, `dbp_eligible`, `obligations`, `business_stability`, `dbt_and_over_due_closing`, `loan_type`, `employee_type`,
//`loan_amount_min`, `loan_amount_max`, `itr_loan_amount_min`, `itr_loan_amount_max`, `govt_salaried_ltv`, `salaried_ltv`, `property_type`, `property_type1`, `property_size`,
//`property_applicable`, `property_applicable1`, `sqr_ft_size`, `cent_size`, `acre_size`, `blue_print_size`, `dtcp_app_size`, `building_app_size`, `non_agri_size`, `roi`, `mv_ltv`,
//`mv_roi`, `mv_av_ltv`, `mu_av_roi`, `av_ltv`, `av_roi`, `ov_ltv`, `ov_roi`, `kn_ltv`, `kn_roi`, `bm__lvl_min`, `bm_lvl_max`, `business_proof`, `business_proof_upload`, 
//`employee_applicable`, `daily_wages`, `sale_deed_value`, `sale_deed_value_1`, `sale_deed_value_2`, `sale_deed_value_3`, `sale_deed_value_4`, `ltv`, `cibil_enquiries`,
//`no_of_enq_eligible`, `recent_itr`, `recent_sale_deed`, `age_of_property`, `sro_ec`, `new_a/c_cheque`, `fi`, `blue_print`, `supplier_a/c`, `doc_fi`SELECT * FROM `formw` WHERE 1
$get_organic = mysqli_query($connect,"SELECT * FROM `formw` ") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_organic)) 
{
$sno++;

$newform_id = $get_value['newform_id'];

$bank_name = $get_value['bank_name'];
$app_cibl_score = $get_value['app_cibl_score'];
$dbt_eligible = $get_value['dbt_eligible'];
$dbp_eligible = $get_value['dbp_eligible'];
$obligations = $get_value['obligations'];
$business_stability = $get_value['business_stability'];
$dbt_and_over_due_closing = $get_value['dbt_and_over_due_closing'];
$loan_type = $get_value['loan_type'];
$employee_applicable = $get_value['employee_applicable'];
$loan_amount_min = $get_value['loan_amount_min'];
$loan_amount_max = $get_value['loan_amount_max'];
$itr_loan_amount_min = $get_value['itr_loan_amount_min'];
$itr_loan_amount_max = $get_value['itr_loan_amount_max'];
$employee_type = $get_value['employee_type'];
$govt_salaried_ltv = $get_value['govt_salaried_ltv'];
$salaried_ltv = $get_value['salaried_ltv'];
$property_type = $get_value['property_type'];
$property_applicable = $get_value['property_applicable'];
$property_size = $get_value['property_size'];
$property_type1 = $get_value['property_type1'];
$property_applicable1 = $get_value['property_applicable1'];
$ltv = $get_value['ltv'];
$roi = $get_value['roi'];

$it_loan_amount = $get_value['it_loan_amount'];
 $slum_area = $get_value['slum_area'];
$tenor_min = $get_value['tenor_min'];
$tenor_max = $get_value['tenor_max'];


$bm_lvl_min = $get_value['bm_lvl_min'];
$bm_lvl_max = $get_value['bm_lvl_max'];
$business_proof = $get_value['business_proof'];
$business_proof_upload = $get_value['business_proof_upload'];
$daily_wages = $get_value['daily_wages'];
$sale_deed_value_1 = $get_value['sale_deed_value_1'];
$sale_deed_value_2 = $get_value['sale_deed_value_2'];
$sale_deed_value_3 = $get_value['sale_deed_value_3'];
$sale_deed_value_4 = $get_value['sale_deed_value_4'];
$cibil_enquiries = $get_value['cibil_enquiries'];
$no_of_enq_eligible = $get_value['no_of_enq_eligible'];
$recent_itr = $get_value['recent_itr'];
$recent_sale = $get_value['recent_sale_deed'];
$age_of_property = $get_value['age_of_property'];
$sro_ec = $get_value['sro_ec'];

?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                              
                          </td>
                          
                          <td>
                            <?php echo $bank_name;?> 
                              
                          </td>
                           <td>
                            <?php echo $app_cibl_score;?> 
                              
                          </td>
                           <td>
                            <?php echo $dbt_eligible;?> 
                            
                              
                          </td>
                           <td>
                            <?php echo $dbp_eligible;?> 
                              
                          </td>
                           <td>
                            <?php echo $obligations;?> 
                              
                          </td>
                           <td>
                            <?php echo $business_stability;?> 
                              
                          </td>
                          
                          
                           <td>
                            <?php echo $loan_type;?> 
                              
                          </td>
                          <td><a class="btn btn-info btn-xs" data-toggle="modal" href="#image<?php echo $newform_id; ?>">
                              <i class="fa fa-eye" aria-hidden="true">
                              </i> View
                            </a>
                            </td>
                            
                            
                            
                            <!--============================================= Image View Pop Up =============================================-->
                            <style>
                                .badge {
    font-size: 14px!important;
    font-weight: 300;
    height: 18px;
    color: #000000;
    padding: 3px 6px;
    -webkit-border-radius: 12px!important;
    -moz-border-radius: 12px!important;
    border-radius: 12px!important;
    text-shadow: none!important;
    text-align: center;
    vertical-align: middle;
}
.badge-primary {
    background-color: #ffffff;
}
                            </style>
                          <div class="modal fade" id="image<?php echo $newform_id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                  </button>
                                  <h4 class="modal-title">
                                  </h4>
                                </div>
                                <div class="modal-body">
                                  <ul class="list-group">
                                      <h5><b>DBT and OVER Due closing recent</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Accept or not
                                    <span class="badge badge-primary badge-pill"><?php echo $dbt_and_over_due_closing; ?></span>
                                  </li>
                                  
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Slum Area
                                    <span class="badge badge-primary badge-pill"><?php echo $slum_area; ?></span>
                                  </li>
                                  
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                    IT Loan Amount
                                    <span class="badge badge-primary badge-pill"><?php echo $it_loan_amount; ?></span>
                                  </li>
                                  
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Tenor Min
                                    <span class="badge badge-primary badge-pill"><?php echo $tenor_min; ?></span>
                                  </li>
                                  
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Tenor Max
                                    <span class="badge badge-primary badge-pill"><?php echo $tenor_max; ?></span>
                                  </li>
                                  
                                     <h5><b>Employee Type</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Employee Type
                                    <span class="badge badge-primary badge-pill"><?php echo $employee_applicable; ?></span>
                                  </li>
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Loan Amount min
                                    
                                    <span class="badge badge-primary badge-pill"><?php echo $loan_amount_min; ?></span>
                                    </li>
                                     <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Loan Amount max
                                    <span class="badge badge-primary badge-pill"><?php echo $loan_amount_max; ?></span>
                                  </li>
                                  
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     ITR Loan Amount Min
                                    <span class="badge badge-primary badge-pill"><?php echo $itr_loan_amount_min; ?></span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     ITR Loan Amount Max
                                    <span class="badge badge-primary badge-pill"><?php echo $itr_loan_amount_max; ?></span>
                                  </li>
                                  
                                  
                                 <h5><b>Employee Type</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Employee Type
                                    <span class="badge badge-primary badge-pill"><?php echo $employee_applicable; ?></span>
                                  </li>
                                  <?php 
                                  if ($employee_type == 'Govt Salaried'){
                                      ?>
                                  
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Income LTV %
                                    
                                    <span class="badge badge-primary badge-pill"><?php echo $govt_salaried_ltv ; ?>%</span>
                                   <?php 
                                    }
                                    else{
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Income LTV %
                                    
                                    <span class="badge badge-primary badge-pill"><?php echo $salaried_ltv; ?>%</span>
                                    <?php
                                    }
                                    ?>
                                    </li>
                                    <h5><b>Purchase</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                       Property Type
                                    <span class="badge badge-primary badge-pill"><?php echo $property_type; ?></span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                       Size
                                    <span class="badge badge-primary badge-pill"><?php echo $property_size; ?></span>
                                  </li>
                                    
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                       Property Type
                                    <span class="badge badge-primary badge-pill"><?php echo $property_type1; ?></span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                       LTV
                                    <span class="badge badge-primary badge-pill"><?php echo $ltv; ?></span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                       ROI
                                    <span class="badge badge-primary badge-pill"><?php echo $roi; ?></span>
                                  </li>
                                  
                                  
                                  
                                  <h5><b>BM Level Loan</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Minimum
                                    <span class="badge badge-primary badge-pill"><?php echo $bm_lvl_min; ?></span>
                                  </li>
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Maximum
                                    
                                    <span class="badge badge-primary badge-pill"><?php echo $bm_lvl_max; ?></span>
                                    </li>
                                    
                                    <h5><b>Business Proof</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Document Proof
                                    <span class="badge badge-primary badge-pill"><?php echo $business_proof; ?></span>
                                  </li>
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Document
                                    
                                    
                                    </li>
                                     <span class="badge badge-primary badge-pill" style="height:350px; display: grid;justify-items: center;margin: 10px 0;"> <img src= blog/<?php echo $business_proof_upload; ?> style="width:400px;"></span>
                                     
                                  <h5><b>Daily wages</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     With or Without Letter Pad
                                    <span class="badge badge-primary badge-pill"><?php echo $daily_wages; ?></span>
                                  </li>
                                   
                                   <h5><b>Sale Deed Value</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Sale Deed Value 1%
                                    <span class="badge badge-primary badge-pill"><?php echo $sale_deed_value_1; ?></span>
                                  </li>
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sale Deed Value 2%
                                    
                                    <span class="badge badge-primary badge-pill"><?php echo $sale_deed_value_2; ?></span>
                                    </li>
                                     <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sale Deed Value 3%
                                    <span class="badge badge-primary badge-pill"><?php echo $sale_deed_value_3; ?></span>
                                  </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sale Deed Value 4%
                                    <span class="badge badge-primary badge-pill"><?php echo $sale_deed_value_4; ?></span>
                                  </li>
                                    
                                    <ul class="list-group">
                                      <h5><b>CIBIL ENQUIRIES</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Eligible or not
                                    <span class="badge badge-primary badge-pill"><?php echo $cibil_enquiries; ?></span>
                                  </li>
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                    How many Enquiries eligible
                                    
                                    <span class="badge badge-primary badge-pill"><?php echo $no_of_enq_eligible; ?></span>
                                    </li>
                                    
                                    <h5><b>Recent ITR</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Eligible or not
                                    <span class="badge badge-primary badge-pill"><?php echo $recent_itr; ?></span>
                                  </li>
                                  
                                  <h5><b>Recent Sale Deed</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Eligible or not
                                    <span class="badge badge-primary badge-pill"><?php echo $recent_sale; ?></span>
                                  </li>
                                  <h5><b>Age of the Property</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     Age
                                    <span class="badge badge-primary badge-pill"><?php echo $age_of_property; ?></span>
                                  </li>
                                   <h5><b>SRO EC 1987 to till date</b></h5>
                                      <hr>
                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                     YES or NO
                                    <span class="badge badge-primary badge-pill"><?php echo $sro_ec ; ?></span>
                                  </li>
                                     
                                  
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                </ul>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                  </button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!--=========================================== End Image Pop Up ============================================== -->
                          
                          
                          
                          
                     
                        </tr>
                        <?php
}
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>   
            <?php
}
if($_GET['action'] == 'add')
{

//`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, 
//`mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`SELECT * FROM `apply_from` WHERE 1
?>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-list  font-red" aria-hidden="true">
                      </i>
                      <span class="caption-subject font-red sbold uppercase">ADD 
                      </span>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="" id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data" onsubmit="return CheckFormData();">
                      <div class="form-body">


                                   <div class="form-group">
                                                    <label class="control-label col-md-3">full_name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="full_name" id="full_name" data-required="1" class="form-control">
                                  
                               </div>
                               </div>

                      <div class="form-group">
                                                    <label class="control-label col-md-3">employment_type
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="employment_type" id="employment_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>

                                         <div class="form-group">
                                                    <label class="control-label col-md-3">pan
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="pan" id="pan" data-required="1" class="form-control">
                                  
                               </div>
                               </div> 

                                               <div class="form-group">
                                                    <label class="control-label col-md-3">dob
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="date" name="dob" id="dob" data-required="1" class="form-control">
                                  
                               </div>
                               </div>

                                                    <div class="form-group">
                                                    <label class="control-label col-md-3">state
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="state" id="state" data-required="1" class="form-control">
                                  
                               </div>
                               </div>


                                                                  <div class="form-group">
                                                    <label class="control-label col-md-3">pin code
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="pin_code" id="pin_code" data-required="1" class="form-control">
                                  
                               </div>
                               </div> 
                               
                                            
                               <div class="form-group">
                                                    <label class="control-label col-md-3">Mobile no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="mobile_no" id="mobile_no" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                               
                               
                                <div class="form-group">
                                                    <label class="control-label col-md-3">email
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="email" name="email"  id="email" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
     

                                                                              <div class="form-group">
                                                    <label class="control-label col-md-3">aadhar_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" name="aadhar_no"  id="aadhar_no" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                               
                                <div class="form-group">
                                                    <label class="control-label col-md-3">gender
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" name="gender"  id="gender" data-required="1" class="form-control">
                                  
                               </div>
                               </div> 
                               
                                   <div class="form-group">
                                                    <label class="control-label col-md-3">city
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" name="city"  id="city" data-required="1" class="form-control">
                                  
                               </div>
                               </div> 
                               
                                 <div class="form-group">
                                                    <label class="control-label col-md-3">loan_amount
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" name="loan_amount"  id="loan_amount" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">loan_type
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" name="loan_type"  id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">specially_abled
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text"  id="loan_type" data-required="1" class="form-control" name="specially_abled">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">prop_type
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" id="loan_type" data-required="1" class="form-control" name="prop_type">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">net_income
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text"  id="loan_type" data-required="1" class="form-control" name="net_income">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">itr_availability
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text"  id="loan_type" data-required="1" class="form-control" name="itr_availability">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">itr_years
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text"   id="loan_type" data-required="1" class="form-control" name="itr_years">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">gst_availability
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                  <input type="text" id="loan_type" data-required="1" class="form-control" name="gst_availability">
                                  
                               </div>
                               </div>


                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green" name="add" value="Create">Submit
                            </button>
                            <button type="reset" value="Reset" class="btn grey-salsa btn-outline">Reset
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- END FORM-->
                  </div>
                </div>
                <!-- END VALIDATION STATES-->
              </div>
            </div>
            <?php
}
if(isset($_GET['action']) == 'edit' && isset($_GET['nwsevnt_id'])) {   
    //`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, 
//`mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount` SELECT * FROM `apply_from` WHERE 1
                 
$NewsID = base64_decode($_GET["nwsevnt_id"]);

$get_about_edit = mysqli_query($connect,"SELECT * FROM `apply_from` where idd = '$NewsID'") or die(mysqli_error());
while($get_edit = mysqli_fetch_array($get_about_edit)) 
{
$sno++;
$product_id = $get_edit['idd'];
$full_name = $get_edit['full_name'];
$employment_type = $get_edit['employment_type'];
$pan = $get_edit['pan'];
$dob = $get_edit['dob'];
$state = $get_edit['state'];

$pin_code = $get_edit['pin_code'];
$mobile_no = $get_edit['mobile_no'];
$email = $get_edit['email'];
$aadhar_no = $get_edit['aadhar_no'];
$gender = $get_edit['gender'];

$city = $get_edit['city'];
$loan_amount = $get_edit['loan_amount'];
$loan_type =$_get_edit['loan_type'];
 $specially_abled=$_get_edit['specially_abled'];
                               $prop_type=$_get_edit['prop_type'];
                               $net_income=$_get_edit['net_income'];
                               $itr_availability=$_get_edit['itr_availability'];
                               $itr_years=$_get_edit['itr_years'];
                               $gst_availability=$_get_edit['gst_availability'];
}
?>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-pencil font-red" aria-hidden="true">
                      </i>
                      <span class="caption-subject font-red sbold uppercase">Edit 
                      </span>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="" id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                      <div class="form-body">
<!--                            //`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, -->
<!--//`mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount` SELECT * FROM `apply_from` WHERE 1-->
                   <div class="form-group">
                                                    <label class="control-label col-md-3">full_name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="full_name" value="<?php echo $full_name; ?>" id="full_name" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                       <div class="form-group">
                                                    <label class="control-label col-md-3">employment_type
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                    <input type="text" name="employment_type" value="<?php echo $employment_type; ?>" id="employment_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>


                               <div class="form-group">
                                                    <label class="control-label col-md-3">pan
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                    <input type="text" name="pan" value="<?php echo $pan; ?>" id="pan" data-required="1" class="form-control">
                                  
                               </div>
                               </div>




                                         <div class="form-group">
                                                    <label class="control-label col-md-3">dob
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
         <input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" data-required="1" class="form-control">
                                  
                               </div>
                               </div>

                                              <div class="form-group">
                                                    <label class="control-label col-md-3">state
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                      <input type="text" name="state" id="state" value="<?php echo $state; ?>" data-required="1" class="form-control">
                                  
                               </div>
                               </div> 

                                                                 <div class="form-group">
                                                    <label class="control-label col-md-3">pin_code
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="pin_code" value="<?php echo $pin_code; ?>" id="pin_code" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                                                                              <div class="form-group">
                                                    <label class="control-label col-md-3">mobile_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="mobile_no" value="<?php echo $mobile_no; ?>" id="mobile_no" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                      <div class="form-group">
                                                    <label class="control-label col-md-3">email
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="email" value="<?php echo $email; ?>" id="email" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                   <div class="form-group">
                                                    <label class="control-label col-md-3">aadhar_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="aadhar_no" value="<?php echo $aadhar_no; ?>" id="aadhar_no" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                              <div class="form-group">
                                                    <label class="control-label col-md-3">gender
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="gender" value="<?php echo $gender; ?>" id="gender" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                <div class="form-group">
                                                    <label class="control-label col-md-3">city
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="city" value="<?php echo $city; ?>" id="city" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                               <div class="form-group">
                                                    <label class="control-label col-md-3">loan_amount
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_amount" value="<?php echo $loan_amount; ?>" id="loan_amount" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">loan_type
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">specially_abled
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">prop_type
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">net_income
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">itr_availability
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">itr_years
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               <div class="form-group">
                                                    <label class="control-label col-md-3">gst_availability
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                  <input type="text" name="loan_type" value="<?php echo $loan_type; ?>" id="loan_type" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                               
                               
                               
                               
                               
                        
                        
           
               
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="idd" value="<?php echo $product_id; ?>">
             
               
                            <button type="submit" class="btn green" name="update_page" value="Update">Update
                            </button>
                            <button type="reset" value="Reset" class="btn grey-salsa btn-outline">Reset
                            </button>
                            
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- END FORM-->
                  </div>
                </div>
                <!-- END VALIDATION STATES-->
              </div>
            </div>
            <?php
}

?>
            <div class="clearfix">
            </div>
          </div>
          <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- END QUICK SIDEBAR -->
      </div>
      <!-- END CONTAINER -->
      <!-- BEGIN FOOTER -->
      <?php include("footer.php");?>
      <!-- END FOOTER -->
    </div>
    <!-- BEGIN QUICK NAV -->
    <div class="quick-nav-overlay">
    </div>
    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js">
    </script>
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
    </script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/scripts/datatable.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/global/scripts/app.min.js" type="text/javascript">
    </script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript">
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/components-select2.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript">
    </script>
    <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript">
    </script>
    <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript">
    </script>
    <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript">
    </script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <!-- Password Check -->
    <script language="javascript">
      function pswcheck()
      {
        pass=document.getElementById("password").value;
        repassword=document.getElementById("repassword").value;
        if(pass!=repassword)
        {
          alert("password Mismatch");
          document.getElementById("password").value="";
          document.getElementById("repassword").value="";
          document.getElementById("password").focus();
        }
      }
    </script>
    <script language="javascript" type="text/javascript">
      function CheckFormData()
      {
        var organic_menu  = document.getElementById("organic_menu");
        var image  = document.getElementById("image");
        if(organic_menu.value == '')
        {
          alert('Please Fill Category.');
          organic_menu.focus();
          organic_menu.style.border = 'thin solid red';
          return false;
        }
        if(image.value == '')
        {
          alert('Please Select Image.');
          image.focus();
          image.style.border = 'thin solid red';
          return false;
        }
        return true;
      }
    </script>
  </body>
</html>
