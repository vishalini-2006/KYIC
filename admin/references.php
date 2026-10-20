<?php
session_start();
include_once 'function.php';
//`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
// `aadhar_no`, `pan_no`, `bank_account`, `bank_ifsc`, `bank_name`SELECT * FROM `reference` WHERE 1
if ($_POST['add'] == 'Create') {

    $name     = $_POST['name'];
        $phone     = $_POST['phone'];
    $reference_name     = $_POST['reference_name'];
        $username     = $_POST['username'];
            $password     = $_POST['password'];

$aadhar_no     = $_POST['aadhar_no'];
$pan_no     = $_POST['pan_no'];
$bank_account     = $_POST['bank_account'];
$bank_ifsc     = $_POST['bank_ifsc'];
$bank_name     = $_POST['bank_name'];
 

mysqli_query($connect,"INSERT into reference (`name`,`phone`,`reference_name`,`username`,`password`,`aadhar_no`,`pan_no`,`bank_account`,`bank_ifsc`,`bank_name`) 
values ('$name','$phone','$reference_name','$username','$password','$aadhar_no','$pan_no','$bank_account','$bank_ifsc','$bank_name')") or die(mysqli_error());


//`adminid`, `reg_id`, `username`, `password`, `level`SELECT * FROM `admin` WHERE 1
mysqli_query($connect,"INSERT into admin (`username`,`password`,`level`) 
values ('$username','$password','1')") or die(mysqli_error());

echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'references.php?msg=added&action=list'</script>";
}
// Edit
if ($_POST['update_page'] == 'Update') {

//`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
$newsid = $_POST['referenceid'];

    $name     = $_POST['name'];
      $phone     = $_POST['phone'];
    $reference_name     = $_POST['reference_name'];
         $username     = $_POST['username'];
            $password     = $_POST['password'];
            
            
            $aadhar_no     = $_POST['aadhar_no'];
$pan_no     = $_POST['pan_no'];
$bank_account     = $_POST['bank_account'];
$bank_ifsc     = $_POST['bank_ifsc'];
$bank_name     = $_POST['bank_name'];

$sql = "UPDATE reference 
        SET `name` = '$name',
        `reference_name` = '$reference_name',
            `phone` = '$phone',
            `aadhar_no` = '$aadhar_no',
            `pan_no` = '$pan_no',
            `bank_account` = '$bank_account',
            `bank_ifsc` = '$bank_ifsc',
            `bank_name` = '$bank_name'
        WHERE referenceid = '$newsid'";

mysqli_query($connect, $sql) or die(mysqli_error($connect));



echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'references.php?msg=updated&action=list'</script>";
}
//`newsid`, `newsdate`, `newshead`, `newscontent`, `newsimg1`, `newsimg2`SELECT * FROM `news` WHERE 1
if ($_GET['action'] == 'delete') {
$id  = $_GET['nwsevnt_id'];
$sql = "DELETE FROM reference WHERE referenceid = $id;";
$query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
echo "<script type='text/javascript'>window.location = 'references.php?msg=deleted&action=list'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>Reference | 
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
                  <span>reference
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
            
            <style>
                .link-gap{
                    margin-bottom:5px;
                }
            </style>
            <?php
//get action 
if(isset($_GET['action']) =='' || $_GET['action'] == 'list') {

?>
            <br>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>reference
                    </div>
                    <div class="actions">
                      <a href="?action=add" class="btn btn-default btn-sm">
                        <i class="fa fa-plus">
                        </i> Add 
                      </a>
                    </div>
                  </div>
                  
                  <div class="portlet-body">
          
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr class="">
                          <th> S.NO 
                          </th>
                          <th>
                            Reference name
                          </th>
                           <th>
                            Reference phone no
                          </th>
                          <th>
                        Code
                          </th>
                            <th>
                        username
                          </th>
                            <th>
                        password
                          </th>
                    <th>
                        Bank details
                          </th>
                         
                          <th>Modify
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;
// `aadhar_no`, `pan_no`, `bank_account`, `bank_ifsc`, `bank_name`SELECT * FROM `reference` WHERE 1
//`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
$get_organic = mysqli_query($connect,"SELECT * FROM `reference` ") or die(mysqli_error($connect));
while($get_value = mysqli_fetch_array($get_organic)) 
{
$sno++;
$newsid = $get_value['referenceid'];

$name = $get_value['name'];
$phone = $get_value['phone'];
$reference_name = $get_value['reference_name'];



$username = $get_value['username'];
$password = $get_value['password'];

$aadhar_no = $get_value['aadhar_no'];
$pan_no = $get_value['pan_no'];
$bank_account = $get_value['bank_account'];
$bank_ifsc = $get_value['bank_ifsc'];
$bank_name = $get_value['bank_name'];

?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                          </td>
                          <td>
                            <?php echo $name;?> 
                          </td>
                           <td>
                            <?php echo $phone;?> 
                          </td>
                          <td>
                            <?php echo $reference_name;?> 
                          </td>
                          
                           <td>
                            <?php echo $username;?> 
                          </td> <td>
                            <?php echo $password;?> 
                          </td>
                          <td>
                            <?php echo "Aadhar No : " .$aadhar_no;?> <br>
                                <?php echo "PAN No : " .$pan_no;?> <br>
                                    <?php echo "Bank A/C : " .$bank_account;?> <br>
                                        <?php echo "Bank IFSC: " .$bank_ifsc;?> <br>
                                            <?php echo "Bank Name : " .$bank_name;?> <br>
                          </td>
                      
                          
                         
                          <td>
                              <div class="link-gap">
                            <a class="btn btn-warning  btn-xs" href="references.php?action=edit&nwsevnt_id=<?php echo base64_encode($newsid); ?>">
                              <i class="fa fa-pencil" aria-hidden="true">
                              </i> Edit
                            </a>
                            
                              <a class="btn btn-success  btn-xs" href="invp.php?id=<?php echo $reference_name; ?>" target="_blank">
                              <i class="fa fa-print" aria-hidden="true">
                              </i> Print
                            </a>
                            </div>
                            
                            <div class="link-gap">
                                
                         
                            <a class="btn btn-xs red"  onClick="delete_menu('references.php?action=delete&nwsevnt_id=<?php echo $newsid; ?>')" href="javascript:;">
                              <i class="icon-trash">
                              </i> Delete
                            </a>
                            
                               <a class="btn btn-success  btn-xs" href="Qrgenetate.php?id=<?php echo $reference_name; ?>" target="_blank">
                              <i class="fa fa-view" aria-hidden="true">
                              </i> Generate QR
                            </a>
                               </div>

                            <div class="link-gap">
                             <a class="btn btn-warning  btn-xs" onclick="myFunction<?php echo $reference_name; ?>()">
                              <i class="fa fa-copy">
                              </i> Copy
                            </a>
                            
                            </div>
                            <p id="copied_text<?php echo $reference_name; ?>"></p>
                            
                            <input type="text" id="myInput2<?php echo $reference_name; ?>" value="https://kycfinserv.com/?id=<?php echo $reference_name; ?>"  style="opacity:-1;" readonly\>
                            
                        
                              <script>
                                function myFunction<?php echo $reference_name; ?>() {
                                    
                                  
                                 var copyText<?php echo $reference_name; ?> = document.getElementById('myInput2<?php echo $reference_name; ?>');
                                
                                   var copied_text<?php echo $reference_name; ?> = document.getElementById("copied_text");
                               
                            
                                
                                 
                                  copyText<?php echo $reference_name; ?>.select();
                                  copyText<?php echo $reference_name; ?>.setSelectionRange(0, 99999); 
                                
                                 
                                  navigator.clipboard.writeText(copyText<?php echo $reference_name; ?>.value);
                                  
                                 
                                   copyText<?php echo $reference_name; ?>.value;
                                   
                                
                                     document.getElementById("copied_text<?php echo $reference_name; ?>").innerHTML = "Text Copied..!";
                                   
                                }
                                </script>
                            
                            
                            
                          </td>

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
////`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
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
                                                    <label class="control-label col-md-3">Reference Name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="name" id="name" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                              <div class="form-group">
                                                    <label class="control-label col-md-3">Reference phone no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="phone" id="phone" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                       <div class="form-group">
                                                    <label class="control-label col-md-3">Reference Code
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="reference_name" id="reference_name" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                        
                                       <div class="form-group">
                                                    <label class="control-label col-md-3">Usernamer
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="username" id="username" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                        
                                       <div class="form-group">
                                                    <label class="control-label col-md-3">Password
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="password" id="password" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">aadhar_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="aadhar_no" id="aadhar_no" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">pan_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="pan_no" id="pan_no" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">bank_name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="bank_name" id="bank_name" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">bank_account
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="bank_account" id="bank_account" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                                            <div class="form-group">
                                                    <label class="control-label col-md-3">bank_ifsc
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="bank_ifsc" id="bank_ifsc" data-required="1" class="form-control">
                                  
                               </div>
                               </div>

<!--`aadhar_no`, `pan_no`, `bank_account`, `bank_ifsc`, `bank_name`SELECT * FROM `reference` WHERE 1-->

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
////`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1                     
$NewsID = base64_decode($_GET["nwsevnt_id"]);

$get_about_edit = mysqli_query($connect,"SELECT * FROM `reference` where referenceid = '$NewsID'") or die(mysqli_error());
while($get_edit = mysqli_fetch_array($get_about_edit)) 
{
$sno++;
$newsid = $get_edit['referenceid'];

$name = $get_edit['name'];
$phone = $get_edit['phone'];
$reference_name = $get_edit['reference_name'];

$username = $get_edit['username'];
$password = $get_edit['password'];

$aadhar_no = $get_edit['aadhar_no'];
$pan_no = $get_edit['pan_no'];
$bank_account = $get_edit['bank_account'];
$bank_ifsc = $get_edit['bank_ifsc'];
$bank_name = $get_edit['bank_name'];

}
?>
<!--`aadhar_no`, `pan_no`, `bank_account`, `bank_ifsc`, `bank_name`SELECT * FROM `reference` WHERE 1-->
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
                        
       
                        
                      <div class="form-group">
                                                    <label class="control-label col-md-3">Name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="name" id="name" data-required="1" class="form-control" value="<?php echo $name; ?>">
                                  
                               </div>
                               </div>
                               
                                          <div class="form-group">
                                                    <label class="control-label col-md-3">Phone
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="phone" id="phone" data-required="1" class="form-control" value="<?php echo $phone; ?>">
                                  
                               </div>
                               </div>
                               
                                   <div class="form-group">
                                                    <label class="control-label col-md-3">Code
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="reference_name" id="reference_name" data-required="1" class="form-control" value="<?php echo $reference_name; ?>">
                                  
                               </div>
                               </div>
                               
                                          <div class="form-group">
                                                    <label class="control-label col-md-3">Username
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="username" id="username" data-required="1" class="form-control" value="<?php echo $username; ?>">
                                  
                               </div>
                               </div>
                                          <div class="form-group">
                                                    <label class="control-label col-md-3">Password
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="password" id="password" data-required="1" class="form-control" value="<?php echo $password; ?>">
                                  
                               </div>
                               </div>

                              <div class="form-group">
                                                    <label class="control-label col-md-3">aadhar_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="aadhar_no" id="aadhar_no" data-required="1" class="form-control" value="<?php echo $aadhar_no; ?>">
                                  
                               </div>
                               </div>
                                                             <div class="form-group">
                                                    <label class="control-label col-md-3">pan_no
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="pan_no" id="pan_no" data-required="1" class="form-control" value="<?php echo $pan_no; ?>">
                                  
                               </div>
                               </div>
                                                             <div class="form-group">
                                                    <label class="control-label col-md-3">bank_name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="bank_name" id="bank_name" data-required="1" class="form-control" value="<?php echo $bank_name; ?>">
                                  
                               </div>
                               </div>
                                                             <div class="form-group">
                                                    <label class="control-label col-md-3">bank_account
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="bank_account" id="bank_account" data-required="1" class="form-control" value="<?php echo $bank_account; ?>">
                                  
                               </div>
                               </div>
                                                             <div class="form-group">
                                                    <label class="control-label col-md-3">bank_ifsc
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
          <input type="text" name="bank_ifsc" id="bank_ifsc" data-required="1" class="form-control" value="<?php echo $bank_ifsc; ?>">
                                  
                               </div>
                               </div>
                  
                        
                 

<!--`aadhar_no`, `pan_no`, `bank_account`, `bank_ifsc`, `bank_name`SELECT * FROM `reference` WHERE 1-->

                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="referenceid" value="<?php echo $newsid; ?>">

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
