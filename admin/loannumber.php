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

//`product_id`, `product_img`, `product_price`, `product_HI`, `product_DI`, `product_TI`, `product_cycle`, `product_Des`SELECT * FROM `product` WHERE 1

mysqli_query($connect,"INSERT into apply_from (`full_name`,`referedby`,`employment_type`,`pan`,`dob`,`state`,`pin_code`,`mobile_no`,`email`,`aadhar_no`,`gender`,`city`,`loan_amount`,`loan_type`) 
values ('$full_name','$referedby','$employment_type','$pan','$dob','$state','$pin_code','$mobile_no','$email','$aadhar_no','$gender','$city','$loan_amount','$loan_type')") or die(mysqli_error());



echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'loannumber.php?msg=added&action=list'</script>";
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


mysqli_query($connect,"UPDATE apply_from SET `full_name` = '$full_name',`referedby` = '$referedby',`employment_type` = '$employment_type',`pan` = '$pan',`dob` = '$dob',`state` = '$state',
`pin_code` = '$pin_code',`mobile_no` = '$mobile_no',`email` = '$email',`aadhar_no` = '$aadhar_no',`gender` = '$gender', `city` = '$city', `loan_amount` = '$loan_amount'  where idd = '$newsid'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'loannumber.php?msg=updated&action=list'</script>";
}
//`product_id`, `product_img`, `product_price`, `product_HI`, `product_DI`, `product_TI`, `product_cycle`, `product_Des`SELECT * FROM `product` WHERE 1
if ($_POST['updateadd'] == 'Submit') {


//`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, `mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`SELECT * FROM `apply_from` WHERE 1
$newsid = $_POST['idd'];


     $loan_status =$_POST['loan_status'];


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
   echo "<script type='text/javascript'>window.location = 'loannumber.php'</script>";
  
}
}

if ($_GET['action'] == 'delete') {
$id  = $_GET['nwsevnt_id'];
$sql = "DELETE FROM apply_from WHERE idd = $id;";
$query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
echo "<script type='text/javascript'>window.location = 'loannumber.php?msg=deleted&action=list'</script>";
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
                        Date
                          </th>
                         <th>
                        Full Name
                          </th>
                              <th>
                       Referred by
                          </th>
                          <th>
                      employment_type
                          </th>
                       
                               <th>
                          pan / aadhar_no
                          </th>
                           <th>
                            dob
                          </th>
                           <th> 
                        District /  pin_code 
                          </th> 
                          <th>
                          mobile_no / email
                          </th>
                            <th>
                            gender
                          </th>
                     
                          <th >
                             Loan amount
                          </th>
                          
                          <th >
                             Loan type
                          </th>
                          
                          <th>Modify
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;
//`idd`, `full_name`, `employment_type`, `pan`, `dob`, `state`, `pin_code`, 
//`mobile_no`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`SELECT * FROM `apply_from` WHERE 1
$get_organic = mysqli_query($connect,"SELECT * FROM `apply_from` where loan_status = 'Loan Account Number Generation' ") or die(mysqli_error());
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
  $loan_type = $get_value['loan_type'];
    $adate = $get_value['adate'];
        $loan_status = $get_value['loan_status'];


?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                          </td>
                           <td>
                            <?php echo date('d-m-Y', strtotime($adate)); ?> 
                          </td>
                            <td>
                            <?php echo $full_name;?> <br>
                            KYCC<?php echo $product_id; ?>
                          </td>
                            <td>
                            <?php 
                            if($referedby != ''){
                            echo $referedby;
                            }else{
                                echo "Individual";
                            }
                            ?> 
                               <a class="btn btn-success  btn-xs" href="invp.php?id=<?php echo $referedby; ?>&loan_status=<?php echo $loan_status; ?>" target="_blank">
                              <i class="fa fa-print" aria-hidden="true">
                              </i> Print List
                            </a>
                          </td>
                          <td>
                            <?php echo $employment_type;?> 
                          </td>
                        
                          
                           <td>
                          <?php echo $pan; ?>
                          <br>
                             <?php echo $aadhar_no;?> 
                          </td>

                            <td>
                            <?php echo date('d-m-Y',strtotime($dob));?> 
                          </td>

                            <td>
                                
                                <?php echo $state; ?>
                                <br>
                           
                            <?php echo $pin_code;?> 
                          </td> 

                          <td>
                              <?php echo $mobile_no; ?>
                              <br>
                                <?php echo $email; ?>
                        
                          </td>

                           <td>
                            <?php echo $gender;?> 
                          
                          </td>
                          
                
                          
                          <td>    <?php echo $loan_amount;?>  </td>
                        <td>    <?php echo $loan_type;?>
                        <form method="POST" action="" >
                        <select name="loan_status">
                            <option value="">Select status</option>
                            <option value="Case login" <?php if($loan_status == 'Case login'){ echo "selected";} ?>>Case login</option>
                            <option value="Questioned documents examination (QDE)" <?php if($loan_status == 'Questioned documents examination (QDE)'){ echo "selected";} ?>>Questioned documents examination (QDE)</option>
                            <option value="Probability of Default Examination (PDE)" <?php if($loan_status == 'Probability of Default Examination (PDE)'){ echo "selected";} ?>>Probability of Default Examination (PDE)</option>
                            <option value="Credit appraisal" <?php if($loan_status == 'Credit appraisal'){ echo "selected";} ?>>Credit appraisal</option>
                            <option value="Financial sanction" <?php if($loan_status == 'Financial sanction'){ echo "selected";} ?>>Financial sanction</option>
                              <option value="Final sanction" <?php if($loan_status == 'Final sanction'){ echo "selected";} ?>>Final sanction</option>
                            <option value="Legal/Tech clearance" <?php if($loan_status == 'Legal/Tech clearance'){ echo "selected";} ?>>Legal/Tech clearance</option>
                            <option value="Loan docket creation" <?php if($loan_status == 'Loan docket creation'){ echo "selected";} ?>>Loan docket creation</option>
                            <option value="Disbursement" <?php if($loan_status == 'Disbursement'){ echo "selected";} ?>>Disbursement</option>
                            <option value="Loan Account Number Generation" <?php if($loan_status == 'Loan Account Number Generation'){ echo "selected";} ?>>Loan Account Number Generation</option>
                        
                        </select>
                        <input type="hidden" name="idd" value="<?php echo $product_id; ?>" />
                        <input type="submit" name="updateadd" value="Submit" />
                        </form>
                        </td>

                          
                          
                          
                          <td>
                            
                            <a class="btn btn-warning  btn-xs" href="product.php?action=edit&nwsevnt_id=<?php echo base64_encode($product_id); ?>">
                              <i class="fa fa-pencil" aria-hidden="true">
                              </i> Edit
                            </a>
                              <a class="btn btn-success  btn-xs" href="inv.php?id=<?php echo $product_id; ?>" target="_blank">
                              <i class="fa fa-print" aria-hidden="true">
                              </i> Print
                            </a>
                            <a class="btn btn-xs red"  onClick="delete_menu('product.php?action=delete&nwsevnt_id=<?php echo $product_id; ?>')" href="javascript:;">
                              <i class="icon-trash">
                              </i> Delete
                            </a>
                          </td>
                          <!--============================================= Message Pop Up =============================================-->
                          
                          <!--=========================================== End Message Pop Up ========================================== -->

                          <!--============================================= Content Pop Up =============================================-->
                          
                          <!--=========================================== End Content Pop Up ============================================== -->

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
$loan_type =$_ger_edit['loan_type'];
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
