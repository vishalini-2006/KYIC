<?php
session_start();
include_once 'function.php';
//`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
if ($_POST['add'] == 'Create') {

    $name     = $_POST['name'];
        $phone     = $_POST['phone'];
    $reference_name     = $_POST['reference_name'];
 

mysqli_query($connect,"INSERT into reference (`name`,`phone`,`reference_name`) 
values ('$name','$phone','$reference_name')") or die(mysqli_error());



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
 

mysqli_query($connect,"UPDATE reference SET `name` = '$name',`phone` = '$phone',`reference_name` = '$reference_name' where referenceid = '$newsid'") or die(mysqli_error());
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
    <title>Reference Report | 
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
                  <span>Disbursement Report
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
                <?php
                if ($_POST['search'] == 'search') {
                    $from_date = $_POST['from_date'];
                       $to_date = $_POST['to_date'];
                            $referedby = $_POST['referedby'];
                            
                            
                             $from = mysqli_real_escape_string($connect, $from_date);
    $to   = mysqli_real_escape_string($connect, $to_date);
    $ref  = mysqli_real_escape_string($connect, $referedby);


 $start = $from . ' 00:00:00';
    $end   = $to   . ' 23:59:59';

    $where = "adate >= '$start' AND adate <= '$end'";


                     //SELECT * FROM `apply_from` WHERE `adate` BETWEEN '2024-08-01' AND '2024-08-29' AND `referedby` LIKE 'AK123' ORDER BY `adate` ASC
                        $get_orasadsganic = mysqli_query($connect,"SELECT * FROM `apply_from` WHERE `adate` BETWEEN '$start' AND '$end' AND `loan_status` = 'Disbursement' ORDER BY `adate` ASC") or die(mysqli_error($connect));
                }
                
                ?>
                  <form action="" method="POST">
                  <input type="date" name="from_date" value="<?php echo $from_date; ?>" />
                  <input type="date" name="to_date" value="<?php echo $to_date; ?>"/>

                    <input type="submit" name="search" value="search" />
              </form>
              </div>
              
            
              
              
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
                      <style>
                .table td, .table th {
    font-size: 14px !important;
}
                .table th h4{
    font-size: 14px !important;
    font-weight: bold !important;
}
            </style>
            <?php
//get action 
if(isset($_POST['search']) =='search') {

?>
            <br>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>Disbursement 
                    </div>
                    <div class="actions">
                     from : <?php echo date('d-m-Y',strtotime($from_date)); ?> - To : <?php echo date('d-m-Y',strtotime($to_date)); ?>
                    </div>
                  </div>
                  <div class="portlet-body">
          <?php
    //`idd`, `adate`, `full_name`, `referedby`, `employment_type`, 
    //`pan`, `dob`, `state`, `pin_code`, `mobile_no`, `bank_name`, `email`, `aadhar_no`, `gender`, `city`, `loan_amount`,
    //`loan_type`, `loan_status`, `reason`SELECT * FROM `apply_from` WHERE 1      
          ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                     <th>
<h4># </h4>
</th>
<th style="width:10%;">
<h4 >Date </h4>
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
<h4>Add</h4>
</th>
<th>
<h4>mobile</h4>
</th>
<th>
<h4>Loan amount</h4>
</th>
<th>
<h4>Loan type</h4>

</th>
<th>
<h4>Loan status</h4>

</th>
<th>

<h4>Bank Name</h4>
</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;

//`referenceid`, `name`, `reference_name`SELECT * FROM `reference` WHERE 1
// $get_organic = mysqli_query($connect,"SELECT * FROM `reference` ") or die(mysqli_error($connect));
while($get_value = mysqli_fetch_array($get_orasadsganic)) 
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
  $loan_status=$get_value['loan_status'];

?>
                        <tr>
                         <td><?php echo $sno; ?></td>
        <td><?php echo date('d-m-Y',strtotime($adate)); ?></td>
            <td class="text-right"><?php echo $full_name; ?> - KYCC<?php echo $product_id; ?> </td>
               <td class="text-right"><?php echo $employment_type; ?> </td>
                  <td class="text-right"><?php echo $pan; ?><br><?php echo $aadhar_no; ?> </td>
      
                <td class="text-right"><?php echo $state; ?><br><?php echo $pin_code; ?> </td>
                   <td class="text-right"><?php echo $mobile_no; ?> </td>
                      <td class="text-right"><?php echo $loan_amount; ?></td>
                         <td class="text-right"><?php echo $loan_type; ?></td>
                         <td class="text-right"><?php echo $loan_status; ?></td> 
                         
                         
                                <td class="text-right"><?php echo $bank_name; ?></td>

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
    <style>
        .table td, .table th {
    font-size: 10px;
}
h4 {
    font-size: 11px;
}
    </style>
  </body>
</html>
