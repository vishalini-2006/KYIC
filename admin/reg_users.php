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


        echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=deleted&action=list'</script>";
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
    
    echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=added&action=list'</script>";
}
// Edit
// add Details
if ($_POST['referal'] == 'submit') {
// $trans_date = date('Y-m-d');

$referedby      = $_POST['referedby'];
$aregid = $_POST['regid'];

////`reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1
mysqli_query($connect,"UPDATE `reg_user` SET `referedby`='$referedby' WHERE reg_id = '$aregid'") or die(mysqli_error());


echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
        Please wait while we update loading...</div>";
    
    echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=added&action=list'</script>";
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
                          <th> Mail
                          </th>
                          <th> Pin
                          </th>
                          <th> Phone
                          </th>
                       
                                <th> Referals
                          </th>
                          
                             <th> Referred by
                          </th>
                          <th>Modify
                          </th>
                          <!--<th>view</th>-->
                        </tr>
                      </thead>
                 
   
                    </table>
                  </div>
                </div>
              </div>
            </div>   
            <div class="clearfix">
            </div>
            <table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody><tr class="odd">
        <td>Airi</td>
        <td>Satou</td>
        <td>Accountant</td>
        <td>Tokyo</td>
        <td>28th Nov 08</td>
        <td>$162,700</td>
    </tr>
    <tr class="even">
        <td>Angelica</td>
        <td>Ramos</td>
        <td>Chief Executive Officer (CEO)</td>
        <td>London</td>
        <td>9th Oct 09</td>
        <td>$1,200,000</td>
    </tr>
    <tr class="odd">
        <td>Ashton</td>
        <td>Cox</td>
        <td>Junior Technical Author</td>
        <td>San Francisco</td>
        <td>12th Jan 09</td>
        <td>$86,000</td>
    </tr>
    <tr class="even">
        <td>Bradley</td>
        <td>Greer</td>
        <td>Software Engineer</td>
        <td>London</td>
        <td>13th Oct 12</td>
        <td>$132,000</td>
    </tr>
    <tr class="odd">
        <td>Brenden</td>
        <td>Wagner</td>
        <td>Software Engineer</td>
        <td>San Francisco</td>
        <td>7th Jun 11</td>
        <td>$206,850</td>
    </tr>
    <tr class="even">
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>2nd Dec 12</td>
        <td>$372,000</td>
    </tr>
    <tr class="odd">
        <td>Bruno</td>
        <td>Nash</td>
        <td>Software Engineer</td>
        <td>London</td>
        <td>3rd May 11</td>
        <td>$163,500</td>
    </tr>
    <tr class="even">
        <td>Caesar</td>
        <td>Vance</td>
        <td>Pre-Sales Support</td>
        <td>New York</td>
        <td>12th Dec 11</td>
        <td>$106,450</td>
    </tr>
    <tr class="odd">
        <td>Cara</td>
        <td>Stevens</td>
        <td>Sales Assistant</td>
        <td>New York</td>
        <td>6th Dec 11</td>
        <td>$145,600</td>
    </tr>
    <tr class="even">
        <td>Cedric</td>
        <td>Kelly</td>
        <td>Senior Javascript Developer</td>
        <td>Edinburgh</td>
        <td>29th Mar 12</td>
        <td>$433,060</td>
    </tr>
    </tbody><tfoot>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>

<sript>
   
</sript>
            
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
        <script src="fetch2.js" type="text/javascript">
    </script>
    <script>
        $(document).ready( function() {
  $('#sample_2').dataTable( {
   "pageLength": 5,
   "iDisplayLength": 5,
    "deferRender": true,
        "deferLoading": 10
  } );
} )

 $(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/server_processing.php",
        "deferLoading": 57
    } );
} );
    </script>
    	
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- SCRIPTS -->         
  </body>
</html>
re