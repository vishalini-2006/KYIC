<?php
session_start();
include_once 'function.php';

//deleting record
//action=delete&catid
if ($_GET['action'] == 'delete') {
    
    $id  = $_GET['nwsevnt_id'];

//`reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1

    $sql = "DELETE FROM reg_user WHERE reg_id = $id;";
    $query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
    
    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
    
    if ($query) {


        echo "<script type='text/javascript'>window.location = 'reg_users2.php?msg=deleted&action=list'</script>";
    }
    
}

// add Details
if ($_POST['transfer'] == 'submit') {
$trans_date = date('Y-m-d');

$paymentamount      = $_POST['paymentamount'];
$aregid = $_POST['regid'];
$referenceno = "through admin";
mysqli_query($connect,"INSERT into payments (`reg_id`,`paymentamount`,`paymentdate`,`referenceno`,`qrid`,`paymentstatus`) values ('$aregid','$paymentamount','$trans_date','$referenceno','$qrid','1')") or die(mysqli_error($connect));

mysqli_query($connect,"INSERT into transaction (`cus_id`,`trans_date`,`trans_des`,`amt_credit`,`status`) values ('$aregid','$trans_date','Wallet payment','$paymentamount','1')") or die(mysqli_error($connect));
  
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
        Please wait while we update loading...</div>";
    
    echo "<script type='text/javascript'>window.location = 'reg_users2.php?msg=added&action=list'</script>";
}
// Edit
// add Details
if ($_POST['status'] == 'submit') {
// $trans_date = date('Y-m-d');

$referedby      = $_POST['referedby'];
$aregid = $_POST['regid'];

////`reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1
mysqli_query($connect,"UPDATE `reg_user` SET `referedby`='$referedby' WHERE reg_id = '$aregid'") or die(mysqli_error());


echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
        Please wait while we update loading...</div>";
    
    echo "<script type='text/javascript'>window.location = 'reg_users2.php?msg=added&action=list'</script>";
}

if ($_POST['submit'] == 'submit') {


$newsid = $_POST['reg_id'];

  $status     = $_POST['status'];
echo "UPDATE reg_user SET `status` = '$status' where reg_id = '$newsid'";
mysqli_query($connect,"UPDATE reg_user SET `status` = '$status' where reg_id = '$newsid'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'reg_users2.php?msg=updated&action=list'</script>";
}

?>



<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>REG USERS List | 
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
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js">
    </script>
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
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                  <span>User List
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
            <br>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>User List
                    </div>
                    <div class="actions">
                                                           <a href="regadd.php?action=add" class="btn btn-default btn-sm">
<i class="fa fa-plus"></i> Add </a>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <?php pageStatus($status); ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr class="">
                          <th> S.NO 
                          </th>
                          <th> user_name
                          </th>
                      
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;
//`reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1

$get_customer = mysqli_query($connect,"SELECT * FROM reg_user where status = '1'") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_customer)) 
{
$sno++;    
$reg_id = $get_value['reg_id'];    
$reg_name=$get_value['reg_name']; 
$reg_mailid=$get_value['reg_mailid']; 
$reg_pin=$get_value['reg_pin']; 
$reg_phone=$get_value['reg_phone']; 


$accountno=$get_value['accountno']; 
$ifsccode=$get_value['ifsccode']; 
$bankdetails=$get_value['bankdetails']; 
$referedby=$get_value['referedby']; 
$status=$get_value['status'];
if($status == 0){
    $status5 = "Active";
    
}else{
    $status5 = "In-Active";
}
?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                          </td>
                          <td>
                            <?php echo $reg_name;?> - <?php echo 'ITC'.$reg_id; ?>
                          </td>
                          
                          
                          <td>
                            <?php echo $status5;?> 
                            <form action="" method="POST">
                                <select name="status">
                                    <option value="1" <?php if($status == '1'){ echo "selected";} ?>>In-active</option>
                                      <option value="0" <?php if($status == '0'){ echo "selected";} ?>>active</option>
                                </select>
                                <input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>"/>
                                <input type="submit" name="submit" value="submit" />
                                
                            </form>
                          </td>
         
          <div class="modal fade" id="addpayment<?php echo $reg_id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                  </button>
                                  <h4 class="modal-title">
                                    <b>
                                      Add payment
                                    </b>
                                  </h4>
                                </div>
                                <div class="modal-body">
                                      <form class="auth-form p-0" action="" method="POST">
<input type="hidden" value="<?php echo $reg_id; ?>" name="regid" />
            
        <div class="form-group">
          <label for="inputamount" class="form-label">Amount</label>
          <input type="text" class="form-control" id="inputamount" name="paymentamount" placeholder="Enter amount" required/>
        </div>

      

        <input type="submit" class="btn theme-btn w-100" name="transfer" value="submit" />  
        <!-- <a href="done.php" class="btn theme-btn w-100">Transfer</a> -->
      </form>
      
      
      
      
      
      <h2>select referal</h2>
                                            <form class="auth-form p-0" action="" method="POST">
<input type="hidden" value="<?php echo $reg_id; ?>" name="regid" />
            
        <div class="form-group">
          <label for="inputamount" class="form-label">Refered by</label>
       <select name="referedby" class="form-control">
            <?php
$get_customeqr = mysqli_query($connect,"SELECT * FROM reg_user ") or die(mysqli_error());
while($get_valueas = mysqli_fetch_array($get_customeqr)) 
{
  
$reg_id55 = $get_valueas['reg_id'];              
$reg_name = $get_valueas['reg_name']; 
$reg_id55 = 'ITC'.$reg_id55;
?>
            <option value="<?php echo $reg_id55 ; ?>" <?php if($referedby == $reg_id55 ){echo "selected";} ?>><?php echo $reg_name ; ?> - <?php echo $reg_id55; ?></option>

          <?php
}
?>
</select>
        </div>

      

        <input type="submit" class="btn theme-btn w-100" name="referal" value="submit" />  
        <!-- <a href="done.php" class="btn theme-btn w-100">Transfer</a> -->
      </form>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/components-select2.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- SCRIPTS -->         
  </body>
</html>
